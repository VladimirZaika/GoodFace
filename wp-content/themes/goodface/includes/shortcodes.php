<?php
function render_related_articles($atts) {
	$atts = shortcode_atts([
		'title'        => '',
		'title_tag'    => 'h5',
		'full_card'    => false,
		'desk_slider'  => '',
		'wrapper'      => false,
		'hide_excerpt' => false,
    ], $atts, 'related_articles');

	$args = [
		'title'        => $atts['title'],
		'title_tag'    => $atts['title_tag'],
		'full_card'    => $atts['full_card'],
		'desk_slider'  => $atts['desk_slider'],
		'wrapper'      => $atts['wrapper'],
		'hide_excerpt' => $atts['hide_excerpt'],
	];

	ob_start();

	get_template_part( 'template-parts/sections/section-related-articles', null, $args );

	return ob_get_clean();
}

add_shortcode( 'related_articles', 'render_related_articles' );