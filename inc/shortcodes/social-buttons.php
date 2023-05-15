<?php
// Add Shortcode
function social_buttons( $args ) {

	// Example
	// [social_buttons social_types='facebook twitter linkedin email']
	// Options:
	// - social_type: facebook, twitter, linkedin, email

	// Attributes.
	$args = shortcode_atts(
        array(
            'social_types' 	=> ''
        ),
        $args,
        'social_buttons'
    );

	global $post;
	$social_types = $args[ 'social_types' ];
	$social_types = explode( ' ', $social_types );
	$post_url = esc_url( get_permalink( $post->ID ) );
	$post_title = get_the_title( $post->ID );

    $buttons = '';

	foreach ( $social_types as $social_type ) {

		$social_type = strtolower( $social_type );

		switch ( $social_type ) {
			case 'facebook':
				$link = str_replace( ' ', '%20', 'https://www.facebook.com/sharer.php?display=popup&u=' . $post_url );
                $social_name = 'Facebook';
				break;
			case 'twitter':
				$link = str_replace( ' ', '%20', 'https://twitter.com/share?url=' . $post_url . '&text=' . $post_title );
                $social_name = 'Twitter';
				break;
			case 'linkedin':
				$link = str_replace( ' ', '%20', 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title );
                $social_name = 'LinkedIn';
				break;
			case 'email':
				$link = str_replace( ' ', '%20', 'mailto:?subject=' . $post_title . '&body=Check out this site: '. $post_url );
                $social_name = 'Email';
				break;
		}

		// Create the class for the buttons.
        $class = ( $social_types !== 'email' ? 'btn popup' : 'btn' );

		// Create the buttons based on the variables above.
        $buttons .= sprintf(
            '<a class="%1$s" href="%2$s" title="Share on %3$s" aria-label="Share on %3$s"><span>%4$s</span>%3$s</a>',
            $class,
            $link,
            $social_name,
            jdf_get_svg( $social_type, 'images/social-icons' )
        );

	}

    // Return the buttons.
    return ( !empty( $buttons ) ? sprintf( '<div class="social-share-buttons">%s</div>', $buttons ) : false );

}
add_shortcode( 'social_buttons', 'social_buttons' );