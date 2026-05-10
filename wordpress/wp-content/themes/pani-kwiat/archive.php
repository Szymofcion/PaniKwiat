<?php

declare(strict_types=1);

get_header();

$strings = pk_blog_strings();
$archiveTitle = get_the_archive_title();
$archiveDescription = trim(wp_strip_all_tags(get_the_archive_description()));
$popularPosts = pk_get_popular_posts(5);

get_template_part('template-parts/site', 'header');
?>

<section class="blog-hero" style="background-image: linear-gradient(90deg, rgba(21, 21, 21, 0.72), rgba(21, 21, 21, 0.28)), url('<?php echo esc_url(pk_asset_url('hero.jpg')); ?>');">
    <div class="container">
        <div class="blog-hero__content">
            <span class="blog-eyebrow"><?php echo esc_html($strings['menu_subtitle']); ?></span>
            <h1><?php echo esc_html($archiveTitle !== '' ? $archiveTitle : $strings['archive_title']); ?></h1>
            <p><?php echo esc_html($archiveDescription !== '' ? $archiveDescription : $strings['archive_intro']); ?></p>
        </div>
    </div>
</section>

<main class="blog-page">
    <div class="container">
        <div class="blog-archive">
            <div class="blog-archive__posts">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article <?php post_class('blog-card'); ?>>
                            <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                                <?php else : ?>
                                    <span class="blog-card__placeholder"></span>
                                <?php endif; ?>
                            </a>
                            <div class="blog-card__body">
                                <p class="blog-card__meta">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($strings['published_on']); ?> · <?php echo esc_html(pk_blog_date()); ?></time>
                                </p>
                                <h2 class="blog-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 34)); ?></p>
                                <a class="blog-card__link" href="<?php the_permalink(); ?>"><?php echo esc_html($strings['read_more']); ?></a>
                            </div>
                        </article>
                    <?php endwhile; ?>

                    <div class="blog-pagination">
                        <?php
                        the_posts_pagination([
                            'mid_size' => 1,
                            'prev_text' => '&larr;',
                            'next_text' => '&rarr;',
                        ]);
                        ?>
                    </div>
                <?php else : ?>
                    <div class="blog-empty">
                        <p><?php echo esc_html($strings['no_posts']); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="blog-sidebar">
                <section class="blog-widget">
                    <h2><?php echo esc_html($strings['popular_posts']); ?></h2>
                    <div class="blog-widget__posts">
                        <?php foreach ($popularPosts as $popularPost) : ?>
                            <article class="blog-mini-post">
                                <a class="blog-mini-post__media" href="<?php echo esc_url(get_permalink($popularPost)); ?>" aria-label="<?php echo esc_attr(get_the_title($popularPost)); ?>">
                                    <?php if (has_post_thumbnail($popularPost)) : ?>
                                        <?php echo get_the_post_thumbnail($popularPost, 'thumbnail', ['loading' => 'lazy']); ?>
                                    <?php else : ?>
                                        <span class="blog-mini-post__placeholder"></span>
                                    <?php endif; ?>
                                </a>
                                <div class="blog-mini-post__body">
                                    <h3><a href="<?php echo esc_url(get_permalink($popularPost)); ?>"><?php echo esc_html(get_the_title($popularPost)); ?></a></h3>
                                    <p><?php echo esc_html(pk_blog_date((int) $popularPost->ID)); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            </aside>
        </div>
    </div>
</main>

<?php
get_template_part('template-parts/site', 'footer');
get_footer();
