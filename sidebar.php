<?php
if ( is_active_sidebar( 'sidebar-1' ) ) {
    echo '<aside id="sidebar" class="col-lg-4">';
    dynamic_sidebar( 'sidebar-1' );
    echo '</aside>';
}
?>