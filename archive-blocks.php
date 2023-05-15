<?php
// Blocks Archive Template

// Redirect to the homepage if the current user is not an administrator or view blocks param is not set.
if ( !current_user_can( 'manage_options' ) && !jdf_is_staging() ) {
    if ( !jdf_is_staging() && !isset( $_GET[ 'view-blocks' ] ) ) {
        wp_redirect( home_url( '/' ) );
        exit;
    }
}
?>

<?php get_header(); ?>

<main class="site-main">
    <div class="wrap">

        <div class="wrap-p">
            <?php get_template_part( 'inc/partials/breadcrumbs' ); ?>
            <h1><?php jdf_the_page_title(); ?></h1>
        </div>

        <?php
        $posts = get_posts(
            array(
                'numberposts'   => -1,
                'post_type'     => 'blocks',
                'orderby'       => 'title',
                'order'         => 'ASC'
            )
        );

        if ( $posts ):

            echo '<div class="blocks-container-wrapper">';

            foreach ( $posts as $post ):

                // Check if the post is password protected.
                if ( post_password_required() ) {

                    printf(
                        '<div class="wrap-p">%s</div>',
                        get_the_password_form()
                    );

                } else {

                    get_template_part( 'inc/partials/blocks' );

                }

            endforeach;

            echo '</div>';

        else:

            echo '<h2>No posts were found.</h2>';

        endif;
        ?>

    </div>
</main>

<?php get_footer(); ?>