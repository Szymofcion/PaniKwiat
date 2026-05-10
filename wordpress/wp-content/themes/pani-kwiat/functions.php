<?php

declare(strict_types=1);

require_once get_template_directory() . '/inc/defaults.php';
require_once get_template_directory() . '/inc/carbon-fields.php';

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Primary Navigation', 'pani-kwiat'),
    ]);
});

add_action('wp_enqueue_scripts', function (): void {
    $theme = wp_get_theme();
    $version = (string) $theme->get('Version');

    wp_enqueue_style(
        'pani-kwiat-fonts',
        'https://fonts.googleapis.com/css2?family=Amiko:wght@400;700&family=DM+Serif+Display&family=DM+Serif+Text&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'pani-kwiat-shared',
        pk_theme_asset_uri('assets/site/shared.css'),
        ['pani-kwiat-fonts'],
        $version
    );

    if (is_page_template('template-pricing.php')) {
        wp_enqueue_style(
            'pani-kwiat-pricing-page',
            pk_theme_asset_uri('assets/site/pricing-page.css'),
            ['pani-kwiat-shared'],
            $version
        );
    } else {
        wp_enqueue_style(
            'pani-kwiat-home',
            pk_theme_asset_uri('assets/site/site.css'),
            ['pani-kwiat-shared'],
            $version
        );
    }
    wp_enqueue_style(
        'pani-kwiat-overrides',
        pk_theme_asset_uri('assets/site/wp-overrides.css'),
        is_page_template('template-pricing.php') ? ['pani-kwiat-pricing-page'] : ['pani-kwiat-home'],
        $version
    );
    if (pk_is_blog_context()) {
        wp_enqueue_style(
            'pani-kwiat-blog',
            pk_theme_asset_uri('assets/site/blog.css'),
            ['pani-kwiat-overrides'],
            $version
        );
    }

    wp_enqueue_script(
        'pani-kwiat-swiper',
        'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
        [],
        '12.0.2',
        true
    );
    wp_enqueue_script(
        'pani-kwiat-theme',
        pk_theme_asset_uri('assets/theme.js'),
        ['pani-kwiat-swiper'],
        $version,
        true
    );
});

add_action('wp_enqueue_scripts', function (): void {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
}, 100);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_action('init', function (): void {
    add_rewrite_rule('^blog/?$', 'index.php?pk_blog=1', 'top');
    add_rewrite_rule('^blog/page/([0-9]+)/?$', 'index.php?pk_blog=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^(en|de)/blog/?$', 'index.php?pk_blog=1&lang=$matches[1]', 'top');
    add_rewrite_rule('^(en|de)/blog/page/([0-9]+)/?$', 'index.php?pk_blog=1&lang=$matches[1]&paged=$matches[2]', 'top');

    if (get_option('pk_blog_rewrite_version') !== '1') {
        flush_rewrite_rules(false);
        update_option('pk_blog_rewrite_version', '1');
    }
});

add_action('wp', function (): void {
    if (is_admin() || !is_singular('post') || is_preview()) {
        return;
    }

    $postId = get_queried_object_id();
    if ($postId > 0) {
        pk_increment_post_views($postId);
    }
});

add_filter('query_vars', function (array $vars): array {
    $vars[] = 'pk_blog';

    return $vars;
});

add_action('pre_get_posts', function (WP_Query $query): void {
    if (is_admin() || !$query->is_main_query() || (int) $query->get('pk_blog') !== 1) {
        return;
    }

    $query->set('post_type', 'post');
    $query->set('posts_per_page', (int) get_option('posts_per_page'));
    $query->set('ignore_sticky_posts', true);
    $query->is_home = true;
    $query->is_page = false;
    $query->is_singular = false;
});

add_filter('template_include', function (string $template): string {
    if ((int) get_query_var('pk_blog') !== 1) {
        return $template;
    }

    $blogTemplate = locate_template('home.php');

    return is_string($blogTemplate) && $blogTemplate !== '' ? $blogTemplate : $template;
});

add_filter('pre_get_document_title', function (string $title): string {
    $meta = pk_current_meta();

    return (string) ($meta['title'] ?? $title);
});

