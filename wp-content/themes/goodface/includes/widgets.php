<?php
add_action(
	'widgets_init',
	function () {
		register_sidebar(
			[
				'name'          => __( '[Archive]: Blog Section 1', 'goodface' ),
				'id'            => 'section-goodface-1',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			]
		);

		register_sidebar(
			[
				'name'          => __( '[POST]: Blog Section 1', 'goodface' ),
				'id'            => 'section-goodface-2',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			]
		);

		register_sidebar(
			[
				'name'          => __( '[POST]: Blog Section 2', 'goodface' ),
				'id'            => 'section-goodface-3',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			]
		);
	}
);