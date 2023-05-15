<?php
// Block Name: Tab
?>

<?php $jdf_block_anchor = jdf_block_anchor(); ?>
<?php if ( have_rows( 'tabs' ) ): ?>

<div <?php echo $jdf_block_anchor; ?> class="tab-block block-wrapper block-m">
    <div class="wrap wrap-px">
        <div class="tab-data jq-tabs">

            <ul class="tabnav unstyled cf">
                <?php while ( have_rows( 'tabs' ) ): the_row(); if ( get_sub_field( 'title' ) ): ?>
                <li>
                    <a data-rel="tab<?php the_row_index(); ?>" class="h5 mb-0"><?php the_sub_field( 'title' ); ?></a>
                </li>
                <?php endif; endwhile; ?>
            </ul>

            <div class="tab-container">
                <?php while ( have_rows( 'tabs' ) ): the_row(); ?>
                <div class="tabcontent entry" data-rel="tab<?php the_row_index(); ?>">
                    <?php if ( get_sub_field( 'content' ) ) the_sub_field( 'content' ); ?>
                </div>
                <?php endwhile; ?>
            </div>

        </div>
    </div>
</div>

<?php endif; ?>