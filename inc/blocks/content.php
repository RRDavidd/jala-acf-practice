<?php
// Block Name: Content

$content = get_sub_field( 'content' );
$block_bg =  get_sub_field( 'block_background' ) ?: '';
$block_width = get_sub_field( 'block_width' ) ?: 'wrap';
?>

<?php if ( $content ): ?>

    <div class="content-block block-wrapper block-m <?php echo $block_bg; ?>" <?php echo jdf_block_anchor(); ?>>

        <div class="entry <?php echo $block_width; ?> wrap-px">

            <?php echo $content; ?>

        </div><!-- /.entry -->

    </div><!-- /.content-block -->

<?php endif; ?>