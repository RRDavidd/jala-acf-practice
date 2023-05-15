<?php // Single Blocks Template

// Redirect to the homepage if the current user is not an administrator or view blocks param is not set.
if ( !current_user_can( 'manage_options' ) && !jdf_is_staging() ) {
    if ( !jdf_is_staging() && !isset( $_GET[ 'view-blocks' ] ) ) {
        wp_redirect( home_url( '/' ) );
        exit;
    }
}
?>

<?php get_template_part( 'page' ) ?>