<?php
// Block Name: Button

$jdf_block_anchor = jdf_block_anchor();

if ( have_rows( 'buttons' ) ): ?>

<div <?php echo $jdf_block_anchor; ?> class="button-block block-wrapper block-m multi-line">
    <div class="wrap wrap-px">

        <?php
        while ( have_rows( 'buttons' ) ): the_row();
            jdf_the_button( get_sub_field( 'button' ) );
        endwhile;
        ?>

    </div>
</div>

<?php endif; ?>