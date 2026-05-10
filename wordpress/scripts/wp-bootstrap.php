<?php

if (!defined('ABSPATH')) {
    exit(1);
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

function pk_cli_upsert_page(array $args): int
{
    $existing = get_page_by_path($args['slug'], OBJECT, 'page');
    $payload = [
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $args['title'],
        'post_name' => $args['slug'],
        'post_content' => '',
    ];

    if ($existing instanceof WP_Post) {
        $payload['ID'] = $existing->ID;
        wp_update_post($payload);
        return (int) $existing->ID;
    }

    return (int) wp_insert_post($payload);
}

function pk_cli_menu_item(int $menuId, string $title, string $url, string $description = ''): void
{
    foreach ((array) wp_get_nav_menu_items($menuId) as $item) {
        if ($item instanceof WP_Post && $item->title === $title && $item->url === $url) {
            if ($description !== '') {
                wp_update_nav_menu_item($menuId, $item->ID, ['menu-item-description' => $description]);
            }
            return;
        }
    }

    wp_update_nav_menu_item($menuId, 0, [
        'menu-item-title' => $title,
        'menu-item-url' => $url,
        'menu-item-status' => 'publish',
        'menu-item-description' => $description,
    ]);
}

function pk_cli_language_setup(array $pages): void
{
    if (!function_exists('PLL')) {
        return;
    }

    $pll = PLL();
    foreach ([
        ['slug' => 'pl', 'name' => 'Polski', 'locale' => 'pl_PL', 'flag' => 'pl', 'rtl' => false],
        ['slug' => 'en', 'name' => 'English', 'locale' => 'en_US', 'flag' => 'us', 'rtl' => false],
        ['slug' => 'de', 'name' => 'Deutsch', 'locale' => 'de_DE', 'flag' => 'de', 'rtl' => false],
    ] as $language) {
        if (!$pll->model->get_language($language['slug'])) {
            $pll->model->add_language($language + ['no_default_cat' => true]);
        }
    }

    $pll->model->update_default_lang('pl');

    $groups = [
        'pl' => ['home' => $pages['pl_home'], 'pricing' => $pages['pl_pricing']],
        'en' => ['home' => $pages['en_home'], 'pricing' => $pages['en_pricing']],
        'de' => ['home' => $pages['de_home'], 'pricing' => $pages['de_pricing']],
    ];

    foreach ($groups as $lang => $group) {
        foreach ($group as $postId) {
            pll_set_post_language($postId, $lang);
        }
    }

    pll_save_post_translations([
        'pl' => $pages['pl_home'],
        'en' => $pages['en_home'],
        'de' => $pages['de_home'],
    ]);
    pll_save_post_translations([
        'pl' => $pages['pl_pricing'],
        'en' => $pages['en_pricing'],
        'de' => $pages['de_pricing'],
    ]);
}

function pk_cli_build_menu(string $lang, string $menuName, int $homeId, int $pricingId): int
{
    $defaults = function_exists('pk_defaults_for_lang') ? pk_defaults_for_lang($lang) : [];
    $links = $defaults['nav']['links'] ?? [];
    $menu = wp_get_nav_menu_object($menuName);
    $menuId = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu($menuName);
    $homeUrl = trailingslashit((string) get_permalink($homeId));
    $pricingUrl = (string) get_permalink($pricingId);

    foreach ($links as $link) {
        $href = (string) ($link['href'] ?? '#');
        if ($href === '/cennik') {
            $url = $pricingUrl;
        } elseif (str_starts_with($href, '/#')) {
            $url = $homeUrl . ltrim(substr($href, 1), '/');
        } else {
            $url = $href;
        }

        pk_cli_menu_item(
            $menuId,
            (string) ($link['label'] ?? ''),
            $url,
            (string) ($link['sub'] ?? '')
        );
    }

    return $menuId;
}

function pk_cli_seed_carbon_options(): void
{
    if (!function_exists('carbon_set_theme_option') || !function_exists('pk_defaults_for_lang')) {
        return;
    }

    carbon_set_theme_option('pk_contact_phone', '+48 501 744 994');
    carbon_set_theme_option('pk_contact_email', 'panikwiat@gmail.com');
    carbon_set_theme_option('pk_marketplace_url', 'https://www.facebook.com/marketplace/profile/100058801496320/?ref=permalink');

    foreach (['pl', 'en', 'de'] as $lang) {
        $defaults = pk_defaults_for_lang($lang);
        carbon_set_theme_option('pk_header_question_' . $lang, $defaults['header']['question']);
        carbon_set_theme_option('pk_header_contact_' . $lang, $defaults['header']['contact']);
        carbon_set_theme_option('pk_footer_help_' . $lang, $defaults['footer']['help']);
        carbon_set_theme_option('pk_footer_copyright_' . $lang, $defaults['footer']['copyright']);
        carbon_set_theme_option('pk_form_phone_heading_' . $lang, $defaults['contactForm']['phoneHeading']);
        carbon_set_theme_option('pk_form_heading_' . $lang, $defaults['contactForm']['formHeading']);
    }
}

function pk_cli_theme_asset_url(string $relativePath): string
{
    if (function_exists('pk_asset_url')) {
        return pk_asset_url($relativePath);
    }

    return trailingslashit(get_stylesheet_directory_uri()) . 'assets/site/' . ltrim($relativePath, '/');
}

function pk_cli_theme_asset_path(string $relativePath): string
{
    return trailingslashit(get_stylesheet_directory()) . 'assets/site/' . ltrim($relativePath, '/');
}

function pk_cli_media_value(string $relativePath): int|string
{
    $attachmentId = pk_cli_get_or_create_attachment($relativePath);

    if ($attachmentId > 0) {
        return $attachmentId;
    }

    return pk_cli_theme_asset_url($relativePath);
}

function pk_cli_get_or_create_attachment(string $relativePath): int
{
    $relativePath = ltrim($relativePath, '/');
    if ($relativePath === '') {
        return 0;
    }

    $existing = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'meta_key' => '_pk_theme_asset_relpath',
        'meta_value' => $relativePath,
        'no_found_rows' => true,
    ]);

    if (is_array($existing) && $existing !== []) {
        return (int) $existing[0];
    }

    $sourcePath = pk_cli_theme_asset_path($relativePath);
    if (!file_exists($sourcePath)) {
        WP_CLI::warning(sprintf('Missing theme asset: %s', $relativePath));
        return 0;
    }

    $contents = file_get_contents($sourcePath);
    if ($contents === false) {
        WP_CLI::warning(sprintf('Cannot read theme asset: %s', $relativePath));
        return 0;
    }

    $upload = wp_upload_bits(wp_basename($relativePath), null, $contents);
    if (!empty($upload['error'])) {
        WP_CLI::warning(sprintf('Upload failed for %s: %s', $relativePath, $upload['error']));
        return 0;
    }

    $filetype = wp_check_filetype($upload['file']);
    $attachmentId = wp_insert_attachment([
        'post_mime_type' => $filetype['type'] ?? '',
        'post_title' => sanitize_file_name(str_replace('/', '-', pathinfo($relativePath, PATHINFO_FILENAME))),
        'post_status' => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachmentId) || !is_numeric($attachmentId)) {
        WP_CLI::warning(sprintf('Attachment insert failed for %s', $relativePath));
        return 0;
    }

    $attachmentId = (int) $attachmentId;
    $metadata = wp_generate_attachment_metadata($attachmentId, $upload['file']);
    if (is_array($metadata)) {
        wp_update_attachment_metadata($attachmentId, $metadata);
    }

    update_post_meta($attachmentId, '_pk_theme_asset_relpath', $relativePath);

    return $attachmentId;
}

