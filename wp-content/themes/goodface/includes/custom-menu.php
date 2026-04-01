<?php

function register_custom_menus() {
    register_nav_menus([
        'company'   => 'Company Menu',
    ]);
}

add_action('after_setup_theme', 'register_custom_menus');