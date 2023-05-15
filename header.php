<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( is_search() ): ?><meta name="robots" content="noindex, nofollow" /><?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <div id="wrapper">

        <header class="header bg-color2">
            <div class="wrap wrap-p d-flex justify-content-between align-items-center">
                <div class="logo">
                    <strong><?php bloginfo( 'name' ); ?></strong>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo get_template_directory_uri() . '/images/logo.svg'; ?>" width="140" height="90" alt="<?php bloginfo( 'name' ); ?>" class="primary-logo">
                    </a>
                </div>

                <nav id="nav" class="d-flex justify-content-center align-items-center">
                    <div id="mainmenu" class="d-none d-xl-block">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'main_menu',
                                'container'         => '',
                                'menu_class'        => 'menu'
                            )
                        );
                        ?>
                    </div>
                    <button class="responsive-menu-btn" data-open-target="menu_overlay" title="Open Menu"><span class="transition-all vh-center"></span>Menu</button>
                    <button class="search-btn open-page-overlay" data-open-target="search_overlay" title="Open Search"><span class="vh-center"></span>Search</button>
                </nav>
            </div>
        </header>