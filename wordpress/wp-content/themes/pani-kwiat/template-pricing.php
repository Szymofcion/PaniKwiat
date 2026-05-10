<?php
/*
Template Name: Pricing Page
*/

declare(strict_types=1);

get_header();

$defaults = pk_pricing_defaults();
$pricing = [
    'heading' => (string) pk_get_page_field('pk_pricing_heading', $defaults['heading']),
    'intro' => (string) pk_get_page_field('pk_pricing_intro', $defaults['intro']),
    'cta_heading' => (string) pk_get_page_field('pk_pricing_cta_heading', $defaults['cta']['heading']),
    'cta_subheading' => (string) pk_get_page_field('pk_pricing_cta_subheading', $defaults['cta']['subheading']),
    'cta_button' => (string) pk_get_page_field('pk_pricing_cta_button', $defaults['cta']['button']),
];

get_template_part('template-parts/site', 'header');
?>
<main class="pricing-page-main">
    <section id="cennik" class="pricing" data-astro-cid-k5tfkyl3>
        <div class="pricing-head" data-astro-cid-k5tfkyl3>
            <h1 data-astro-cid-k5tfkyl3><?php echo esc_html($pricing['heading']); ?></h1>
            <p class="intro" data-astro-cid-k5tfkyl3><?php echo esc_html($pricing['intro']); ?></p>
        </div>
    </section>

    <section id="dekoracje" class="cta" data-astro-cid-i344ymn4="">
        <div class="container" data-astro-cid-i344ymn4="">
            <div class="cta-wrapper" data-astro-cid-i344ymn4="">
                <h2 data-astro-cid-i344ymn4=""><?php echo esc_html($pricing['cta_heading']); ?></h2>
                <h3 data-astro-cid-i344ymn4=""><?php echo esc_html($pricing['cta_subheading']); ?></h3>
                <div class="btn-wrapper" data-astro-cid-i344ymn4="">
                    <a href="<?php echo esc_url(pk_marketplace_url()); ?>" target="_blank" rel="noreferrer" class="btn btn-primary" data-astro-cid-i344ymn4="">
                        <?php echo esc_html($pricing['cta_button']); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_template_part('template-parts/site', 'footer'); ?>
<?php get_footer(); ?>
