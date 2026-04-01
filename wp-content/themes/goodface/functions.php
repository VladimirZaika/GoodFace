<?php
/**
 * GoodFace functions
 *
 * @package GoodFace
 */

/**
 * Register custom post types
 */
require_once get_template_directory() . '/includes/custom-post-types.php';

/**
 * Register custom taxonomies
 */
require_once get_template_directory() . '/includes/custom-taxonomies.php';

/**
 * Set up theme defaults and registers support for various WordPress feaures.
 */
require_once get_template_directory() . '/includes/theme-default.php';

/**
 * Register menu
 */
require_once get_template_directory() . '/includes/custom-menu.php';

/**
 * Register widget area
 */
require_once get_template_directory() . '/includes/widgets.php';

/**
 * Enqueue scripts and styles
 */
require_once get_template_directory() . '/includes/scripts.php';

/**
 * Plugin settings: ACF
 */
require_once get_template_directory() . '/includes/plugin-settings/acf.php';

/**
 * Plugin settings: Yoast SEO
 */
require_once get_template_directory() . '/includes/plugin-settings/yoast-seo.php';

/**
 * AJAX
 */
require_once get_template_directory() . '/includes/ajax.php';

/**
 * API Get Response
 */
require_once get_template_directory() . '/includes/api/get-response.php';

/**
 * API Google Recaptcha
 */
require_once get_template_directory() . '/includes/api/recaptcha-honeypot.php';

/**
 * Custom functions
 */
require_once get_template_directory() . '/includes/custom-functions.php';

/**
 * Shortcodes
 */
require_once get_template_directory() . '/includes/shortcodes.php';