<?php

declare(strict_types=1);

get_header();

$defaults = pk_defaults();
$hero = [
    'heading' => (string) pk_get_page_field('pk_hero_heading', $defaults['hero']['heading']),
    'paragraph' => (string) pk_get_page_field('pk_hero_paragraph', $defaults['hero']['paragraph']),
    'contact_cta' => (string) pk_get_page_field('pk_hero_contact_cta', $defaults['hero']['contactCta']),
    'ready_cta' => (string) pk_get_page_field('pk_hero_ready_cta', $defaults['hero']['readyCta']),
    'learn_more' => (string) pk_get_page_field('pk_hero_learn_more', $defaults['hero']['learnMore']),
    'disclaimer' => (string) pk_get_page_field('pk_hero_disclaimer', $defaults['hero']['disclaimer']),
];
$mainTitle = (string) pk_get_page_field('pk_main_title', $defaults['main']['title']);
$viewPhotos = (string) pk_get_page_field('pk_view_photos_label', $defaults['main']['viewPhotos']);
$sections = pk_get_page_field('pk_offer_sections', $defaults['main']['sections']);
$cta = [
    'heading' => (string) pk_get_page_field('pk_cta_heading', $defaults['cta']['heading']),
    'subheading' => (string) pk_get_page_field('pk_cta_subheading', $defaults['cta']['subheading']),
    'button' => (string) pk_get_page_field('pk_cta_button', $defaults['cta']['button']),
];
$about = [
    'title' => (string) pk_get_page_field('pk_about_title', $defaults['about']['title']),
    'heading' => (string) pk_get_page_field('pk_about_heading', $defaults['about']['heading']),
    'image' => pk_media_url(pk_get_page_field('pk_about_image'), $defaults['about']['image']),
    'paragraphs' => pk_paragraph_lines(pk_get_page_field('pk_about_paragraphs'), $defaults['about']['paragraphs']),
    'contact_cta' => (string) pk_get_page_field('pk_about_contact_cta', $defaults['about']['contactCta']),
];
$opinions = [
    'heading' => (string) pk_get_page_field('pk_opinion_heading', $defaults['opinion']['heading']),
    'items' => pk_get_page_field('pk_opinion_items', $defaults['opinion']['items']),
];

get_template_part('template-parts/site', 'header');
?>
<section class="hero" style="background-image: url('<?php echo esc_url(pk_asset_url('hero.jpg')); ?>');" data-astro-cid-bbe6dxrz="">
    <div class="container" data-astro-cid-bbe6dxrz="">
        <div class="hero-wrapper" data-astro-cid-bbe6dxrz="">
            <div class="top-wrapper" data-astro-cid-bbe6dxrz="">
                <h1 data-astro-cid-bbe6dxrz=""><?php echo nl2br(esc_html($hero['heading'])); ?></h1>
                <hr data-astro-cid-bbe6dxrz="" />
                <p data-astro-cid-bbe6dxrz=""><?php echo esc_html($hero['paragraph']); ?></p>
            </div>
            <div class="bottom-wrapper" data-astro-cid-bbe6dxrz="">
                <button class="btn btn-white" type="button" data-dialog-target="pk-contact-modal" data-astro-cid-bbe6dxrz="">
                    <?php echo esc_html($hero['contact_cta']); ?>
                </button>
                <a href="<?php echo esc_url(pk_marketplace_url()); ?>" target="_blank" rel="noreferrer" class="btn btn-white-outline" data-astro-cid-bbe6dxrz="">
                    <?php echo esc_html($hero['ready_cta']); ?>
                </a>
            </div>
        </div>
    </div>
</section>
<section data-astro-cid-bbe6dxrz="">
    <div class="container" data-astro-cid-bbe6dxrz="">
        <div class="arrow-wrapper" data-astro-cid-bbe6dxrz="">
            <a href="#discamler" data-astro-cid-bbe6dxrz="">
                <span data-astro-cid-bbe6dxrz=""><?php echo esc_html($hero['learn_more']); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="216" height="212" viewBox="0 0 216 212" fill="none" data-astro-cid-bbe6dxrz="">
                    <line class="line-down" x1="7" y1="211.5" x2="216" y2="211.5" stroke="#8CAE6B" data-astro-cid-bbe6dxrz=""></line>
                    <circle cx="6.5" cy="6.5" r="6" transform="rotate(90 6.5 6.5)" stroke="white" data-astro-cid-bbe6dxrz=""></circle>
                    <line x1="6.5" y1="13" x2="6.5" y2="80" stroke="white" data-astro-cid-bbe6dxrz=""></line>
                    <line x1="6.5" y1="212" x2="6.49999" y2="80" stroke="#8CAE6B" data-astro-cid-bbe6dxrz=""></line>
                </svg>
            </a>
        </div>
        <h3 class="hero-discamler" id="discamler" data-astro-cid-bbe6dxrz="">
            <?php echo esc_html($hero['disclaimer']); ?>
        </h3>
    </div>