add_action('wp_head', function (): void {
    $meta = pk_current_meta();
    $description = trim((string) ($meta['description'] ?? ''));

    if ($description === '') {
        return;
    }

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
}, 1);

function pk_theme_asset_uri(string $path = ''): string
{
    return get_template_directory_uri() . '/' . ltrim($path, '/');
}

function pk_has_carbon(): bool
{
    return function_exists('carbon_get_post_meta') && function_exists('carbon_get_theme_option');
}

function pk_current_lang(): string
{
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language('slug');
        if (is_string($lang) && in_array($lang, ['pl', 'en', 'de'], true)) {
            return $lang;
        }
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('#^/(en|de)(/|$)#', (string) $uri, $matches) === 1) {
        return $matches[1];
    }

    return 'pl';
}

function pk_lang_home_url(?string $lang = null): string
{
    $lang = $lang ?: pk_current_lang();

    if (function_exists('pll_home_url')) {
        $home = pll_home_url($lang);
        if (is_string($home) && $home !== '') {
            return $home;
        }
    }

    return home_url($lang === 'pl' ? '/' : '/' . $lang . '/');
}

function pk_lang_pricing_url(?string $lang = null): string
{
    $lang = $lang ?: pk_current_lang();

    if (function_exists('pll_get_post')) {
        $basePage = get_page_by_path('cennik', OBJECT, 'page');
        if ($basePage instanceof WP_Post) {
            $translatedId = pll_get_post((int) $basePage->ID, $lang);
            if (is_int($translatedId) && $translatedId > 0) {
                $permalink = get_permalink($translatedId);
                if (is_string($permalink) && $permalink !== '') {
                    return $permalink;
                }
            }
        }
    }

    return home_url(($lang === 'pl' ? '' : '/' . $lang) . '/cennik/');
}

function pk_blog_url(?string $lang = null): string
{
    $lang = $lang ?: pk_current_lang();
    $postsPageId = (int) get_option('page_for_posts');

    if ($postsPageId > 0 && function_exists('pll_get_post')) {
        $translatedId = pll_get_post($postsPageId, $lang);
        if (is_int($translatedId) && $translatedId > 0) {
            $postsPageId = $translatedId;
        }
    }

    if ($postsPageId > 0) {
        $permalink = get_permalink($postsPageId);
        if (is_string($permalink) && $permalink !== '') {
            return $permalink;
        }
    }

    return home_url(($lang === 'pl' ? '' : '/' . $lang) . '/blog/');
}

function pk_asset_url(string $relativePath): string
{
    return pk_theme_asset_uri('assets/site/' . ltrim($relativePath, '/'));
}

function pk_defaults(): array
{
    return pk_defaults_for_lang(pk_current_lang());
}

function pk_pricing_defaults(): array
{
    return pk_pricing_defaults_for_lang(pk_current_lang());
}

function pk_current_meta(): array
{
    if (is_page_template('template-pricing.php')) {
        return (array) (pk_pricing_defaults()['meta'] ?? []);
    }

    if (!is_front_page()) {
        return [];
    }

    return (array) (pk_defaults()['meta'] ?? []);
}

function pk_get_page_field(string $fieldName, mixed $default = null, ?int $postId = null): mixed
{
    if (pk_has_carbon()) {
        $value = carbon_get_post_meta($postId ?: get_the_ID(), $fieldName);
        if ($value !== null && $value !== '' && $value !== []) {
            return $value;
        }
    }

    return $default;
}

function pk_get_option_field(string $fieldName, mixed $default = null): mixed
{
    if (pk_has_carbon()) {
        $value = carbon_get_theme_option($fieldName);
        if ($value !== null && $value !== '' && $value !== []) {
            return $value;
        }
    }

    return $default;
}

function pk_get_lang_option(string $baseName, mixed $default = null): mixed
{
    return pk_get_option_field($baseName . '_' . pk_current_lang(), $default);
}

function pk_marketplace_url(): string
{
    return (string) pk_get_option_field(
        'pk_marketplace_url',
        'https://www.facebook.com/marketplace/profile/100058801496320/?ref=permalink'
    );
}

