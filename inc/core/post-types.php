<?php

defined('ABSPATH') || exit;

function kinetix_register_content_types() {
    register_post_type(
        'project',
        array(
            'labels' => array(
                'name'          => esc_html__('Projects', 'kinetix'),
                'singular_name' => esc_html__('Project', 'kinetix'),
                'add_new_item'  => esc_html__('Add New Project', 'kinetix'),
            ),
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => array('slug' => 'projects'),
            'show_in_rest' => true,
            'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        )
    );

    register_post_type(
        'research',
        array(
            'labels' => array(
                'name'          => esc_html__('Research Papers', 'kinetix'),
                'singular_name' => esc_html__('Research Paper', 'kinetix'),
                'add_new_item'  => esc_html__('Add New Paper', 'kinetix'),
            ),
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => array('slug' => 'research'),
            'show_in_rest' => true,
            'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        )
    );
}
add_action('init', 'kinetix_register_content_types');
