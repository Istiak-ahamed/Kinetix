<?php
/**
 * Kinetix starter site importer.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;

function kinetix_import_demo_post($post_type, $title, $content, $excerpt, $meta = array()) {
    $slug = sanitize_title($title);
    $existing = get_page_by_path($slug, OBJECT, $post_type);
    $post_id = $existing ? $existing->ID : wp_insert_post(
        wp_slash(
            array(
                'post_type'    => $post_type,
                'post_title'   => $title,
                'post_content' => $content,
                'post_excerpt' => $excerpt,
                'post_status'  => 'publish',
                'post_name'    => $slug,
            )
        ),
        true
    );

    if (is_wp_error($post_id)) {
        return $post_id;
    }

    foreach ($meta as $key => $value) {
        update_post_meta($post_id, sanitize_key($key), sanitize_textarea_field($value));
    }

    return $post_id;
}

function kinetix_import_starter_site() {
    check_ajax_referer('kinetix_importer_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => esc_html__('You do not have permission to import demo content.', 'kinetix')), 403);
    }

    $projects = array(
        array('Apex Global Masters 2026', 'Broadcast packaging, stingers, and tournament screen loops.', 'A complete high-energy tournament broadcast system built for international scale.'),
        array('BEXO Esports Brand Identity', 'Full motion system, team overlays, and a 3D logo loop.', 'A flexible esports identity with motion rules that keep every match touchpoint consistent.'),
        array('Rogue Nation Championship Stream', 'High-ticket broadcast assets and sponsor lower thirds.', 'A premium championship stream package balancing sponsor visibility with competitive intensity.'),
        array('DF+ Dynamic Screen System', 'Arena LED visuals and multi-camera transitions.', 'A dynamic screen language engineered for live arenas, rapid camera changes, and crowd energy.'),
    );
    foreach ($projects as $project) {
        $result = kinetix_import_demo_post('project', $project[0], $project[1], $project[2]);
        if (is_wp_error($result)) {
            wp_send_json_error(array('message' => esc_html($result->get_error_message())), 500);
        }
    }

    $research = array(
        array(
            'Pharmacokinetics of Novel Antiviral Compounds in Feline Medicine',
            'This illustrative abstract evaluates absorption, distribution, metabolism, and elimination profiles for novel antiviral compounds in feline medicine. The sample dataset demonstrates how Kinetix can present clinical research with a clear scholarly reading experience.',
            'A sample pharmacokinetic research abstract prepared for the Kinetix starter site.',
            array('doi' => '10.5555/kinetix.feline.2026', 'citation_author' => 'Kinetix Research Group', 'citation_publication_date' => '2026'),
        ),
        array(
            'Real-Time Telemetry and Edge Compute in Equine Diagnostics',
            'This illustrative abstract examines real-time telemetry pipelines and edge compute workflows for equine diagnostics. The methodology combines wearable sensor streams, local inference, and clinician review to reduce latency in field environments.',
            'A sample telemetry research abstract prepared for the Kinetix starter site.',
            array('doi' => '10.5555/kinetix.equine.2026', 'citation_author' => 'Kinetix Research Group', 'citation_pdf_url' => home_url('/sample-equine-preprint.pdf')),
        ),
    );
    foreach ($research as $paper) {
        $result = kinetix_import_demo_post('research', $paper[0], $paper[1], $paper[2], $paper[3]);
        if (is_wp_error($result)) {
            wp_send_json_error(array('message' => esc_html($result->get_error_message())), 500);
        }
    }

    update_option(
        'kinetix_sprint_tiers',
        array(
            array('name' => 'Sprint Alpha', 'price' => '$1,000', 'turnaround' => '3-Day Turnaround'),
            array('name' => 'Sprint Studio', 'price' => '$2,500', 'turnaround' => '7-Day Turnaround'),
            array('name' => 'Tournament Packaging', 'price' => '$5,000', 'turnaround' => 'Turnkey Full Event'),
        ),
        false
    );

    wp_send_json_success(array('message' => esc_html__('Kinetix Enterprise Starter Site imported successfully!', 'kinetix')));
}
add_action('wp_ajax_kinetix_import_starter_site', 'kinetix_import_starter_site');