function pk_media_url(mixed $value, string $defaultRelative = ''): string
{
    if (is_array($value)) {
        if (!empty($value['url']) && is_string($value['url'])) {
            return $value['url'];
        }
        if (!empty($value['image']) && is_string($value['image'])) {
            return $value['image'];
        }
        if (!empty($value['ID'])) {
            $resolved = wp_get_attachment_image_url((int) $value['ID'], 'full');
            if (is_string($resolved) && $resolved !== '') {
                return $resolved;
            }
        }
    }

    if (is_numeric($value)) {
        $resolved = wp_get_attachment_image_url((int) $value, 'full');
        if (is_string($resolved) && $resolved !== '') {
            return $resolved;
        }
    }

    if (is_string($value) && $value !== '') {
        return str_starts_with($value, 'http') ? $value : pk_asset_url($value);
    }

    return $defaultRelative !== '' ? pk_asset_url($defaultRelative) : '';
}

function pk_gallery_urls(mixed $value, array $defaultRelativePaths = []): array
{
    $urls = [];

    if (is_array($value)) {
        foreach ($value as $item) {
            $url = is_array($item) && array_key_exists('image', $item)
                ? pk_media_url($item['image'])
                : pk_media_url($item);
            if ($url !== '') {
                $urls[] = $url;
            }
        }
    }

    if ($urls !== []) {
        return $urls;
    }

    return array_map(static fn(string $path): string => pk_asset_url($path), $defaultRelativePaths);
}

function pk_paragraph_lines(mixed $value, array $default = []): array
{
    if (is_array($value) && $value !== []) {
        return array_values(array_filter(array_map(static function ($row): string {
            if (is_array($row)) {
                return (string) ($row['text'] ?? '');
            }

            return (string) $row;
        }, $value)));
    }

    return $default;
}

function pk_simple_list(mixed $value, array $default = []): array
{
    return pk_paragraph_lines($value, $default);
}

function pk_is_blog_context(): bool
{
    return is_home() || is_singular('post') || is_category() || is_tag() || is_author() || is_date() || is_search();
}

function pk_blog_strings(): array
{
    $lang = pk_current_lang();

    $strings = [
        'pl' => [
            'menu_title' => 'Blog',
            'menu_subtitle' => 'porady i inspiracje',
            'archive_title' => 'Blog Pani Kwiat',
            'archive_intro' => 'Inspiracje florystyczne, praktyczne wskazówki i pomysły na dekoracje na wyjątkowe okazje.',
            'popular_posts' => 'Najpopularniejsze wpisy',
            'latest_posts' => 'Najnowsze wpisy',
            'table_of_contents' => 'Spis treści',
            'read_more' => 'Czytaj wpis',
            'published_on' => 'Opublikowano',
            'previous_post' => 'Poprzedni wpis',
            'next_post' => 'Następny wpis',
            'about_author' => 'O autorce',
            'no_posts' => 'Pierwsze wpisy pojawią się tutaj wkrótce.',
            'toc_empty' => 'Ten wpis nie zawiera jeszcze śródtytułów.',
            'author_fallback' => 'Autorką wpisu jest %s. Na co dzień tworzy autorskie dekoracje kwiatowe i dzieli się doświadczeniem marki Pani Kwiat.',
        ],
        'en' => [
            'menu_title' => 'Blog',
            'menu_subtitle' => 'tips and inspiration',
            'archive_title' => 'Pani Kwiat Blog',
            'archive_intro' => 'Floral inspiration, practical tips, and decoration ideas for special occasions.',
            'popular_posts' => 'Popular posts',
            'latest_posts' => 'Latest posts',
            'table_of_contents' => 'Table of contents',
            'read_more' => 'Read article',
            'published_on' => 'Published',
            'previous_post' => 'Previous post',
            'next_post' => 'Next post',
            'about_author' => 'About the author',
            'no_posts' => 'New articles will appear here soon.',
            'toc_empty' => 'This article does not include headings yet.',
            'author_fallback' => 'This article was prepared by %s, the florist behind Pani Kwiat.',
        ],
        'de' => [
            'menu_title' => 'Blog',
            'menu_subtitle' => 'tipps und inspirationen',
            'archive_title' => 'Pani Kwiat Blog',
            'archive_intro' => 'Florale Inspirationen, praktische Tipps und Deko-Ideen fuer besondere Anlaesse.',
            'popular_posts' => 'Beliebte Beitraege',
            'latest_posts' => 'Neueste Beitraege',
            'table_of_contents' => 'Inhaltsverzeichnis',
            'read_more' => 'Beitrag lesen',
            'published_on' => 'Veroeffentlicht',
            'previous_post' => 'Vorheriger Beitrag',
            'next_post' => 'Naechster Beitrag',
            'about_author' => 'Ueber die Autorin',
            'no_posts' => 'Hier erscheinen bald neue Beitraege.',
            'toc_empty' => 'Dieser Beitrag enthaelt noch keine Zwischenueberschriften.',
            'author_fallback' => 'Dieser Beitrag wurde von %s verfasst, der Floristin hinter Pani Kwiat.',
        ],
    ];

    return $strings[$lang] ?? $strings['pl'];
}

