        <footer id="footer">
            <div class="wrap wrap-p cf">
                <?php
                // Copyright notice.
                printf(
                    '<span>&copy; %s %s</span>',
                    wp_date( 'Y' ),
                    get_bloginfo( 'name' )
                );

                // Footer menu.
                wp_nav_menu( 
                    array( 
                        'theme_location'    => 'footer_menu',
                        'container'         => '',
                        'menu_class'        => 'menu'
                    )
                );
                ?>
                <a class="jala-link" title="Jala Design" href="https://www.jaladesign.com.au" target="_blank">Australian Website Design - Jala</a>
            </div>
        </footer>

    </div>

    <!-- ///// Outside Wrapper ///// -->

    <?php get_template_part( 'inc/partials/overlays' ); ?>

    <div class="jd_media_query_activation">
        <span class="d-xs-block"></span>
        <span class="d-sm-block"></span>
        <span class="d-md-block"></span>
        <span class="d-lg-block"></span>
        <span class="d-xl-block"></span>
        <span class="d-xxl-block"></span>
    </div>

<?php wp_footer(); ?>

</body>
</html>