function pk_cli_gallery_rows(array $paths): array
{
    return array_map(static fn(string $path): array => ['image' => pk_cli_media_value($path)], $paths);
}

function pk_cli_seed_home_page(int $pageId, string $lang): void
{
    if (!function_exists('carbon_set_post_meta') || !function_exists('pk_defaults_for_lang')) {
        return;
    }

    $defaults = pk_defaults_for_lang($lang);
    carbon_set_post_meta($pageId, 'pk_hero_heading', $defaults['hero']['heading']);
    carbon_set_post_meta($pageId, 'pk_hero_paragraph', $defaults['hero']['paragraph']);
    carbon_set_post_meta($pageId, 'pk_hero_contact_cta', $defaults['hero']['contactCta']);
    carbon_set_post_meta($pageId, 'pk_hero_ready_cta', $defaults['hero']['readyCta']);
    carbon_set_post_meta($pageId, 'pk_hero_learn_more', $defaults['hero']['learnMore']);
    carbon_set_post_meta($pageId, 'pk_hero_disclaimer', $defaults['hero']['disclaimer']);
    carbon_set_post_meta($pageId, 'pk_main_title', $defaults['main']['title']);
    carbon_set_post_meta($pageId, 'pk_view_photos_label', $defaults['main']['viewPhotos']);
    carbon_set_post_meta($pageId, 'pk_cta_heading', $defaults['cta']['heading']);
    carbon_set_post_meta($pageId, 'pk_cta_subheading', $defaults['cta']['subheading']);
    carbon_set_post_meta($pageId, 'pk_cta_button', $defaults['cta']['button']);
    carbon_set_post_meta($pageId, 'pk_about_title', $defaults['about']['title']);
    carbon_set_post_meta($pageId, 'pk_about_heading', $defaults['about']['heading']);
    carbon_set_post_meta($pageId, 'pk_about_image', pk_cli_media_value($defaults['about']['image']));
    carbon_set_post_meta($pageId, 'pk_about_paragraphs', array_map(
        static fn(string $paragraph): array => ['text' => $paragraph],
        $defaults['about']['paragraphs']
    ));
    carbon_set_post_meta($pageId, 'pk_about_contact_cta', $defaults['about']['contactCta']);
    carbon_set_post_meta($pageId, 'pk_opinion_heading', $defaults['opinion']['heading']);
    carbon_set_post_meta($pageId, 'pk_opinion_items', $defaults['opinion']['items']);

    $sections = [];
    foreach ($defaults['main']['sections'] as $section) {
        $cards = [];
        foreach ($section['cards'] as $card) {
            $cards[] = [
                'title' => $card['title'],
                'cover_image' => pk_cli_media_value($card['cover_image']),
                'gallery' => pk_cli_gallery_rows($card['gallery']),
            ];
        }

        $sections[] = [
            'numeral' => $section['numeral'],
            'heading' => $section['heading'],
            'body' => $section['body'],
            'price_note' => $section['price_note'],
            'main_image' => pk_cli_media_value($section['main_image']),
            'main_gallery' => pk_cli_gallery_rows($section['main_gallery']),
            'list' => array_map(static fn(string $item): array => ['text' => $item], $section['list']),
            'cards' => $cards,
        ];
    }

    carbon_set_post_meta($pageId, 'pk_offer_sections', $sections);
}