function pk_blog_date(?int $postId = null): string
{
    $timestamp = get_post_timestamp($postId);
    if (!is_int($timestamp) || $timestamp <= 0) {
        return get_the_date('', $postId);
    }

    if (pk_current_lang() !== 'pl') {
        return wp_date(get_option('date_format'), $timestamp);
    }

    $months = [
        1 => 'stycznia',
        2 => 'lutego',
        3 => 'marca',
        4 => 'kwietnia',
        5 => 'maja',
        6 => 'czerwca',
        7 => 'lipca',
        8 => 'sierpnia',
        9 => 'września',
        10 => 'października',
        11 => 'listopada',
        12 => 'grudnia',
    ];

    $month = (int) wp_date('n', $timestamp);

    return sprintf(
        '%s %s %s',
        wp_date('j', $timestamp),
        $months[$month] ?? wp_date('F', $timestamp),
        wp_date('Y', $timestamp)
    );
}

function pk_normalize_url_path(string $url): string
{
    $path = (string) wp_parse_url($url, PHP_URL_PATH);

    if ($path === '') {
        return '/';
    }

    return '/' . trim($path, '/') . '/';
}

function pk_with_blog_menu_item(array $items): array
{
    $blogUrl = pk_blog_url();
    $blogPath = pk_normalize_url_path($blogUrl);

    foreach ($items as $item) {
        if (pk_normalize_url_path((string) ($item['url'] ?? '')) === $blogPath) {
            return $items;
        }
    }

    $strings = pk_blog_strings();
    $blogItem = [
        'title' => $strings['menu_title'],
        'description' => $strings['menu_subtitle'],
        'url' => $blogUrl,
    ];

    if (count($items) > 0) {
        array_splice($items, count($items) - 1, 0, [$blogItem]);
        return $items;
    }

    return [$blogItem];
}

function pk_is_menu_item_active(string $url): bool
{
    $fragment = (string) wp_parse_url($url, PHP_URL_FRAGMENT);
    $normalizedPath = pk_normalize_url_path($url);

    if ($normalizedPath === pk_normalize_url_path(pk_blog_url()) && pk_is_blog_context()) {
        return true;
    }

    if ($normalizedPath === pk_normalize_url_path(pk_lang_pricing_url()) && is_page_template('template-pricing.php')) {
        return true;
    }

    if ($fragment !== '' && is_front_page() && $normalizedPath === pk_normalize_url_path(pk_lang_home_url())) {
        return true;
    }

    return $normalizedPath === pk_normalize_url_path(home_url(add_query_arg([], $GLOBALS['wp']->request ?? '')));
}

function pk_post_views_meta_key(): string
{
    return 'pk_post_views';
}

function pk_increment_post_views(int $postId): void
{
    $metaKey = pk_post_views_meta_key();
    $views = (int) get_post_meta($postId, $metaKey, true);

    update_post_meta($postId, $metaKey, $views + 1);
}

function pk_get_recent_posts(int $count = 3, array $excludeIds = []): array
{
    return get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $count,
        'post__not_in' => $excludeIds,
        'ignore_sticky_posts' => true,
    ]);
}

