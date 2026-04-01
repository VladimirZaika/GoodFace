<?php
$menu = ( isset($args['menu']) && !empty($args['menu']) ) ? $args['menu'] : '';

$menuArgs = [
    'theme_location'  => 'primary',
    'container'       => 'nav',
    'container_class' => 'menu-wrapper',
    'menu_class'      => 'menu-list',
    'orderby'         => 'menu_order',
    'order'           => 'ASC',
];

if ( !empty($menu) ):
    $menuArgs['theme_location'] = $menu;
endif;

wp_nav_menu( $menuArgs );
?>