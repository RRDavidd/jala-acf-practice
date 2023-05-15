<div class="logo-block block-wrapper block-m">
    <div class="wrap wrap-px">
        <?php if ( $title = get_sub_field( 'title' ) ) : ?>
            <h2><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="logo-container cols-grid cols-strict">
            <?php if ( have_rows( 'logos' ) ) : ?>
                <?php while ( have_rows( 'logos' ) ) :
                    the_row(); 
                    $logo_data = get_sub_field( 'logo_data' );
                    $link = $logo_data['link'];
                    ($link) ? $start_tag = 'a href=' . $logo_data['link']['url'] : $start_tag = 'div';
                    ($link) ? $end_tag = 'a' : $end_tag = 'div';?>
                    
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 logo-item">
                        <<?php echo $start_tag; ?>>
                            <figure>
                                <?php jdf_the_image( get_sub_field( 'image' ) ); ?>
                            </figure>
                            <?php if ( $title = $logo_data['title'] ) : ?>
                                <div class="content-container mt-3">
                                    <span class="h6 title"> <?php echo esc_html( $title ); ?></span>
                                </div>
                            <?php endif; ?>
                        </<?php echo $end_tag; ?>>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>