<?php
/**
 * Kinetix Enterprise Theme Engine
 *
 * @package Kinetix
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

define('KINETIX_VERSION', '1.0.0');
define('KINETIX_DIR', get_template_directory());
define('KINETIX_URI', get_template_directory_uri());
    
// 1. Load Theme Setup & Enqueues
require_once KINETIX_DIR . '/inc/core/enqueue.php';
require_once KINETIX_DIR . '/inc/core/post-types.php';
require_once KINETIX_DIR . '/inc/core/template-tags.php';

// 2. Load Scholar Publishing Engine
require_once KINETIX_DIR . '/inc/scholar/class-google-scholar.php';

// 3. Load Anti-Nulling Licensing & Integrity Engine
require_once KINETIX_DIR . '/inc/license/class-kinetix-license.php';
require_once KINETIX_DIR . '/inc/license/class-kinetix-telemetry.php';

// Theme Support Initializer
function kinetix_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption', 'style', 'script'));
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary-menu' => esc_html__('Floating Primary Navigation', 'kinetix'),
        'footer-menu'  => esc_html__('Footer Navigation', 'kinetix'),
    ));
}
add_action('after_setup_theme', 'kinetix_theme_setup');