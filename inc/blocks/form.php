<?php
// Block Name: Form
?>

<?php if ( $form = do_shortcode( '[contact-form-7 id="' . get_sub_field( 'form' ) . '"]' ) ): ?>

    <div <?php echo jdf_block_anchor(); ?> class="form-block block-wrapper block-m">
        <div class="wrap wrap-px">

            <?php
            if ( $title = get_sub_field( 'title' ) ) printf(
                '<h2>%s</h2>',
                $title
            );

            echo $form;
            ?>

        </div>
    </div>

<?php endif; ?>