<?php

declare(strict_types=1);

function pk_range_paths(string $prefix, int $from, int $to): array
{
    $paths = [];
    for ($index = $from; $index <= $to; $index += 1) {
        $paths[] = $prefix . '/' . $index . '.jpg';
    }

    return $paths;
}

function pk_site_copy(): array
{
    static $cache = null;

    if ($cache === null) {
        $json = file_get_contents(__DIR__ . '/site-copy.json');
        $cache = is_string($json) ? json_decode($json, true, 512, JSON_THROW_ON_ERROR) : [];
    }

    return $cache;
}

function pk_pricing_copy(): array
{
    static $cache = null;

    if ($cache === null) {
        $json = file_get_contents(__DIR__ . '/pricing-copy.json');
        $cache = is_string($json) ? json_decode($json, true, 512, JSON_THROW_ON_ERROR) : [];
    }

    return $cache;
}

function pk_offer_media_map(): array
{
    return [
        [
            'main_image' => 'slubne/dekoracje.jpg',
            'main_gallery' => [],
            'cards' => [
                [
                    'cover_image' => 'slubne/bukiety.jpg',
                    'gallery' => pk_range_paths('galeria/dekoracje-slubne/bukiety-slubne', 1, 20),
                ],
                [
                    'cover_image' => 'slubne/wystroj.jpg',
                    'gallery' => pk_range_paths('galeria/dekoracje-slubne/wystroj-sal', 1, 29),
                ],
                [
                    'cover_image' => 'slubne/wianki.jpg',
                    'gallery' => pk_range_paths('galeria/dekoracje-slubne/wianki-z-zywych-kwiatow', 1, 3),
                ],
                [
                    'cover_image' => 'slubne/wianki-dla-zwierzat.jpg',
                    'gallery' => pk_range_paths('galeria/dekoracje-slubne/ozdoby-wianki-dla-zwierzat', 1, 3),
                ],
            ],
        ],
        [
            'main_image' => 'ringi/ringi-wience-serca.jpg',
            'main_gallery' => pk_range_paths('galeria/ringi', 1, 21),
            'cards' => [],
        ],
        [
            'main_image' => 'wiazki/wiazki.jpg',
            'main_gallery' => [],
            'cards' => [
                [
                    'cover_image' => 'wiazki/wience.jpg',
                    'gallery' => pk_range_paths('galeria/wiazanki-pogrzebowe/wiazanki-pogrzebowe', 1, 15),
                ],
                [
                    'cover_image' => 'wiazki/serca-lub-krzyze.jpg',
                    'gallery' => pk_range_paths('galeria/wiazanki-pogrzebowe/serca-kwiatowe', 1, 2),
                ],
                [
                    'cover_image' => 'wiazki/aranzacje.jpg',
                    'gallery' => pk_range_paths('galeria/wiazanki-pogrzebowe/aranzacje-na-trumne', 1, 2),
                ],
            ],
        ],
        [
            'main_image' => 'pozostale.jpg',
            'main_gallery' => pk_range_paths('galeria/pozostale-dekoracje', 1, 32),
            'cards' => [],
        ],
    ];
}

function pk_defaults_for_lang(string $lang): array
{
    $copy = pk_site_copy()[$lang] ?? pk_site_copy()['pl'];
    $mediaMap = pk_offer_media_map();
    $sections = [];

    foreach (($copy['main']['sections'] ?? []) as $index => $section) {
        $cards = [];
        $defaultCards = $mediaMap[$index]['cards'] ?? [];

        foreach (($section['cards'] ?? []) as $cardIndex => $cardTitle) {
            $cards[] = [
                'title' => $cardTitle,
                'cover_image' => $defaultCards[$cardIndex]['cover_image'] ?? '',
                'gallery' => $defaultCards[$cardIndex]['gallery'] ?? [],
            ];
        }

        $sections[] = [
            'numeral' => $section['numeral'] ?? '',
            'heading' => $section['heading'] ?? '',
            'body' => $section['body'] ?? '',
            'price_note' => $section['priceNote'] ?? '',
            'main_image' => $mediaMap[$index]['main_image'] ?? '',
            'main_gallery' => $mediaMap[$index]['main_gallery'] ?? [],
            'cards' => $cards,
            'list' => $section['list'] ?? [],
        ];
    }

    return [
        'meta' => $copy['meta'],
        'nav' => $copy['nav'],
        'header' => $copy['header'],
        'hero' => $copy['hero'],
        'contactForm' => $copy['contactForm'],
        'cta' => $copy['cta'],
        'about' => [
            ...$copy['about'],
            'image' => 'panikwiat.jpg',
        ],
        'main' => [
            'title' => $copy['main']['title'],
            'viewPhotos' => $copy['main']['viewPhotos'],
            'sections' => $sections,
        ],
        'opinion' => $copy['opinion'],
        'footer' => $copy['footer'],
    ];
}

function pk_pricing_defaults_for_lang(string $lang): array
{
    $copy = pk_pricing_copy()[$lang] ?? pk_pricing_copy()['pl'];

    return [
        ...$copy,
        'background_image' => 'footer.jpg',
    ];
}