function pk_get_popular_posts(int $count = 4, array $excludeIds = []): array
{
    $metaKey = pk_post_views_meta_key();
    $popularPosts = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $count,
        'post__not_in' => $excludeIds,
        'ignore_sticky_posts' => true,
        'meta_key' => $metaKey,
        'orderby' => [
            'meta_value_num' => 'DESC',
            'date' => 'DESC',
        ],
    ]);

    if (count($popularPosts) >= $count) {
        return $popularPosts;
    }

    $existingIds = array_map(static fn(WP_Post $post): int => (int) $post->ID, $popularPosts);
    $fallbackPosts = pk_get_recent_posts($count - count($popularPosts), array_merge($excludeIds, $existingIds));

    return array_values(array_merge($popularPosts, $fallbackPosts));
}

function pk_build_table_of_contents(string $content): array
{
    $items = [];
    $usedIds = [];
    $fallbackIndex = 1;

    $processedContent = preg_replace_callback('/<h([23])([^>]*)>(.*?)<\/h\1>/is', static function (array $matches) use (&$items, &$usedIds, &$fallbackIndex): string {
        $level = (int) $matches[1];
        $attributes = (string) $matches[2];
        $innerHtml = (string) $matches[3];
        $title = trim(wp_strip_all_tags(html_entity_decode($innerHtml, ENT_QUOTES | ENT_HTML5, 'UTF-8')));

        if ($title === '') {
            return $matches[0];
        }

        $id = '';
        if (preg_match('/\sid=(["\'])(.*?)\1/i', $attributes, $idMatch) === 1) {
            $id = sanitize_title($idMatch[2]);
        }

        if ($id === '') {
            $baseId = sanitize_title($title);
            if ($baseId === '') {
                $baseId = 'sekcja-' . $fallbackIndex;
                $fallbackIndex += 1;
            }

            $id = $baseId;
            $suffix = 2;
            while (in_array($id, $usedIds, true)) {
                $id = $baseId . '-' . $suffix;
                $suffix += 1;
            }

            $attributes .= ' id="' . esc_attr($id) . '"';
        }

        $usedIds[] = $id;
        $items[] = [
            'id' => $id,
            'title' => $title,
            'level' => $level,
        ];

        return '<h' . $level . $attributes . '>' . $innerHtml . '</h' . $level . '>';
    }, $content);

    return [
        'content' => is_string($processedContent) ? $processedContent : $content,
        'items' => $items,
    ];
}

function pk_get_post_author_note(WP_Post $post): array
{
    $strings = pk_blog_strings();
    $authorId = (int) $post->post_author;
    $authorName = $authorId > 0 ? get_the_author_meta('display_name', $authorId) : '';
    $authorName = is_string($authorName) && $authorName !== '' ? $authorName : 'Pani Kwiat';
    $authorDescription = $authorId > 0 ? trim((string) get_the_author_meta('description', $authorId)) : '';

    if ($authorDescription === '') {
        $authorDescription = sprintf($strings['author_fallback'], $authorName);
    }

    return [
        'title' => $strings['about_author'],
        'name' => $authorName,
        'description' => $authorDescription,
        'image' => pk_asset_url('panikwiat.jpg'),
    ];
}

function pk_fallback_menu_items(bool $pricingPage = false): array
{
    $defaults = pk_defaults();
    $lang = pk_current_lang();
    $home = trailingslashit(pk_lang_home_url($lang));
    $pricing = pk_lang_pricing_url($lang);

    $items = array_map(static function (array $item) use ($home, $pricing, $pricingPage): array {
        $href = (string) ($item['href'] ?? '#');

        if ($href === '/cennik') {
            $href = $pricing;
        } elseif ($href === '/#dekoracje' && $pricingPage) {
            $href = '#dekoracje';
        } elseif (str_starts_with($href, '/#')) {
            $href = $home . ltrim(substr($href, 1), '/');
        }

        return [
            'title' => (string) ($item['label'] ?? ''),
            'description' => (string) ($item['sub'] ?? ''),
            'url' => $href,
        ];
    }, $defaults['nav']['links']);

    return pk_with_blog_menu_item($items);
}

