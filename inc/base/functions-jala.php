<?php
// Template Functions

// UTILITY TEMPLATE FUNCTIONS:

// Jala admin function.
function is_jala_admin() {
	$user = wp_get_current_user();
	if ( ( strpos( $user->user_email, '@jaladesign.com.au' ) !== false ) && in_array( 'administrator', $user->roles ) ) {
		return true;
	} else {
		return false;
	}
}

// Protected and styled var_dump for debugging.
function var_dump_pre( $data = null, $label = null, $public = false ) {
	// Allow for function to be used publicly for non-Jala admin testing.
    if ( $public ) {
        $access = true;
    } else {
        $access = ( is_jala_admin() ? true : false );
    }

    // Escape early if output won't be rendered.
    if ( !$access ) return false;

    ob_start();
    var_dump( $data );
    $data = ob_get_clean();

    printf(
        '<div class="jala-whitepearl-debug%s">%s<pre>%s</pre></div>',
        ( $public && !is_jala_admin() ? ' jala-whitepearl-debug-public' : '' ),
        ( $label !== null ? '<p>' . trim( $label ) . '</p>' : '' ),
        htmlspecialchars( $data, ENT_QUOTES )
    );

    return true;
}


// Internal exception handler.
class customException extends Exception {
    public function error( $message, $detailed = false ) {

        // Only show errors if user is a Jala admin.
        if ( is_jala_admin() ) {

            // Generate trace.
            $trace = $this->getTrace();
            foreach ( $trace as $trace_item ) {
                if ( !empty( $trace_item[ 'function' ] ) && $trace_item[ 'function' ] !== 'jdf_handle_exception' ) {
                    $trace = $trace_item;
                    break;
                }
            }

            $error_environment = sprintf(
                '<p>Error on line <strong>%s</strong> in <strong>%s</strong></p>',
                $trace[ 'line' ],
                $trace[ 'file' ]
            );

            $error_message = sprintf(
                '<p>%s%s.</p>',
                ( $detailed ? '<strong>' . $trace[ 'function' ] . '</strong>: ' : '' ) ,
                rtrim( $message, '.' )
            );
            $error = sprintf(
                '<div class="jala-whitepearl-error"><p class="jala-whitepearl-error-title">Jala WhitePearl Error <span>(this is only visible to Jala admins)</span></p>%s%s</div>',
                ( $detailed ? $error_environment : '' ),
                $error_message
            );
            return $error;

        } else {

            return null;

        }

    }
}

// Advanced exception for more in-depth output.
function jdf_handle_exception( $message = '', $condition = true, $detailed = true ) {

    try {
        // Fail if passed condition is true (meaning an exception is to be thrown).
        if ( $condition ) {
            throw new customException( $condition );
        }
    } catch ( customException $e ) {
        echo $e->error( $message, $detailed );
    }

    return true;

}

// Simple exception for basic output.
function jdf_simple_exception( $message = '' ) {

    try {
        if ( true ) {
            throw new customException( true );
        }
    } catch ( customException $e ) {
        echo $e->error( $message );
    }

    return true;

}



