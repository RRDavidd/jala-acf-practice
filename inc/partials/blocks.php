<?php

if ( have_rows( 'blocks' ) ) {

    // Automatically grab all possible block types from the flexible content field template.
    $blocks = array();
    foreach ( acf_get_field( 'blocks' )[ 'layouts' ] as $block ) $blocks[] = $block[ 'name' ];

    if ( !empty( $blocks ) ): while ( have_rows( 'blocks' ) ): the_row();

        $block = get_row()[ 'acf_fc_layout' ];

        // Skip if block is not in this page layout or block is not visible.
        if ( !in_array( $block, $blocks ) || !jdf_block_visibility() ) continue;

        $block = str_replace( '_', '-', $block );

        // Grab the relevant template part for this block if it exists.
        // Block template must be named "[block-name].php" inside "/inc/blocks/". Hyphens must be used in place of underscores.
        if ( locate_template( '/inc/blocks/' . $block . '.php' ) ) {

            get_template_part( '/inc/blocks/' . $block );

        } else {

            simple_exception( 'Unable to locate "/inc/blocks/' . $block . '.php" template file.' );
            continue;

        }

    endwhile; endif;

}

?>