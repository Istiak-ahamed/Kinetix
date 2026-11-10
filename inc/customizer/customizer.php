<?php
/**
 * Kinetix Customizer settings.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;

function kinetix_sanitize_choice($value, $setting) {
    $choices = $setting->manager->get_control($setting->id)->choices;

    return array_key_exists($value, $choices) ? $value : $setting->default;
}

function kinetix_customize_register($wp_customize) {
    $wp_customize->add_section(
        'kinetix_design_variants',
        array(
            'title'    => esc_html__('Kinetix Design Variants', 'kinetix'),
            'priority' => 30,
        )
    );

    $variants = array(
        'kinetix_header_style' => array(
            'label'   => esc_html__('Header Style', 'kinetix'),
            'default' => 'pill',
            'choices' => array(
                'pill'  => esc_html__('Pill', 'kinetix'),
                'apple' => esc_html__('Apple Bar', 'kinetix'),
            ),
        ),
        'kinetix_card_style' => array(
            'label'   => esc_html__('Card Style', 'kinetix'),
            'default' => 'spotlight',
            'choices' => array(
                'spotlight' => esc_html__('Aceternity Spotlight', 'kinetix'),
                'glass'     => esc_html__('Apple Minimal Glass', 'kinetix'),
                'hud'       => esc_html__('HUD', 'kinetix'),
            ),
        ),
        'kinetix_cursor_style' => array(
            'label'   => esc_html__('Cursor Style', 'kinetix'),
            'default' => 'dot-ring',
            'choices' => array(
                'dot-ring' => esc_html__('Dot + Ring', 'kinetix'),
                'minimal'  => esc_html__('Minimal Dot', 'kinetix'),
                'none'     => esc_html__('None', 'kinetix'),
            ),
        ),
    );

    foreach ($variants as $setting_id => $variant) {
        $wp_customize->add_setting(
            $setting_id,
            array(
                'default'           => $variant['default'],
                'sanitize_callback' => 'kinetix_sanitize_choice',
                'transport'         => 'refresh',
            )
        );
        $wp_customize->add_control(
            $setting_id,
            array(
                'label'   => $variant['label'],
                'section' => 'kinetix_design_variants',
                'type'    => 'select',
                'choices' => $variant['choices'],
            )
        );
    }

    $wp_customize->add_section(
        'kinetix_colors',
        array(
            'title'    => esc_html__('Kinetix Colors', 'kinetix'),
            'priority' => 31,
        )
    );

    foreach (
        array(
            'kinetix_brand_accent' => array(
                'label'   => esc_html__('Brand Accent', 'kinetix'),
                'default' => '#ff2a2a',
            ),
            'kinetix_canvas_background' => array(
                'label'   => esc_html__('Canvas Background', 'kinetix'),
                'default' => '#080808',
            ),
        ) as $setting_id => $color
    ) {
        $wp_customize->add_setting(
            $setting_id,
            array(
                'default'           => $color['default'],
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'refresh',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $setting_id,
                array(
                    'label'   => $color['label'],
                    'section' => 'kinetix_colors',
                )
            )
        );
    }
}
add_action('customize_register', 'kinetix_customize_register');

function kinetix_customizer_body_classes($classes) {
    $classes[] = 'kinetix-header-style-' . sanitize_html_class(get_theme_mod('kinetix_header_style', 'pill'));
    $classes[] = 'kinetix-card-style-' . sanitize_html_class(get_theme_mod('kinetix_card_style', 'spotlight'));
    $classes[] = 'kinetix-cursor-style-' . sanitize_html_class(get_theme_mod('kinetix_cursor_style', 'dot-ring'));

    return $classes;
}
add_filter('body_class', 'kinetix_customizer_body_classes');

function kinetix_customizer_styles() {
    $accent = sanitize_hex_color(get_theme_mod('kinetix_brand_accent', '#ff2a2a'));
    $background = sanitize_hex_color(get_theme_mod('kinetix_canvas_background', '#080808'));
    $header = get_theme_mod('kinetix_header_style', 'pill');
    $card = get_theme_mod('kinetix_card_style', 'spotlight');

    if (!$accent || !$background) {
        return;
    }

    $styles = ':root{--kinetix-crimson:' . $accent . ';--kinetix-black:' . $background . ';}';

    if ('apple' === $header) {
        $styles .= '.kinetix-nav-floating{border-radius:14px;padding-top:14px;padding-bottom:14px;}';
    }

    if ('glass' === $card) {
        $styles .= '.kinetix-card{background:rgba(255,255,255,.06);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);}';
    } elseif ('hud' === $card) {
        $styles .= '.kinetix-card{border-radius:4px;border-color:var(--kinetix-crimson);box-shadow:inset 0 0 24px rgba(255,42,42,.08);}';
    }

    echo '<style id="kinetix-customizer-styles">' . wp_strip_all_tags($styles) . '</style>';
}
add_action('wp_head', 'kinetix_customizer_styles');
