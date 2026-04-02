<?php
function goodface_dynamic_styles() {
    global $wp_query;
    global $post;

    $notFoundPageVer = filemtime( get_theme_file_path('dist/css/template/not-found/not-found.css') );
    $tmplContainerVer = filemtime( get_theme_file_path('dist/css/template/template-container/template-container.css') );

    $swiperStyleVer = filemtime( get_theme_file_path('libs/swiper/css/swiper.css') );
    $swiperJsVer = filemtime( get_theme_file_path('libs/swiper/js/swiper.js') );
    
    $styleVersion = filemtime( get_theme_file_path('dist/css/main.css') );
    $scriptVersion = filemtime( get_theme_file_path('dist/js/main.js') );

    $singleBlogStyleVer = filemtime( get_theme_file_path('dist/css/template/single-blog/single-blog.css') );
    $archiveBlogStyleVer = filemtime( get_theme_file_path('dist/css/template/archive-blog/archive-blog.css') );

    $wpData = [
        'ajaxUrl'      => admin_url('admin-ajax.php'),
        'id'           => get_queried_object_id(),
        'taxonomy'     => get_queried_object()->taxonomy ?? '',
        'archive'      => get_queried_object()->labels->name ?? '',
        'postType'     => get_post_type() ?? 'post',
        'maxPosts'     => $wp_query->found_posts,
    ];

    $hasLanding = has_block( 'acf/block-landing', $post );
    $hasForm = has_block( 'acf/block-form', $post );
    $hasCta = false;

	wp_enqueue_style('goodface-variables', get_stylesheet_uri());
	wp_enqueue_style( 'goodface-styles', get_theme_file_uri( 'dist/css/main.css' ), [], $styleVersion  );
    wp_enqueue_script( 'goodface-scripts', get_theme_file_uri( 'dist/js/main.js' ), [], $scriptVersion, true );

    if ( is_page_template( 'templates/template-container.php' ) ) {
        wp_enqueue_style( 'tmpl-container-style', get_theme_file_uri( 'dist/css/template/template-container/template-container.css' ), [], $tmplContainerVer );
    }

    if ( is_404() ) {
        wp_enqueue_style( 'not-found-styles', get_theme_file_uri( 'dist/css/template/not-found/not-found.css' ), [], $notFoundPageVer );
    }

    if ( is_singular('blog') || is_singular('post') ) {
        wp_enqueue_style( 'swiper-styles', get_theme_file_uri( 'libs/swiper/css/swiper.css' ), [], $swiperStyleVer  );
        wp_enqueue_script( 'swiper-scripts', get_theme_file_uri( 'libs/swiper/js/swiper.js' ), [], $swiperJsVer, true );
    }

    if ( is_singular('blog') ) {
        wp_enqueue_style( 'single-blog-styles', get_theme_file_uri( 'dist/css/template/single-blog/single-blog.css' ), [], $singleBlogStyleVer  );
    }

    if ( is_archive('blog') && get_post_type() === 'post' ) {
        wp_enqueue_style( 'blog-archive-style', get_theme_file_uri( 'dist/css/template/archive-blog/archive-blog.css' ), [], $archiveBlogStyleVer );
    }

    wp_localize_script( 'goodface-scripts', 'wpData', $wpData );
    
    $white = get_theme_mod('primary_color', '#FFFFFF');
    $black = get_theme_mod('secondary_color', '#000000');
    $grey = get_theme_mod('optional_color_1', '#2F2F2F');
    $dark = get_theme_mod('optional_color_2', '#181818');
    $yellow = get_theme_mod('optional_color_3', '#FED543');
    $blue = get_theme_mod('optional_color_4', '#9DB9FF');
    $darkblue = get_theme_mod('optional_color_5', '#7896FF');


    $customCss = "
        :root {
            --white-color: $white;
            --white-color-80: rgba(" . hexToRgb($white) . ", 0.8);
            --white-color-60: rgba(" . hexToRgb($white) . ", 0.6);
            --white-color-30: rgba(" . hexToRgb($white) . ", 0.3);
            --white-color-20: rgba(" . hexToRgb($white) . ", 0.2);
            --white-color-10: rgba(" . hexToRgb($white) . ", 0.1);

            --black-color: $black;
            --black-color-60 rgba(" . hexToRgb($black) . ", 0.6);
            --black-color-30 rgba(" . hexToRgb($black) . ", 0.3);

            --optional-color-1: $grey;

            --optional-color-2: $dark;
            
            --optional-color-3: $yellow;

            --optional-color-4: $blue;

            --optional-color-5: $darkblue;
        }";

    wp_add_inline_style( 'goodface-variables', $customCss );
};

add_action('wp_enqueue_scripts', 'goodface_dynamic_styles');