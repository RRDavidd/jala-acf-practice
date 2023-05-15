<?php
// Block Name: Highlight

$slider = ( get_sub_field( 'highlights' ) && count( get_sub_field( 'highlights' ) ) >= 2 ? true : false );
$jdf_block_anchor = jdf_block_anchor();

if ( have_rows( 'highlights' ) ):
?>

<div <?php echo $jdf_block_anchor; ?> class="highlight-block block-wrapper block-m">
    <div class="wrap wrap-px">

        <?php
        if ( $slider ) echo '<div class="highlight-slider">';

        while ( have_rows( 'highlights' ) ): the_row();

        if ( $slider ) echo '<div class="slider">';

        $highlight_data = get_sub_field( 'highlight_data' );
        ?>

        <div class="cols cols-grid grid-flat-n <?php if ( $highlight_data[ 'alignment' ] === 'right' ) echo ' flex-row-reverse'; ?>">

            <?php if ( get_sub_field( 'image' ) ): ?>
            <div class="col-6">
                <figure>
                    <?php jdf_the_image( get_sub_field( 'image' ) ); ?>
                </figure>
            </div>
            <?php endif; ?>

            <div class="col-6">
                <div class="content-block entry">
                    <?php
                    if ( $highlight_data[ 'title' ] ) printf(
                        '<h3>%s</h3>',
                        $highlight_data[ 'title' ]
                    );

                    if ( get_sub_field( 'content' ) ) the_sub_field( 'content' );

                    if ( $highlight_data[ 'link' ] ) jdf_the_button( $highlight_data[ 'link' ] );
                    ?>
                </div>
            </div>

        </div>

        <?php
        if ( $slider ) echo '</div>';

        endwhile;

        if ( $slider ) echo '</div>';
        ?>

    </div>
</div>

<?php endif; ?>