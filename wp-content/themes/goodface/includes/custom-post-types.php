<?php
function register_missions_post_type() {
    register_post_type('blog', [
        'labels' => [
            'name'               => __('Blog'),
            'singular_name'      => __('Blog'),
            'add_new'            => __('Add Article'),
            'add_new_item'       => __('Add Article'),
            'edit_item'          => __('Edit Article'),
            'new_item'           => __('Article'),
            'view_item'          => __('View Article'),
            'search_items'       => __('Search Articles'),
            'not_found'          => __('No Article found'),
            'not_found_in_trash' => __('No Article found in Trash'),
        ],
        'public'            => true,
        'has_archive'       => true,
        'show_in_nav_menus' => true,
        'rewrite'           => [
            'slug'          => 'blog',
            'with_front'    => false,
        ],
        'supports'          => ['title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'],
    ]);
}

add_action('init', 'register_missions_post_type');
