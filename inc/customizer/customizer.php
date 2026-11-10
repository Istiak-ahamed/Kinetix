<?php
/**
 * Kinetix design variant controls.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;

function kinetix_sanitize_choice($value, $setting) {
    $control = $setting->manager->get_control($setting->id);
    $choices = $control ? $control->choices : array();

    return array_key_exists($value, $choices) ? $value : $setting->default;
}

function kinetix_customize_register($wp_customize) {
    $wp_customize->add_section(
        'kinetix_variants',
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
                'pill'    => esc_html__('Floating Pill (Quayutec)', 'kinetix'),
                'apple'   => esc_html__('Apple Minimalist Bar', 'kinetix'),
                'split'   => esc_html__('Split Floating Islands', 'kinetix'),
                'minimal' => esc_html__('Transparent Minimal', 'kinetix'),
            ),
        ),
        'kinetix_card_style' => array(
            'label'   => esc_html__('Card Style', 'kinetix'),
            'default' => 'spotlight',
            'choices' => array(
                'spotlight' => esc_html__('Aceternity Mouse Spotlight', 'kinetix'),
                'apple'     => esc_html__('Apple Ultra-Matte Glass', 'kinetix'),
                'halo'      => esc_html__('Crimson Ambient Halo', 'kinetix'),
                'hud'       => esc_html__('Technical Monospace HUD', 'kinetix'),
            ),
        ),
        'kinetix_cursor_style' => array(
            'label'   => esc_html__('Cursor Style', 'kinetix'),
            'default' => 'magnetic',
            'choices' => array(
                'magnetic' => esc_html__('Apple Fluid Magnetic Capsule', 'kinetix'),
                'none'     => esc_html__('Standard OS Cursor', 'kinetix'),
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
                'section' => 'kinetix_variants',
                'type'    => 'select',
                'choices' => $variant['choices'],
            )
        );
    }

    foreach (
        array(
            'kinetix_accent_color' => array(
                'label'   => esc_html__('Brand Accent', 'kinetix'),
                'default' => '#ff2a2a',
            ),
            'kinetix_bg_color' => array(
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
                    'section' => 'kinetix_variants',
                )
            )
        );
    }
}
add_action('customize_register', 'kinetix_customize_register');

function kinetix_customizer_body_classes($classes) {
    $classes[] = 'header-style-' . sanitize_html_class(get_theme_mod('kinetix_header_style', 'pill'));
    $classes[] = 'card-style-' . sanitize_html_class(get_theme_mod('kinetix_card_style', 'spotlight'));
    $classes[] = 'kinetix-cursor-style-' . sanitize_html_class(get_theme_mod('kinetix_cursor_style', 'magnetic'));

    return $classes;
}
add_filter('body_class', 'kinetix_customizer_body_classes');

function kinetix_customizer_head_output() {
    $accent = sanitize_hex_color(get_theme_mod('kinetix_accent_color', '#ff2a2a'));
    $background = sanitize_hex_color(get_theme_mod('kinetix_bg_color', '#080808'));

    if (!$accent || !$background) {
        return;
    }

    printf(
        '<style id="kinetix-customizer-styles">:root{--kinetix-crimson:%1$s;--kinetix-black:%2$s;--kinetix-accent:%1$s;--kinetix-bg:%2$s;}</style>',
        esc_attr($accent),
        esc_attr($background)
    );
}
add_action('wp_head', 'kinetix_customizer_head_output');
