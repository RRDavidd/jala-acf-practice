<?php
// Block Name: Column

$column_count = ( get_sub_field( 'columns' ) ? count( get_sub_field( 'columns' ) ) : 0 );
$jdf_block_anchor = jdf_block_anchor();

if ( have_rows( 'columns' ) ):

$column_class = 'col-md-6';
if ( $column_count >= 3 ) $column_class .= $column_count % 3 === 0 ? ' col-lg-4' : ' col-lg-6 col-xl-3';
?>

<div <?php echo $jdf_block_anchor; ?> class="column-block block-wrapper block-m">
    <div class="wrap wrap-px">
        <div class="cols-grid grid-flat-n same-height">

            <?php
            while ( have_rows( 'columns' ) ): the_row();

            if ( empty( get_sub_field( 'content' ) ) ) continue;
            ?>

            <div class="col-item <?php echo $column_class; ?>">
                <div class="col-item-content-wrapper">
                    <div class="col-item-content entry bg-color1 p-3">
                        <?php the_sub_field( 'content' ); ?>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>

        </div>
    </div>
</div>

<?php endif; ?>