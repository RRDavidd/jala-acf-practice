<?php
// Block Name: Gallery
$gallery = get_sub_field( 'gallery' );

if ( $gallery ):

    $gallery_count = count( $gallery ) ?: 0;

    // Determine column width classes based on count.
    if ( $gallery_count <= 2 ) {
        $gallery_class = $gallery_count % 2 === 0 ? 'col-6 col-xl-3' : 'col-12 col-sm-6 col-xl-3';
    } else {
        $gallery_class = $gallery_count % 3 === 0 ? 'col-6 col-lg-4' : 'col-6 col-lg-3';
    }
    ?>

    <div class="gallery-block block-wrapper block-m" <?php echo jdf_block_anchor(); ?>>
        <div class="wrap wrap-px">
            <div class="popup-gallery cols-grid grid-flat-n cols-strict grid">

                <?php foreach ( $gallery as $image ): ?>

                    <div class="<?php echo $gallery_class; ?>">
                        <a href="<?php echo esc_url( $image[ 'url' ] ); ?>" class="lightbox-link" title="<?php echo $image[ 'caption' ]; ?>" data-caption="<?php echo $image[ 'caption' ]; ?>">
                            <div class="image-wrap square-box">
                                <figure class="square-content img-cover-wrapper">

                                    <?php jdf_the_image( $image, 'medium' ); ?>

                                </figure>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

<?php endif; ?>