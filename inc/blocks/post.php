<?php
    // Block name : Posts

    $display_format = get_sub_field( 'display_format' );
    $post_numbers = 12;

    $title = get_sub_field( 'title' );
    $link = get_sub_field( 'cta' );

    global $post;
?>

<?php if( $display_format ) : ?>
    <div class="posts-block block-wrapper block-m">
        <div class="wrap wrap-px">
            <?php if( $link || $title ): ?>
                <div class="title-container d-flex flex-wrap align-items-center justify-content-between mb-2 flex-row-reverse">
                    <?php if( $link ):  jdf_the_button( $link );  endif;?>
                    <?php if ( $title ): ?><h2 class="mb-0 <?php if( !$link ): echo "mr-auto"; endif;?>"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="cols-grid grid-flat-n same-height listing">

                <?php if( $display_format == 'automated' ):
                // Posts get generated based on recent 12 posts automatically
                        $automated_posts = get_posts( array(
                            'numberposts'   => $post_numbers,
                            'order'   => 'DESC'
                            ) );
                            foreach ($automated_posts as $post):
                                setup_postdata( $post );
                                get_template_part( 'inc/partials/post-item' );
                            endforeach;
                        wp_reset_postdata();

                elseif( $display_format == 'manual' ):
                // Posts gets generated based on manually picked posts
                    $posts = get_sub_field( 'posts' );
                    if ( $posts ) :
                        foreach( $posts as $post) :
                            setup_postdata( $post );
                            get_template_part( 'inc/partials/post-item' );
                        endforeach;
                        wp_reset_postdata();
                    endif;

                elseif( $display_format == 'category' ):
                // Posts get generated based on the categories picked
                    $categories = get_sub_field( 'category' );
                    $category_list = array();

                    // loops all the selected categories in wp backend
                    foreach( $categories as $category ):
                        array_push( $category_list, $category->name );
                    endforeach;

                    // creates a string out of all the categories
                    $combined_category = implode(", ", $category_list);

                    $posts_categorized = get_posts( array(
                        'numberposts'       => $post_numbers,
                        'category_name'     => $combined_category
                    ) );
                    if ( $posts_categorized ) :
                        foreach( $posts_categorized as $post) :
                            setup_postdata( $post );
                            get_template_part( 'inc/partials/post-item' );
                        endforeach;
                        wp_reset_postdata();
                    endif;
                endif; ?>
            </div>
        </div>
        <!-- /.wrap wrap-px -->
    </div>
    <!-- /.post-block block-wrapper block-m -->
<?php endif; ?>
