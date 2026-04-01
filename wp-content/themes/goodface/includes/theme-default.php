<?php
add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'goodface', get_theme_file_uri( 'languages' ) );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		add_theme_support(
			'post-formats',
			[
				'aside',
				'image',
				'video',
				'quote',
				'link',
			]
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height'      => 200,
				'width'       => 50,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);

		register_nav_menus(
			[
				'primary' => __( 'Primary Menu', 'goodface' ),
			]
		);
	}
);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action(
	'after_setup_theme',
	function () {
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = apply_filters( 'goodface_content_width', 1236 );
		}
	},
	0
);

function goodface_customize_register($wp_customize) {
    // Primary color
    $wp_customize->add_setting('primary_color', [
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', [
        'label'    => __('Primary Color', 'goodface'),
        'section'  => 'colors',
        'settings' => 'primary_color',
    ]));

    // Secondary color
    $wp_customize->add_setting('secondary_color', [
        'default'   => '#000000',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', [
        'label'    => __('Secondary Color', 'goodface'),
        'section'  => 'colors',
        'settings' => 'secondary_color',
    ]));

	// Optional color 1
	$wp_customize->add_setting('optional_color_1', [
        'default'   => '#566DFF',
        'transport' => 'refresh',
    ]);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'optional_color_1', [
        'label'    => __('Optional Color #1', 'goodface'),
        'section'  => 'colors',
        'settings' => 'optional_color_1',
    ]));

	// Optional color 2
	$wp_customize->add_setting('optional_color_2', [
        'default'   => '#3B4688',
        'transport' => 'refresh',
    ]);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'optional_color_2', [
        'label'    => __('Optional Color #2', 'goodface'),
        'section'  => 'colors',
        'settings' => 'optional_color_2',
    ]));

	// Optional color 3
	$wp_customize->add_setting('optional_color_3', [
        'default'   => '#CED5FF',
        'transport' => 'refresh',
    ]);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'optional_color_3', [
        'label'    => __('Optional Color #3', 'goodface'),
        'section'  => 'colors',
        'settings' => 'optional_color_3',
    ]));

	// Optional color 4
	$wp_customize->add_setting('optional_color_4', [
        'default'   => '#8289B8',
        'transport' => 'refresh',
    ]);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'optional_color_4', [
        'label'    => __('Optional Color #4', 'goodface'),
        'section'  => 'colors',
        'settings' => 'optional_color_4',
    ]));

    // Optional color 5
	$wp_customize->add_setting('optional_color_5', [
        'default'   => '#172895',
        'transport' => 'refresh',
    ]);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'optional_color_5', [
        'label'    => __('Optional Color #5', 'goodface'),
        'section'  => 'colors',
        'settings' => 'optional_color_5',
    ]));
}

add_action('customize_register', 'goodface_customize_register');