function pk_cli_seed_pricing_page(int $pageId, string $lang): void
{
    if (!function_exists('carbon_set_post_meta') || !function_exists('pk_pricing_defaults_for_lang')) {
        return;
    }

    $defaults = pk_pricing_defaults_for_lang($lang);
    carbon_set_post_meta($pageId, 'pk_pricing_heading', $defaults['heading']);
    carbon_set_post_meta($pageId, 'pk_pricing_intro', $defaults['intro']);
    carbon_set_post_meta($pageId, 'pk_pricing_cta_heading', $defaults['cta']['heading']);
    carbon_set_post_meta($pageId, 'pk_pricing_cta_subheading', $defaults['cta']['subheading']);
    carbon_set_post_meta($pageId, 'pk_pricing_cta_button', $defaults['cta']['button']);
}

$theme = 'pani-kwiat';
switch_theme($theme);

$pages = [
    'pl_home' => pk_cli_upsert_page(['title' => 'Pani Kwiat', 'slug' => 'home']),
    'pl_pricing' => pk_cli_upsert_page(['title' => 'Cennik', 'slug' => 'cennik']),
    'en_home' => pk_cli_upsert_page(['title' => 'Home', 'slug' => 'home-en']),
    'en_pricing' => pk_cli_upsert_page(['title' => 'Pricing', 'slug' => 'pricing']),
    'de_home' => pk_cli_upsert_page(['title' => 'Startseite', 'slug' => 'startseite']),
    'de_pricing' => pk_cli_upsert_page(['title' => 'Preise', 'slug' => 'preise']),
];

update_post_meta($pages['pl_pricing'], '_wp_page_template', 'template-pricing.php');
update_post_meta($pages['en_pricing'], '_wp_page_template', 'template-pricing.php');
update_post_meta($pages['de_pricing'], '_wp_page_template', 'template-pricing.php');

pk_cli_language_setup($pages);

update_option('show_on_front', 'page');
update_option('page_on_front', $pages['pl_home']);

$menuId = pk_cli_build_menu('pl', 'Primary Navigation PL', $pages['pl_home'], $pages['pl_pricing']);
pk_cli_build_menu('en', 'Primary Navigation EN', $pages['en_home'], $pages['en_pricing']);
pk_cli_build_menu('de', 'Primary Navigation DE', $pages['de_home'], $pages['de_pricing']);

$locations = get_theme_mod('nav_menu_locations', []);
$locations['primary'] = $menuId;
set_theme_mod('nav_menu_locations', $locations);

update_option('permalink_structure', '/%postname%/');

pk_cli_seed_carbon_options();
pk_cli_seed_home_page($pages['pl_home'], 'pl');
pk_cli_seed_home_page($pages['en_home'], 'en');
pk_cli_seed_home_page($pages['de_home'], 'de');
pk_cli_seed_pricing_page($pages['pl_pricing'], 'pl');
pk_cli_seed_pricing_page($pages['en_pricing'], 'en');
pk_cli_seed_pricing_page($pages['de_pricing'], 'de');

WP_CLI::success('Starter pages and menu are in place.');
