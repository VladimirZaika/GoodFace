<?php
function register_category_taxonomy() {
    register_taxonomy('blog_cat', ['blog'], [
        'labels' => [
            'name'              => __('Categories'),
            'singular_name'     => __('Category'),
            'search_items'      => __('Search Categories'),
            'all_items'         => __('All Categories'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'rewrite'           => [
            'slug'          => 'blog',
            'with_front'    => false,
            'hierarchical'  => true,
        ],
    ]);
}

add_action( 'init', 'register_category_taxonomy' );
