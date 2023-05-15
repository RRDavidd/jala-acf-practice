<?php
// Block Name: Tile
$tile_count = ( get_sub_field( 'tiles' ) ? count( get_sub_field( 'tiles' ) ) : 0 );
$jdf_block_anchor = jdf_block_anchor();
?>

<?php if ( have_rows( 'tiles' ) ): ?>

    <?php $tile_class = 'col-md-6';
    if ( $tile_count >= 3 ) $tile_class = $tile_count % 3 === 0 ? 'col-lg-4' : 'col-lg-6 col-xl-3';
    ?>

    <div <?php echo $jdf_block_anchor; ?> class="tile-block block-wrapper block-m">
        <div class="wrap wrap-px">
            <div class="listing cols-grid grid-flat-n same-height">

                <?php
                while ( have_rows( 'tiles' ) ): the_row();

                $tile_data = get_sub_field( 'tile_data' );
                $content = get_sub_field( 'content' );

                ?>

                <article class="list-item <?php echo $tile_class; ?>">

                    <?php
                    // Wrapping anchor if link is used but button isn't.
                    if ( $tile_data[ 'link' ] && !$tile_data[ 'display_button' ] ) {
                        printf(
                            '<a href="%s" class="list-item-body">',
                            esc_url( $tile_data[ 'link' ][ 'url' ] )
                        );
                    } else {
                        echo '<div class="list-item-body">';
                    }
                    ?>

                        <?php if ( $image = get_sub_field( 'image' ) ): ?>
                            <figure class="list-item-img">
                                <div class="grow">
                                    <?php jdf_the_image( $image ); ?>
                                </div>
                            </figure>
                        <?php endif; ?>

                        <div class="list-item-content entry bg-color2 p-3 font-color-white-strict">
                            <?php
                            if ( $title = $tile_data[ 'title' ] ) printf(
                                '<h2>%s</h2>',
                                $title
                            );

                            // Content
                            if ( !empty( $content ) ) {
                                $content = str_replace( '"', '&quot;', $content );
                                $content = preg_replace('/<\/?a[^>]*>/','', $content); // Removing links from content
                                echo apply_filters( 'the_content', $content );
                            }

                            if ( $tile_data[ 'link' ] && $tile_data[ 'display_button' ] ) jdf_the_button( $tile_data[ 'link' ] );
                            ?>
                        </div>

                    <?php
                    // Wrapping anchor if link is used but button isn't.
                    echo ( $tile_data[ 'link' ] && !$tile_data[ 'display_button' ] ? '</a>' : '</div>' );
                    ?>

                </article>

                <?php endwhile; ?>

            </div>
        </div>
    </div>

<?php endif; ?>