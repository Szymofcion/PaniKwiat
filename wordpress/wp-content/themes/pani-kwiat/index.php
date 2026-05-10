<?php

declare(strict_types=1);

get_header();
get_template_part('template-parts/site', 'header');
?>
<main class="container" style="padding:80px 15px;">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>
<?php
get_template_part('template-parts/site', 'footer');
get_footer();

