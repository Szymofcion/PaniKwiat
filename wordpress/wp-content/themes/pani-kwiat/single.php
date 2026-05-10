<?php

declare(strict_types=1);

get_header();

$strings = pk_blog_strings();

get_template_part('template-parts/site', 'header');

while (have_posts()) :
    the_post();

    $postContent = apply_filters('the_content', get_the_content());
    $tableOfContents = pk_build_table_of_contents($postContent);
    $latestPosts = pk_get_recent_posts(3, [get_the_ID()]);
    $authorNote = pk_get_post_author_note(get_post());
    $previousPost = get_previous_post();
    $nextPost = get_next_post();
    $heroImage = pk_asset_url('footer.jpg');
    ?>

    <section class="blog-post-hero" style="background-image: linear-gradient(90deg, rgba(21, 21, 21, 0.72), rgba(21, 21, 21, 0.28)), url('<?php echo esc_url($heroImage); ?>');">
        <div class="container">
            <div class="blog-post-hero__content">
                <a class="blog-back-link" href="<?php echo esc_url(pk_blog_url()); ?>">&larr; <?php echo esc_html($strings['menu_title']); ?></a>
                <p class="blog-post-hero__meta">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($strings['published_on']); ?> · <?php echo esc_html(pk_blog_date()); ?></time>
                </p>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <main class="blog-page blog-page--single">
        <div class="container">
            <div class="blog-single">
                <article <?php post_class('blog-article'); ?>>
                    <section class="blog-widget blog-widget--toc blog-widget--toc-top">
                        <h2><?php echo esc_html($strings['table_of_contents']); ?></h2>
                        <?php if ($tableOfContents['items'] !== []) : ?>
                            <ul class="blog-toc">
                                <?php foreach ($tableOfContents['items'] as $item) : ?>
                                    <li class="blog-toc__item blog-toc__item--level-<?php echo esc_attr((string) $item['level']); ?>">
                                        <a href="#<?php echo esc_attr($item['id']); ?>"><?php echo esc_html($item['title']); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <p class="blog-widget__note"><?php echo esc_html($strings['toc_empty']); ?></p>
                        <?php endif; ?>
                    </section>

                    <div class="blog-article__content">
                        <?php echo $tableOfContents['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>

                    <nav class="blog-post-navigation" aria-label="Post navigation">
                        <?php if ($previousPost instanceof WP_Post) : ?>
                            <a class="blog-post-navigation__item" href="<?php echo esc_url(get_permalink($previousPost)); ?>">
                                <span><?php echo esc_html($strings['previous_post']); ?></span>
                                <strong><?php echo esc_html(get_the_title($previousPost)); ?></strong>
                            </a>
                        <?php endif; ?>

                        <?php if ($nextPost instanceof WP_Post) : ?>
                            <a class="blog-post-navigation__item blog-post-navigation__item--next" href="<?php echo esc_url(get_permalink($nextPost)); ?>">
                                <span><?php echo esc_html($strings['next_post']); ?></span>
                                <strong><?php echo esc_html(get_the_title($nextPost)); ?></strong>
                            </a>
                        <?php endif; ?>
                    </nav>
                </article>

                <aside class="blog-sidebar blog-sidebar--single">
                    <section class="blog-widget">
                        <h2><?php echo esc_html($strings['latest_posts']); ?></h2>
                        <div class="blog-widget__posts">
                            <?php foreach ($latestPosts as $latestPost) : ?>
                                <article class="blog-mini-post">
                                    <a class="blog-mini-post__media" href="<?php echo esc_url(get_permalink($latestPost)); ?>" aria-label="<?php echo esc_attr(get_the_title($latestPost)); ?>">
                                        <?php if (has_post_thumbnail($latestPost)) : ?>
                                            <?php echo get_the_post_thumbnail($latestPost, 'thumbnail', ['loading' => 'lazy']); ?>
                                        <?php else : ?>
                                            <span class="blog-mini-post__placeholder"></span>
                                        <?php endif; ?>
                                    </a>
                                    <div class="blog-mini-post__body">
                                        <h3><a href="<?php echo esc_url(get_permalink($latestPost)); ?>"><?php echo esc_html(get_the_title($latestPost)); ?></a></h3>
                                        <p><?php echo esc_html(pk_blog_date((int) $latestPost->ID)); ?></p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section class="blog-widget blog-author-note">
                        <h2><?php echo esc_html($authorNote['title']); ?></h2>
                        <div class="blog-author-note__card">
                            <img src="<?php echo esc_url($authorNote['image']); ?>" alt="<?php echo esc_attr($authorNote['name']); ?>" loading="lazy" />
                            <div>
                                <h3><?php echo esc_html($authorNote['name']); ?></h3>
                                <p><?php echo esc_html($authorNote['description']); ?></p>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </main>

    <?php
endwhile;

get_template_part('template-parts/site', 'footer');
get_footer();
