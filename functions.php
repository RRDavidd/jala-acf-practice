<?php
// Functions
require_once get_template_directory() . '/inc/base/functions-jala.php';
require_once get_template_directory() . '/inc/base/functions-client.php';

// Shortcodes
require_once get_template_directory() . '/inc/shortcodes/social-buttons.php';
require_once get_template_directory() . '/inc/shortcodes/generic-content.php';

// Custom Post Types & Taxonomies
require_once get_template_directory() . '/inc/base/cpt-blocks.php';

// WooCommerce
require_once get_template_directory() . '/inc/base/woocommerce/woocommerce-functions.php';
require_once get_template_directory() . '/inc/base/woocommerce/woocommerce-single-functions.php';
?>