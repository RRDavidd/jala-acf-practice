<?php get_header(); ?>

<main class="site-main">
    <div class="wrap wrap-p">

        <?php get_template_part( 'inc/partials/breadcrumbs' ); ?>

        <h1><?php jdf_the_page_title(); ?></h1>

        <?php if ( have_posts() ): ?>

        <div class="listing cols-grid same-height">
            <?php
            while ( have_posts() ): the_post();

                get_template_part( 'inc/partials/post-item', get_post_type() );

            endwhile;
            ?>
        </div>

        <?php else: ?>

        <h2>No posts were found.</h2>

        <?php endif; ?>

        <?php get_template_part( 'inc/partials/navigation' ); ?>

    </div>
</main>

<?php get_footer(); ?>