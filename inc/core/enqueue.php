<?php

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue Kinetix theme assets.
 *
 * @return void
 */
function kinetix_enqueue_assets() {
	$theme_uri = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'kinetix-google-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
		array(),
		'5.3.3'
	);

	wp_enqueue_style(
		'kinetix-core',
		$theme_uri . '/assets/css/kinetix-core.css',
		array( 'bootstrap' ),
		null
	);

	wp_enqueue_script(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.3',
		true
	);

	wp_enqueue_script(
		'kinetix-cursor',
		$theme_uri . '/assets/js/kinetix-cursor.js',
		array(),
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'kinetix_enqueue_assets' );

