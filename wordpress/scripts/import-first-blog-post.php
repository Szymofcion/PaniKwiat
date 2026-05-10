<?php

if (!defined('ABSPATH')) {
    exit(1);
}

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$sourceDir = '/blog-import/pierwszy wpis';

if (!is_dir($sourceDir)) {
    WP_CLI::error(sprintf('Missing import directory: %s', $sourceDir));
}

function pk_import_blog_image(string $path): int
{
    $sourceKey = 'first-blog-post/' . basename($path);
    $existing = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'meta_key' => '_pk_blog_import_source',
        'meta_value' => $sourceKey,
        'no_found_rows' => true,
    ]);

    if (is_array($existing) && $existing !== []) {
        return (int) $existing[0];
    }

    $contents = file_get_contents($path);
    if ($contents === false) {
        WP_CLI::error(sprintf('Cannot read image: %s', $path));
    }

    $upload = wp_upload_bits(sanitize_file_name(basename($path)), null, $contents);
    if (!empty($upload['error'])) {
        WP_CLI::error(sprintf('Upload failed for %s: %s', $path, $upload['error']));
    }

    $filetype = wp_check_filetype($upload['file']);
    $attachmentId = wp_insert_attachment([
        'post_mime_type' => $filetype['type'] ?? 'image/jpeg',
        'post_title' => sanitize_text_field(pathinfo($path, PATHINFO_FILENAME)),
        'post_status' => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachmentId) || !is_numeric($attachmentId)) {
        WP_CLI::error(sprintf('Attachment insert failed for %s', $path));
    }

    $attachmentId = (int) $attachmentId;
    $metadata = wp_generate_attachment_metadata($attachmentId, $upload['file']);
    if (is_array($metadata)) {
        wp_update_attachment_metadata($attachmentId, $metadata);
    }

    update_post_meta($attachmentId, '_pk_blog_import_source', $sourceKey);

    return $attachmentId;
}

function pk_import_paragraph(string $text): string
{
    return '<!-- wp:paragraph -->' . "\n" . '<p>' . esc_html($text) . '</p>' . "\n" . '<!-- /wp:paragraph -->';
}

$imageFiles = [
    'IMG_3023 (1).jpg',
    'IMG_3025 (1).jpg',
    'IMG_3037 (1).jpg',
    'IMG_3047 (1).jpg',
    'IMG_3107.jpg',
    'IMG_3118.jpg',
    'IMG_3529.jpg',
    'IMG_3532.jpg',
    'IMG_3544.jpg',
    'IMG_3552.jpg',
    'IMG_4897.jpg',
];

$imageIds = [];
foreach ($imageFiles as $imageFile) {
    $imagePath = $sourceDir . '/' . $imageFile;
    if (!is_file($imagePath)) {
        WP_CLI::warning(sprintf('Missing image: %s', $imageFile));
        continue;
    }

    $imageIds[] = pk_import_blog_image($imagePath);
}

$paragraphs = [
    'Święta Wielkiej Nocy już za nami. Całe zamieszanie przed nimi, ruch, pośpiech już minęły. To one dla mnie co roku odmierzają czas nadejścia wiosny.',
    'Rozpoczyna się kolejny okres w roku, który nazywam przebudzeniem. Wiąże się on nie tylko z faktem powoli rozpoczynającej się wiosny, ale również z coraz bardziej intensywnym czasem w pracy florysty.',
    'Tak jak w przyrodzie życie rozkwita. Na drzewach kwiaty i pąki liści. W lasach i ogrodach wczesnowiosenne kwiaty już dawno pokazały swoje kolory. Ptaki budują gniazda, a niektóre z nich już karmią młode.',
    'Za chwilę maj, czas komunii, ślubów i pięknego święta Dnia Mamy. Jako florystka mam coraz więcej zamówień, pytań i spotkań z klientami. Omawiam koncepcje i przygotowuję kosztorysy na wspomniane wyżej wydarzenia. W mojej głowie powstają pomysły na nowe kompozycje.',
    'Po długiej zimie, braku słońca, to najprzyjemniejszy okres w roku, zaraz po przyjemności wyjazdów wakacyjnych i związanych z nimi przygodami.',
    'Na giełdzie kwiatowej pojawiają się kolejne sezonowe kwiaty, które wypierają lubiane przez wszystkich tulipany, hiacynty i żonkile. Dominują kolory wiosny. Słonecznie żółty, niebieski i biały. Można kupić coraz więcej kwiatów uprawianych u nas w Polsce, oprócz tych sprowadzanych z zagranicy.',
    'Nastawienie kupujących jest również bardziej optymistyczne. Ludzie cieszą się nadejściem kolejnej wiosny i lata.',
    'Długie lata obserwowałam wiosnę i jej rozpoczęcie w Australii. Oto kilka zdjęć z moich podróży po Polsce i Brisbane.',
];

$contentBlocks = [
    '<!-- wp:heading {"level":2} -->' . "\n" . '<h2>Przebudzenie po zimie</h2>' . "\n" . '<!-- /wp:heading -->',
];

foreach ($paragraphs as $paragraph) {
    $contentBlocks[] = pk_import_paragraph($paragraph);
}

if ($imageIds !== []) {
    $contentBlocks[] = '<!-- wp:gallery {"ids":[' . implode(',', $imageIds) . '],"linkTo":"media"} -->' . "\n" . '<figure class="wp-block-gallery has-nested-images columns-default is-cropped">';
    foreach ($imageIds as $imageId) {
        $imageUrl = wp_get_attachment_image_url($imageId, 'large');
        if (!is_string($imageUrl) || $imageUrl === '') {
            continue;
        }

        $contentBlocks[] = '<!-- wp:image {"id":' . $imageId . ',"sizeSlug":"large","linkDestination":"media"} -->'
            . "\n" . '<figure class="wp-block-image size-large"><a href="' . esc_url(wp_get_attachment_url($imageId)) . '"><img src="' . esc_url($imageUrl) . '" alt="" class="wp-image-' . $imageId . '"/></a></figure>'
            . "\n" . '<!-- /wp:image -->';
    }
    $contentBlocks[] = '</figure>' . "\n" . '<!-- /wp:gallery -->';
}

$existingPosts = get_posts([
    'post_type' => 'post',
    'post_status' => ['publish', 'draft', 'pending', 'private', 'future'],
    'posts_per_page' => -1,
    'fields' => 'ids',
]);

foreach ($existingPosts as $postId) {
    wp_delete_post((int) $postId, true);
}

$postId = wp_insert_post([
    'post_type' => 'post',
    'post_status' => 'publish',
    'post_title' => 'Przebudzenie',
    'post_name' => 'przebudzenie',
    'post_excerpt' => 'Wiosna, sezonowe kwiaty i pierwsze przygotowania do komunii, ślubów oraz Dnia Mamy.',
    'post_content' => implode("\n\n", $contentBlocks),
]);

if (is_wp_error($postId) || !is_numeric($postId)) {
    WP_CLI::error('Could not create the blog post.');
}

if ($imageIds !== []) {
    set_post_thumbnail((int) $postId, $imageIds[0]);
}

if (function_exists('pll_set_post_language')) {
    pll_set_post_language((int) $postId, 'pl');
}

WP_CLI::success(sprintf('Imported blog post #%d: Przebudzenie', (int) $postId));
