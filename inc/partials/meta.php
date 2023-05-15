<?php
// Combine the meta fields if they exist.
$meta = sprintf(
    '%s%s%s',
    ( !empty( get_the_author() ) ? get_the_author() : '' ),
    ( !empty( get_the_author() ) && !empty( get_the_time() ) ? ' &mdash; ' : '' ),
    ( !empty( get_the_time() ) ? get_the_time( get_option( 'date_format' ) ) : '' )
);

// If the meta isn't empty, return it within the wrapper.
if ( !empty( $meta ) ) printf(
    '<div class="meta my-3"><p><em>%s</em></p></div>',
    $meta
);
?>