<?php get_header(); ?>

<main class="site-main <?php if ( is_front_page() ) echo 'block-pt'; ?>">

    <?php if ( !is_front_page() ): ?>

        <div class="wrap wrap-p">
            <?php get_template_part( 'inc/partials/breadcrumbs' ); ?>
            <h1><?php the_title(); ?></h1>
        </div>

    <?php endif; ?>

    <?php // Check if the page is password protected
        if ( post_password_required() ) {
            echo '<div class="wrap">';
            echo get_the_password_form();
            echo '</div><!--wrap-->';
        } else {
            echo '<div class="blocks-container-wrapper">';
            get_template_part( 'inc/partials/blocks' );
            echo '</div><!--blocks-container-wrapper-->';
        }
    ?>

</main>

<?php get_footer(); ?>