// Create attributes.
function jdf_create_attributes( $default_attributes = null, $attributes = null ) {

    // Check for $default_attributes.
    if ( empty( $default_attributes ) || !is_array( $default_attributes ) ) {
        jdf_simple_exception( '$default_attributes is required and must be a non-empty associative array.' );
        return false;
    }

    // Check $attributes is an associative if it's not empty.
    if ( !empty( $attributes ) && !is_array( $attributes ) ) {
        jdf_simple_exception( '$attributes is required and must be a non-empty associative array.' );
        return false;
    }

    // Create empty array to contain final output.
    $rendered_attributes = array();

    // Process $default_attributes.
    foreach ( $default_attributes as $default_attribute => $default_value ) {

        // If no attribute is passed, assume the value is the attribute.
        if ( is_int( $default_attribute ) && !empty( $default_value ) ) {
            $default_attribute = $default_value;
            $default_value = null;
        }

        // Process $attributes if conflicting attribute exist.
        if ( !empty( $attributes ) && is_array( $attributes ) && isset( $attributes[ $default_attribute ] ) && $attributes[ $default_attribute ] !== null ) {

            // Get the value from the $attributes. Attribute context is given from the $default_attribute.
            $value = $attributes[ $default_attribute ];

            // If the value for the conflicting attribute is false, flag this attribute to be excluded from final output.
            if ( $value === false ) {

                $default_attribute = false;
                continue;

            };

            // If the value passed is a string (or numerical to become a string), evaluate its contents and potentially back-merge with default attribute value.
            if ( is_string( $value ) || is_numeric( $value ) ) {

                // Cast $value to a string regardless of type.
                $value = (string) $value;

                // Back-merge if replacement character is used.
                if ( strpos( $value, '%%' ) !== false ) {
                    $default_value = str_replace( '%%', $default_value, $value );
                } else {
                    $default_value = $value;
                }

            }

            // Remove this attribute from the $attributes array so it isn't looped over again further below.
            unset( $attributes[ $default_attribute ] );

        }

        // Add filtered attribute into final output for rendering.
        if ( $default_attribute !== false ) {
            $rendered_attributes += [ $default_attribute => $default_value ];
        }

    }

    // Process remaining $attributes if they exist.
    if ( !empty( $attributes ) && is_array( $attributes ) ) {

        foreach ( $attributes as $attribute => $value ) {

            if ( $value === false ) continue;

            // Strip rogue replacement characters.
            $value = str_replace( '%%', '', $value );

            // If no attribute is passed, assume the value is the attribute.
            if ( is_int( $attribute ) && !empty( $value ) ) {
                $attribute = $value;
                $value = null;
            }

            // Add filtered attribute into final output for rendering.
            $rendered_attributes += [ $attribute => $value ];

        }

    }

    // Now merge the $rendered_attributes array into a HTML string of attributes.
    if ( !empty( $rendered_attributes ) ) {

        // Prepare empty string for merge.
        $rendered_output = '';

        foreach ( $rendered_attributes as $rendered_attribute => $rendered_value ) {

            $rendered_output .= sprintf(
                '%s%s ',
                ( !empty( $rendered_attribute ) ? trim( $rendered_attribute ) : '' ),
                ( is_string( $rendered_value ) ? '="' . esc_attr( trim( $rendered_value ) ) . '"' : '' )
            );

        }

        return trim( $rendered_output );

    } else {

        return false;

    }

}

// Check if current environment is staging.
function jdf_is_staging() {
    return ( isset( getenv()[ 'WP_ENVIRONMENT_TYPE' ] ) && getenv()[ 'WP_ENVIRONMENT_TYPE' ] === 'staging' ? true : false );
}

// MAIN TEMPLATE FUNCTIONS:

// Generate page title based on page type.
function jdf_get_page_title() {

    if ( is_category() ) return single_cat_title( '', false );
    else if ( is_tag() ) return single_tag_title( '', false );
    else if ( is_tax() ) return single_term_title( '', false );
    else if ( is_home() ) return get_the_title( get_option( 'page_for_posts', true ) );
    else if ( is_author() ) return 'Author';
    else if ( is_search() ) return 'Search Results';
    else if ( is_archive() ) return post_type_archive_title( '', false );
    else if ( is_singular() ) return get_the_title();

    return true;

}

function jdf_the_page_title() {
    echo jdf_get_page_title();
}



// Return an SVG from theme.
function jdf_get_svg( $file = null, $path = 'images/bgi' ) {

    // Check if file is set.
    if ( !is_string( $file ) ) {
        jdf_simple_exception( '$file is required and must be a string.' );
        return false;
    }

    $file = str_replace( '.svg', '', $file );
    $path = '/' . trim( $path, '/' ) . '/';

    // Check if file exists in specified path.
    if ( !locate_template( $path . $file . '.svg' ) ) {
        jdf_simple_exception( $file . '.svg does not exist in ' . $path );
        return false;
    }

    // Generate the path to the SVG.
    $file = sprintf(
        '%s%s.svg',
        $path,
        $file
    );

	return file_get_contents( get_template_directory() . $file );

}

function jdf_the_svg( $file = null, $path = 'images/bgi' ) {
    echo jdf_get_svg( $file, $path );
}



