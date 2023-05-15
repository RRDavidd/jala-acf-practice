<?php
// Block Name: Video

$video = get_sub_field( 'video' );
?>

<?php if ( $video ): ?>

    <div class="video-block block-wrapper block-m" <?php echo jdf_block_anchor(); ?>>
        <div class="wrap wrap-px">

            <?php
            printf(
                '<div class="iframe-responsive">%s</div>',
                jdf_get_iframe_video( $video )
            );
            ?>

        </div>
    </div>

<?php endif; ?>