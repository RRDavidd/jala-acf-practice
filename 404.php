<?php get_header(); ?>

<main class="site-main">
	<div class="wrap wrap-p">

        <h1>Page Not Found</h1>

        <?php 
        // Check if the referrer is set and that it is not equal to the homepage.
        // We also want to check whether the referrer is a 404 to prevent users from being stuck in a loop.
        $handle = curl_init( wp_get_referer() );
        // Retrieve the header of the referrer page to evaluate server response.
        curl_setopt( $handle, CURLOPT_NOBODY, TRUE );
        $response_code = curl_getinfo( $handle, CURLINFO_HTTP_CODE );
        $not_404 = ( $response_code !== 404 ? true : false );
        curl_close( $handle );

        if ( !empty( wp_get_referer() ) && wp_get_referer() !== home_url( '/' ) && $not_404 ) {
            $content = sprintf(
                'Please <a href="%s">return to the previous page</a> or <a href="%s">return home</a>.',
                wp_get_referer(),
                home_url( '/' )
            );
        } else {
            $content = sprintf(
                'Please <a href="%s">return home</a>.',
                home_url( '/' )
            );
        }
        printf(
            '<p>Unfortunately, the requested page does not exist. %s</p>',
            $content
        )
        ?>

	</div>
</main>

<?php get_footer(); ?>