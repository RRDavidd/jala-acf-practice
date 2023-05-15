<?php
// Block Name: Accordion

$multiopen = get_sub_field( 'multiopen' );
$jdf_block_anchor = jdf_block_anchor();
if ( have_rows( 'accordions' ) ):
?>

<div <?php echo $jdf_block_anchor; ?> class="accordion-block block-wrapper block-m">
    <div class="wrap wrap-px">
        <div class="accordion-box<?php if ( $multiopen ) echo ' multi-open'; ?>">
            <div class="accordion-databox">

                <?php while ( have_rows( 'accordions' ) ): the_row(); ?>

                <div class="accordion-row" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">

                    <?php
                    if ( $title = get_sub_field( 'title' ) ) printf(
                        '<h5 class="accordion-trigger" itemprop="name">%s</h5>',
                        $title
                    );
                    ?>

                    <?php if ( $content = get_sub_field( 'content' ) ): ?>

                    <div class="accordion-data" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text" class="entry">
                            <?php echo $content; ?>
                        </div>
                    </div>

                    <?php endif; ?>

                </div>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>

<?php endif; ?>