function pk_menu_items(bool $pricingPage = false): array
{
    $normalizeItems = static function (array $items): array {
        $normalized = array_map(static function (WP_Post $item): ?array {
            $title = trim(wp_specialchars_decode((string) $item->title));
            $description = trim(wp_specialchars_decode((string) $item->description));
            $url = trim((string) $item->url);

            if ($title === '' || $url === '') {
                return null;
            }

            return [
                'title' => $title,
                'description' => $description,
                'url' => $url,
            ];
        }, $items);

        return array_values(array_filter($normalized));
    };

    $currentLang = pk_current_lang();
    $localizedMenu = wp_get_nav_menu_object('Primary Navigation ' . strtoupper($currentLang));
    if ($localizedMenu instanceof WP_Term) {
        $items = wp_get_nav_menu_items($localizedMenu->term_id);
        if (is_array($items) && $items !== []) {
            $normalized = $normalizeItems($items);
            if ($normalized !== []) {
                return pk_with_blog_menu_item($normalized);
            }
        }
    }

    $locations = get_nav_menu_locations();
    $menuId = $locations['primary'] ?? null;

    if ($menuId) {
        $items = wp_get_nav_menu_items($menuId);
        if (is_array($items) && $items !== []) {
            $normalized = $normalizeItems($items);
            if ($normalized !== []) {
                return pk_with_blog_menu_item($normalized);
            }
        }
    }

    return pk_fallback_menu_items($pricingPage);
}

function pk_language_switcher(): array
{
    if (function_exists('pll_the_languages')) {
        $languages = pll_the_languages(['raw' => 1, 'hide_if_no_translation' => 0]);
        if (is_array($languages) && $languages !== []) {
            return array_map(static function (array $item): array {
                return [
                    'code' => strtoupper((string) ($item['slug'] ?? 'PL')),
                    'url' => (string) ($item['url'] ?? home_url('/')),
                    'current' => !empty($item['current_lang']),
                ];
            }, $languages);
        }
    }

    $currentLang = pk_current_lang();
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $basePath = preg_replace('#^/(en|de)(?=/|$)#', '', $uri);
    $basePath = $basePath === '' ? '/' : $basePath;

    return array_map(static function (string $lang) use ($currentLang, $basePath): array {
        $prefix = $lang === 'pl' ? '' : '/' . $lang;
        return [
            'code' => strtoupper($lang),
            'url' => home_url($prefix . $basePath),
            'current' => $lang === $currentLang,
        ];
    }, ['pl', 'en', 'de']);
}

function pk_header_strings(): array
{
    $defaults = pk_defaults();

    return [
        'question' => (string) pk_get_lang_option('pk_header_question', $defaults['header']['question']),
        'contact' => (string) pk_get_lang_option('pk_header_contact', $defaults['header']['contact']),
        'help' => (string) pk_get_lang_option('pk_footer_help', $defaults['footer']['help']),
        'copyright' => (string) pk_get_lang_option('pk_footer_copyright', $defaults['footer']['copyright']),
        'form_phone_heading' => (string) pk_get_lang_option('pk_form_phone_heading', $defaults['contactForm']['phoneHeading']),
        'form_heading' => (string) pk_get_lang_option('pk_form_heading', $defaults['contactForm']['formHeading']),
        'form_shortcode' => (string) pk_get_lang_option('pk_form_shortcode', ''),
    ];
}

function pk_contact_details(): array
{
    $defaults = pk_defaults();
    $contactForm = $defaults['contactForm'];
    $phone = (string) pk_get_option_field('pk_contact_phone', '+48 501 744 994');
    $email = (string) pk_get_option_field('pk_contact_email', 'panikwiat@gmail.com');

    return [
        'phone' => $phone,
        'phone_href' => 'tel:' . preg_replace('/[^0-9+]/', '', $phone),
        'email' => $email,
        'email_href' => 'mailto:' . $email,
        'labels' => [
            'name_label' => $contactForm['nameLabel'],
            'phone_label' => $contactForm['phoneLabel'],
            'email_label' => $contactForm['emailLabel'],
            'message_label' => $contactForm['messageLabel'],
            'name_placeholder' => $contactForm['namePlaceholder'],
            'phone_placeholder' => $contactForm['phonePlaceholder'],
            'email_placeholder' => $contactForm['emailPlaceholder'],
            'message_placeholder' => $contactForm['messagePlaceholder'],
            'consent' => $contactForm['consent'],
            'submit' => $contactForm['submit'],
        ],
    ];
}