// Return an anchor button element from ACF data.
function jdf_get_button( $button = null, $label = null, $attributes = null ) {

    // Check for button.
    if ( empty( $button ) || ( !is_array( $button ) && !is_string( $button ) ) ) {
        jdf_simple_exception( '$button is required, must not be empty and must be either an ACF link array or URL (string).' );
        return false;
    }

    if ( is_array( $button ) ) {

        // Retrieve data from ACF link array.
        $href = ( !empty( $button[ 'url' ] ) ? esc_url( $button[ 'url' ] ) : false );
        $label = ( !empty( $label ) ? $label : ( !empty( $button[ 'title' ] ) ? $button[ 'title' ] : 'Read More' ) );

        // Add target into default attributes.
        $default_attributes[ 'target' ] = ( !empty( $button[ 'target' ] ) ? '_blank' : '_self' );

    } else if ( is_string( $button ) ) {

        // Set href as URL.
        $href = $button;
        $label = ( !empty( $label ) ? $label : 'Read More' );

    }

    // Set default target attribute if not set.
    if ( empty( $default_attributes[ 'target' ] ) ) $default_attributes[ 'target' ] = '_self';

    // Set href.
    $default_attributes[ 'href' ] = $href;

    // Set additional default attributes.
    $default_attributes[ 'class' ] = 'btn';

    // Generate attributes.
    $rendered_attributes = jdf_create_attributes( $default_attributes, $attributes );

    // Return the link button.
    return sprintf(
        '<a %s>%s</a>',
        $rendered_attributes,
        trim( $label )
    );

}

function jdf_the_button( $button = null, $label = null, $attributes = null ) {
    echo jdf_get_button( $button, $label, $attributes );
}



// Generate image from ACF.
function jdf_get_image( $image = null, $size = 'medium', $attributes = null ) {

    // Check for image.
	if ( empty( $image ) || ( !is_array( $image ) && !is_string( $image ) && !is_int( $image ) ) ) {
        jdf_simple_exception( '$image is required, must not be empty and must be either an ACF image array, image URL string or image ID.' );
        return false;
    }

    // Check image size exists if passed.

    // Check if image size exists.
    if ( !empty( $size ) ) {

        $wp_image_sizes = array_keys( wp_get_registered_image_subsizes() );
        $wp_image_sizes[] = 'full';
        if ( !in_array( $size, $wp_image_sizes ) ) {
            jdf_simple_exception( 'Provided image size (' . $size . ') does not exist.' );
            return false;
        }

    }

    // Process array or ID.
    if ( is_array( $image ) || is_int( $image ) ) {

        // Get the attachment image.
        if ( is_array( $image ) ) $image = $image[ 'ID' ];
        $image = wp_get_attachment_image( $image, $size );

        // Extract attributes from attachment image.
        $image = (array) new SimpleXMLElement( $image );
        $default_attributes = $image[ '@attributes' ];

    }

    // Process string (cannot make use of image sizes).
    if ( is_string( $image ) ) {

        if ( !@getimagesize( $image ) ) {
            jdf_simple_exception( 'Image string (' . $image . ') does not appear to be valid.' );
            return false;
        }

        // Manually get image dimensions to assign width and height attributes.
        list( $width, $height ) = getimagesize( $image );

        $default_attributes = array(
            'src'       => $image,
            'width'     => (string) $width,
            'height'    => (string) $height,
            'loading'   => 'lazy'
        );

    }

    // Generate attributes and return image.
    if ( !empty( $default_attributes ) ) {
        $rendered_attributes = jdf_create_attributes( $default_attributes, $attributes );

        return sprintf(
            '<img %s/>',
            $rendered_attributes
        );
    }

}

function jdf_the_image( $image = null, $size='medium_small', $attributes = null ) {
    echo jdf_get_image( $image, $size, $attributes );
}



