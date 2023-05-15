<!-- Responsive Menu Overlay -->
<div class="page-overlay transition-all" data-page-overlay="menu_overlay">
    <div class="page-overlay-content transition-all-slower">
        <span class="close_overlay open" title="Close Menu"><span class="transition-all vh-center"></span>Menu</span>
        <div class="vertical_align_wrapper">
            <div class="vertical_align_content px-3 px-xxl-0">
                <div class="page-overlay-content-main wrap wrap-p font-color-white-strict">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'    => 'main_menu',
                            'container'         => '',
                            'menu_class'        => 'menu responsive-menu'
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Overlay -->
<div class="page-overlay transition-all" data-page-overlay="search_overlay">
    <div class="page-overlay-content transition-all-slower">
        <button class="close_overlay open" title="Close Menu"><span class="transition-all vh-center"></span>Menu</button>
        <div class="vertical_align_wrapper">
            <div class="vertical_align_content px-3 px-xxl-0">
                <div class="page-overlay-content-main wrap wrap-p">
                    <div class="align-items-center">
                        <h2>Search <?php bloginfo( 'name' ); ?></h2>
                        <div>
                            <div class="modulebox widget_search">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>