</section>

<main id="skomponuj">
    <div class="container">
        <h2><?php echo esc_html($mainTitle); ?></h2>
    </div>
    <div class="container" data-astro-cid-ivdev4kk="">
        <?php foreach ($sections as $sectionIndex => $section) : ?>
            <?php
            $list = pk_simple_list($section['list'] ?? [], []);
            $cards = is_array($section['cards'] ?? null) ? $section['cards'] : [];
            $mainImageDefault = is_string($section['main_image'] ?? null) ? $section['main_image'] : '';
            $mainGalleryDefault = array_values(array_filter((array) ($section['main_gallery'] ?? []), 'is_string'));
            $mainImage = pk_media_url($section['main_image'] ?? '', $mainImageDefault);
            $mainGallery = pk_gallery_urls($section['main_gallery'] ?? [], $mainGalleryDefault);
            ?>
            <div class="offer" data-astro-cid-ivdev4kk="">
                <div class="wrapper-container" data-astro-cid-ivdev4kk="">
                    <div class="wrapper" data-astro-cid-ivdev4kk="">
                        <h3 data-astro-cid-ivdev4kk="">
                            <span data-astro-cid-ivdev4kk=""><?php echo esc_html((string) ($section['numeral'] ?? '')); ?></span>
                            <?php echo esc_html((string) ($section['heading'] ?? '')); ?>
                        </h3>
                        <p data-astro-cid-ivdev4kk=""><?php echo esc_html((string) ($section['body'] ?? '')); ?></p>
                        <?php if (!empty($section['price_note'])) : ?>
                            <p data-astro-cid-ivdev4kk=""><?php echo esc_html((string) $section['price_note']); ?></p>
                        <?php endif; ?>
                        <?php if ($list !== []) : ?>
                            <ul data-astro-cid-ivdev4kk="">
                                <?php foreach ($list as $item) : ?>
                                    <li data-astro-cid-ivdev4kk=""><?php echo esc_html($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="wrapper-image" data-astro-cid-ivdev4kk="">
                        <?php if ($mainGallery !== []) : ?>
                            <?php $dialogId = 'pk-main-gallery-' . $sectionIndex; ?>
                            <div class="card" data-astro-cid-ivdev4kk="">
                                <div class="card-img-wrapper" data-astro-cid-ivdev4kk="">
                                    <img src="<?php echo esc_url($mainImage); ?>" decoding="async" loading="lazy" alt="" data-astro-cid-ivdev4kk="" width="700" height="500" />
                                    <div class="box" data-astro-cid-ivdev4kk="">
                                        <button class="btn-modal" type="button" data-dialog-target="<?php echo esc_attr($dialogId); ?>" data-astro-cid-qmzm2soj="">
                                            <?php echo esc_html($viewPhotos); ?>
                                        </button>
                                        <dialog id="<?php echo esc_attr($dialogId); ?>" data-astro-cid-qmzm2soj="">
                                            <article data-astro-cid-ivdev4kk="">
                                                <div class="swiper swiper-horizontal" data-astro-cid-ivdev4kk="">
                                                    <div class="swiper-wrapper" data-astro-cid-ivdev4kk="">
                                                        <?php foreach ($mainGallery as $galleryImage) : ?>
                                                            <div class="swiper-slide" data-astro-cid-ivdev4kk="">
                                                                <img src="<?php echo esc_url($galleryImage); ?>" alt="" data-astro-cid-ivdev4kk="" />
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="swiper-button-prev" data-astro-cid-ivdev4kk=""></div>
                                                    <div class="swiper-button-next" data-astro-cid-ivdev4kk=""></div>
                                                </div>
                                            </article>
                                            <form method="dialog" data-astro-cid-qmzm2soj="">
                                                <button type="submit" class="close-button" data-dialog-close data-astro-cid-ivdev4kk="">X</button>
                                            </form>
                                        </dialog>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <img src="<?php echo esc_url($mainImage); ?>" decoding="async" loading="lazy" alt="" data-astro-cid-ivdev4kk="" width="700" height="700" />
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($cards !== []) : ?>
                    <div class="card-wrapper" data-astro-cid-ivdev4kk="">
                        <?php foreach ($cards as $cardIndex => $card) : ?>
                            <?php
                            $cardImageDefault = is_string($card['cover_image'] ?? null) ? $card['cover_image'] : '';
                            $cardGalleryDefault = array_values(array_filter((array) ($card['gallery'] ?? []), 'is_string'));
                            $cardGallery = pk_gallery_urls($card['gallery'] ?? [], $cardGalleryDefault);
                            $cardImage = pk_media_url($card['cover_image'] ?? '', $cardImageDefault);
                            $cardDialogId = 'pk-card-' . $sectionIndex . '-' . $cardIndex;
                            ?>
                            <div class="card" data-astro-cid-ivdev4kk="">
                                <div class="card-img-wrapper" data-astro-cid-ivdev4kk="">
                                    <img src="<?php echo esc_url($cardImage); ?>" decoding="async" loading="lazy" class="card-img" alt="" data-astro-cid-ivdev4kk="" width="300" height="300" />
                                    <?php if ($cardGallery !== []) : ?>
                                        <div class="box" data-astro-cid-ivdev4kk="">
                                            <button class="btn-modal" type="button" data-dialog-target="<?php echo esc_attr($cardDialogId); ?>" data-astro-cid-qmzm2soj="">
                                                <?php echo esc_html($viewPhotos); ?>
                                            </button>
                                            <dialog id="<?php echo esc_attr($cardDialogId); ?>" data-astro-cid-qmzm2soj="">
                                                <article data-astro-cid-ivdev4kk="">
                                                    <div class="swiper swiper-horizontal" data-astro-cid-ivdev4kk="">
                                                        <div class="swiper-wrapper" data-astro-cid-ivdev4kk="">
                                                            <?php foreach ($cardGallery as $galleryImage) : ?>
                                                                <div class="swiper-slide" data-astro-cid-ivdev4kk="">
                                                                    <img src="<?php echo esc_url($galleryImage); ?>" alt="" data-astro-cid-ivdev4kk="" />
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="swiper-button-prev" data-astro-cid-ivdev4kk=""></div>
                                                        <div class="swiper-button-next" data-astro-cid-ivdev4kk=""></div>
                                                    </div>
                                                </article>
                                                <form method="dialog" data-astro-cid-qmzm2soj="">
                                                    <button type="submit" class="close-button" data-dialog-close data-astro-cid-ivdev4kk="">X</button>
                                                </form>
                                            </dialog>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h3 data-astro-cid-ivdev4kk=""><?php echo esc_html((string) ($card['title'] ?? '')); ?></h3>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="btn-wrapper" data-astro-cid-ivdev4kk="">
            <button class="btn btn-white" type="button" data-dialog-target="pk-contact-modal" data-astro-cid-fziqq5va="">
                <?php echo esc_html($hero['contact_cta']); ?>
            </button>
        </div>
    </div>
</main>

    <section id="dekoracje" class="cta" data-astro-cid-i344ymn4="">
        <div class="container" data-astro-cid-i344ymn4="">
            <div class="cta-wrapper" data-astro-cid-i344ymn4="">
                <h2 data-astro-cid-i344ymn4=""><?php echo esc_html($cta['heading']); ?></h2>
                <h3 data-astro-cid-i344ymn4=""><?php echo esc_html($cta['subheading']); ?></h3>
                <div class="btn-wrapper" data-astro-cid-i344ymn4="">
                    <a href="<?php echo esc_url(pk_marketplace_url()); ?>" target="_blank" rel="noreferrer" class="btn btn-primary" data-astro-cid-i344ymn4="">
                        <?php echo esc_html($cta['button']); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-me" id="kimjestem" data-astro-cid-v2cbyr3p="">
        <div class="container" data-astro-cid-v2cbyr3p="">
            <h2 data-astro-cid-v2cbyr3p=""><?php echo esc_html($about['title']); ?></h2>
            <div class="wrapper" data-astro-cid-v2cbyr3p="">
                <div class="image-wrapper" data-astro-cid-v2cbyr3p="">
                    <img src="<?php echo esc_url($about['image']); ?>" decoding="async" loading="lazy" alt="" data-astro-cid-v2cbyr3p="" width="800" height="800">
                </div>
                <div class="text-wrapper" data-astro-cid-v2cbyr3p="">
                    <h3 data-astro-cid-v2cbyr3p=""><?php echo esc_html($about['heading']); ?></h3>
                    <?php foreach ($about['paragraphs'] as $paragraph) : ?>
                        <p data-astro-cid-v2cbyr3p=""><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                    <button class="btn btn-white" type="button" data-dialog-target="pk-contact-modal" data-astro-cid-v2cbyr3p="">
                        <?php echo esc_html($about['contact_cta']); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="opinion-section" id="opinie" data-astro-cid-jveos4p6="">
        <div class="container" data-astro-cid-jveos4p6="">
            <h2 data-astro-cid-jveos4p6=""><?php echo esc_html($opinions['heading']); ?></h2>
            <div class="opinions-wrapper" data-astro-cid-jveos4p6="">
                <?php foreach ($opinions['items'] as $index => $item) : ?>
                    <div class="opinion div<?php echo esc_attr((string) ($index + 1)); ?>" data-astro-cid-jveos4p6="">
                        <h6 data-astro-cid-jveos4p6=""><?php echo esc_html((string) ($item['author'] ?? '')); ?></h6>
                        <p data-astro-cid-jveos4p6=""><?php echo esc_html((string) ($item['text'] ?? '')); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php get_template_part('template-parts/contact', 'modal'); ?>
<?php get_template_part('template-parts/site', 'footer'); ?>
<?php get_footer(); ?>