function jdf_get_iframe_video( $embed = null, $parameters = array(), $attributes = null ) {

    // Check for embed.
    if ( empty( $embed ) ) {
        jdf_simple_exception( '$embed is required and must be either a YouTube or Vimeo URL.' );
        return false;
    }

    // Use preg_match to find the iframe source.
    preg_match( '/src="(.+?)"/', $embed, $matches );
    $source = $matches[ 1 ];

    // Add default parameters to the iframe link if $parameters isn't defined based on source type (YouTube / Vimeo).
    if ( empty( $parameters ) && $parameters !== false ) {
        if ( strpos( $source, 'youtube.com' ) ) {
            $parameters = array(
                'controls'  => 0,
                'hd'        => 1,
                'autohide'  => 1
            );
        } else if ( strpos( $source, 'vimeo.com' ) ) {
            $parameters = array(
                'hd'        => 1,
                'autohide'  => 1
            );
        }
    }

    // Create the video link.
    $href = ( $parameters !== false ? add_query_arg( $parameters, $source ) : $source );

    // Generate attributes and return iframe.
    $default_attributes = array(
        'src' => esc_url( $href ),
        'allow' => 'autoplay'
    );

    $rendered_attributes = jdf_create_attributes( $default_attributes, $attributes );

    return sprintf(
        '<iframe %s></iframe>',
        $rendered_attributes
    );

}

function jdf_the_iframe_video( $embed = null, $parameters = array(), $attributes = null ) {
    echo jdf_get_iframe_video( $embed, $parameters, $attributes );
}



function jdf_get_featured_image( $size = 'medium', $attributes = null ) {

    // Check if post has featured image, else return early.
    if ( empty( get_the_post_thumbnail( get_the_ID() ) ) ) return false;

    // Check if image size exists.
    if ( !empty( $size ) ) {

        $wp_image_sizes = array_keys( wp_get_registered_image_subsizes() );
        $wp_image_sizes[] = 'full';
        if ( !in_array( $size, $wp_image_sizes ) ) {
            jdf_simple_exception( 'Provided image size (' . $size . ') does not exist.' );
            return false;
        }

    }

    $image = get_the_post_thumbnail( get_the_ID(), $size );

    // Extract attributes from featured image.
    $image = (array) new SimpleXMLElement( $image );
    $default_attributes = $image[ '@attributes' ];

    // Generate attributes and return image.
    if ( !empty( $default_attributes ) ) {
        $rendered_attributes = jdf_create_attributes( $default_attributes, $attributes );

        return sprintf(
            '<img %s/>',
            $rendered_attributes
        );
    }

}

function jdf_the_featured_image( $size = 'medium', $attributes = null ) {
    echo jdf_get_featured_image( $size, $attributes );
}



function jdf_get_placeholder_image( $size = 'medium', $attributes = null ) {

    // Check if placeholder image is defined on ACF Options page.
    $image = get_field( 'placeholder_image', 'options' );
    if ( empty( $image ) || ( !is_array( $image ) && !is_int( $image ) ) ) {
        jdf_simple_exception( 'Placeholder image must be set in ACF Options and must be either an array or an image ID.' );
        return false;
    }

    // Check if image size exists.
    if ( !empty( $size ) ) {

        $wp_image_sizes = array_keys( wp_get_registered_image_subsizes() );
        $wp_image_sizes[] = 'full';
        if ( !in_array( $size, $wp_image_sizes ) ) {
            jdf_simple_exception( 'Provided image size (' . $size . ') does not exist.' );
            return false;
        }

    }

    // Get the attachment image.
    if ( is_array( $image ) ) $image = $image[ 'ID' ];
    $image = wp_get_attachment_image( $image, $size );

    // Extract attributes from attachment image.
    $image = (array) new SimpleXMLElement( $image );
    $default_attributes = $image[ '@attributes' ];

    // Strip the alt tag value since this is a placeholder and not semantically important.
    $default_attributes[ 'alt' ] = '';

    // Generate attributes and return image.
    if ( !empty( $default_attributes ) ) {
        $rendered_attributes = jdf_create_attributes( $default_attributes, $attributes );

        return sprintf(
            '<img %s/>',
            $rendered_attributes
        );
    }

}

function jdf_the_placeholder_image( $size = 'medium', $attributes = null ) {
    echo jdf_get_placeholder_image( $size, $attributes );
}



