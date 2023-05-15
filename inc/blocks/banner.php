<?php
// Block Name: Banner

$banner_count = ( get_sub_field( 'banners' ) ? count( get_sub_field( 'banners' ) ) : 0 );
$jdf_block_anchor = jdf_block_anchor();

if ( have_rows( 'banners' ) ):
?>

<div <?php echo $jdf_block_anchor; ?> class="banner-block block-wrapper block-m">
    <div class="wrap wrap-px">
        <div class="banner<?php if ( $banner_count >= 2 ) echo ' slider-arrows'; ?>">

            <?php
            while ( have_rows( 'banners' ) ): the_row();

            $banner_data = get_sub_field( 'banner_data' );
            ?>

            <figure>

                <?php
                // Banner link with optional target and title attributes.
                if ( $link = $banner_data[ 'link' ] ) printf(
                    '<a href="%s"%s%s>',
                    esc_url( $link[ 'url' ] ),
                    ( !empty( $link[ 'target' ] ) ? ' target="_blank"' : '' ),
                    ( !empty( $banner_data[ 'title' ] ) ? 'aria-label="' . $banner_data[ 'title' ] . '"' : '' )
                );

                // Show the banner image.
                jdf_the_image( get_sub_field( 'image' ), 'full' );

                // Banner title.
                if ( $title = $banner_data[ 'title' ] ) printf(
                    '<div class="banner-text-overlay"><figcaption class="h1"><span>%s</span></figcaption></div>',
                    $title
                );

                if ( $link ) echo '</a>';
                ?>

            </figure>

            <?php endwhile; ?>

        </div>
    </div>
</div>

<?php endif; ?>