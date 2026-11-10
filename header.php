<?php
/**
 * The master header for Kinetix Enterprise.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$kinetix_header_style = get_theme_mod('kinetix_header_style', 'pill');
get_template_part(
    'templates/header-floating',
    null,
    array('header_style' => $kinetix_header_style)
);
?>