function jdf_get_social_buttons( $social_types = array( 'facebook', 'linkedin', 'twitter', 'email' ) ) {
    // Check for social types.
    if ( empty( $social_types ) || !is_array( $social_types ) ) {
        jdf_simple_exception( 'You must provide at least one valid type of social media as an array.' );
        return false;
    }

	$social_types = join( ' ', $social_types );
	return do_shortcode( '[social_buttons social_types="' . $social_types . '"]' );
}

function jdf_the_social_buttons( $social_types = array( 'facebook', 'linkedin', 'twitter', 'email' ) ) {
    echo jdf_get_social_buttons( $social_types );
}


// BLOCK FUNCTIONS:

// Block visibility.
function jdf_block_visibility() {
	// If block visibility ACF is not present, always display the block.
	if ( empty( get_sub_field( 'block_visibility' ) ) ) return true;
	switch ( get_sub_field( 'block_visibility' ) ) {
		case 'hide':
			return false;
			break;
		case 'display':
			return true;
			break;
		case 'draft':
			return ( current_user_can( 'edit_posts' ) ? true : false );
			break;
	}
}

// Block Anchor
function jdf_block_anchor( $anchor = null ) {
    $anchor = ( !empty( $anchor ) ? $anchor : get_sub_field( 'block_anchor' ));
    $block_anchor = ( !empty( $anchor ) ? ' id="' . str_replace( ' ', '-', strtolower( trim( htmlspecialchars( $anchor, ENT_QUOTES ) ) ) ) . '"' : '');
    return $block_anchor;
}

// Enable HTML5 support for script and style tags.
add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);

// Add widget shortcode support.
add_filter( 'widget_text', 'do_shortcode' );

// Enable theme support for widgets and title tag.
add_theme_support( 'widgets' );
add_theme_support( 'title-tag' );

// Restrict access to backend Blocks for non-Jala admins (redirect to dashboard).
function jdf_restrict_blocks_backend() {
	$screen = get_current_screen();
	if ( $screen->post_type === 'blocks' && !is_jala_admin() ) wp_die(
        sprintf(
		    'You are not allowed to access this part of the site. Return to <a href="%s">dashboard</a>.',
		    get_dashboard_url()
	    )
    );
}
add_action( 'in_admin_header', 'jdf_restrict_blocks_backend' );

// Remove "Blocks" from new tab menu option.
function jdf_admin_bar_remove_blocks( $wp_admin_bar ) {
    if ( !is_jala_admin() ) $wp_admin_bar->remove_node( 'new-blocks' );
}
add_action( 'admin_bar_menu', 'jdf_admin_bar_remove_blocks', 999 );

// Add Blocks widget to dashboard.
$blocks_posts = get_posts(
	array(
		'numberposts' 	=> -1,
		'post_type'   	=> 'blocks',
		'orderby'    	=> 'title',
		'order' 		=> 'ASC'
	)
);

if ( count( $blocks_posts ) >= 1 ) {

	function jdf_blocks_dashboard_widget_register() {
		wp_add_dashboard_widget( 'dashboard_widget', 'Blocks', 'jdf_blocks_dashboard_widget' );
	}
	add_action( 'wp_dashboard_setup', 'jdf_blocks_dashboard_widget_register' );

	function jdf_blocks_dashboard_widget( $post, $callback_args ) {
		$blocks_posts = get_posts(
			array(
				'numberposts' 	=> -1,
				'post_type'   	=> 'blocks',
				'orderby'    	=> 'title',
				'order' 		=> 'ASC'
			)
		);

		printf(
			'<p>%s</p>',
			__( 'Below is a list of available ACF Blocks for use on your site.', 'whitepearl' )
		);
		echo '<ul>';
		foreach ( $blocks_posts as $post ) {
			setup_postdata( $post );
			printf(
				'<li><a href="%s">%s</a></li>',
				get_permalink( $post->ID ),
				$post->post_title
			);
		}
		wp_reset_postdata();
		echo '</ul>';
		printf(
			'<a href="%s" class="button button-primary">%s</a>',
			esc_url( add_query_arg( 'view-blocks', '', get_post_type_archive_link( 'blocks' ) ) ),
			__( 'View All Blocks', 'whitepearl' )
		);
	}
}