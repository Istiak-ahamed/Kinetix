<?php
/**
 * Kinetix admin dashboard.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;

function kinetix_admin_icon_url() {
    $icon_dir = KINETIX_DIR . '/assets/images/';
    $icon_uri = KINETIX_URI . '/assets/images/';

    if (file_exists($icon_dir . 'admin-icon.svg')) {
        return $icon_uri . 'admin-icon.svg';
    }

    if (file_exists($icon_dir . 'admin-icon.png')) {
        return $icon_uri . 'admin-icon.png';
    }

    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><circle cx="32" cy="32" r="30" fill="#121212"/><path fill="#ff2a2a" d="M18 14h9v14l13-14h12L37 30l16 20H41L27 34v16h-9z"/></svg>';

    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

function kinetix_register_admin_menu() {
    add_menu_page(
        esc_html__('Kinetix Dashboard', 'kinetix'),
        esc_html__('Kinetix', 'kinetix'),
        'manage_options',
        'kinetix-dashboard',
        'kinetix_render_dashboard',
        kinetix_admin_icon_url(),
        59
    );

    add_submenu_page(
        'kinetix-dashboard',
        esc_html__('Dashboard', 'kinetix'),
        esc_html__('Dashboard', 'kinetix'),
        'manage_options',
        'kinetix-dashboard',
        'kinetix_render_dashboard'
    );
    add_submenu_page(
        'kinetix-dashboard',
        esc_html__('Starter Sites', 'kinetix'),
        esc_html__('Starter Sites', 'kinetix'),
        'manage_options',
        'kinetix-starter-sites',
        'kinetix_render_starter_sites'
    );
    add_submenu_page(
        'kinetix-dashboard',
        esc_html__('Customize Styles', 'kinetix'),
        esc_html__('Customize Styles', 'kinetix'),
        'manage_options',
        'customize.php',
        'kinetix_redirect_to_customizer'
    );
}
add_action('admin_menu', 'kinetix_register_admin_menu');

function kinetix_redirect_to_customizer() {
    wp_safe_redirect(admin_url('customize.php'));
    exit;
}

function kinetix_admin_styles() {
    ?>
    <style>
        .kinetix-admin-wrap { max-width: 1180px; margin: 24px 20px 0 0; color: #f5f5f5; }
        .kinetix-admin-wrap h1 { color: #fff; font-size: 32px; }
        .kinetix-admin-shell { background: #0a0a0a; padding: 28px; border-radius: 12px; }
        .kinetix-admin-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 16px; }
        .kinetix-admin-card { background: #121212; border: 1px solid rgba(255,255,255,.08); border-radius: 10px; padding: 22px; }
        .kinetix-admin-card h2 { color: #fff; font-size: 18px; margin-top: 0; }
        .kinetix-admin-card p { color: #aaa; }
        .kinetix-admin-card a, .kinetix-admin-accent { color: #ff2a2a; }
        .kinetix-admin-badge { display: inline-block; background: #ff2a2a; color: #fff; border-radius: 999px; padding: 7px 12px; font-weight: 600; }
        .kinetix-import-status { margin-top: 16px; font-weight: 600; }
        .kinetix-import-modal { display: none; position: fixed; inset: 0; z-index: 100000; align-items: center; justify-content: center; background: rgba(0,0,0,.7); }
        .kinetix-import-modal.is-visible { display: flex; }
        .kinetix-import-modal__content { max-width: 420px; padding: 28px; border: 1px solid rgba(255,255,255,.1); border-radius: 12px; background: #121212; color: #fff; text-align: center; }
    </style>
    <?php
}

function kinetix_render_dashboard() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'kinetix'));
    }
    ?>
    <div class="wrap kinetix-admin-wrap">
        <?php kinetix_admin_styles(); ?>
        <div class="kinetix-admin-shell">
            <h1><?php echo esc_html__('Kinetix Dashboard', 'kinetix'); ?></h1>
            <p><?php echo esc_html__('Enterprise controls for your broadcast, research, and sprint publishing system.', 'kinetix'); ?></p>
            <p><span class="kinetix-admin-badge"><?php echo esc_html__('Enterprise Active', 'kinetix'); ?></span></p>
            <div class="kinetix-admin-grid">
                <?php
                $cards = array(
                    array('Color Palette & Accent', admin_url('customize.php?autofocus[section]=kinetix_variants')),
                    array('Typography (Anton & Inter)', admin_url('customize.php')),
                    array('Header & Navigation Styles', admin_url('customize.php')),
                    array('Card & Motion Styles', admin_url('customize.php')),
                );
                foreach ($cards as $card) :
                    ?>
                    <div class="kinetix-admin-card">
                        <h2><?php echo esc_html($card[0]); ?></h2>
                        <p><?php echo esc_html__('Tune this part of the Kinetix experience from the native WordPress Customizer.', 'kinetix'); ?></p>
                        <a href="<?php echo esc_url($card[1]); ?>"><?php echo esc_html__('Open Customizer', 'kinetix'); ?> &rarr;</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}

function kinetix_render_starter_sites() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'kinetix'));
    }
    ?>
    <div class="wrap kinetix-admin-wrap">
        <?php kinetix_admin_styles(); ?>
        <div class="kinetix-admin-shell">
            <h1><?php echo esc_html__('Starter Sites', 'kinetix'); ?></h1>
            <div class="kinetix-admin-card">
                <h2><?php echo esc_html__('Kinetix Broadcast & Research Flagship', 'kinetix'); ?></h2>
                <p><?php echo esc_html__('Quayutec broadcast energy paired with VetSafeCare-inspired research publishing. Import curated projects, papers, and sprint tiers in one click.', 'kinetix'); ?></p>
                <button type="button" class="button button-primary" id="kinetix-import-demo"><?php echo esc_html__('Import Demo Site', 'kinetix'); ?></button>
                <span id="kinetix-import-spinner" class="spinner" aria-hidden="true"></span>
                <p class="kinetix-import-status" id="kinetix-import-status" role="status"></p>
            </div>
        </div>
    </div>
    <div class="kinetix-import-modal" id="kinetix-import-modal" role="dialog" aria-modal="true" aria-labelledby="kinetix-import-modal-title">
        <div class="kinetix-import-modal__content">
            <h2 id="kinetix-import-modal-title"><?php echo esc_html__('Starter Site Imported', 'kinetix'); ?></h2>
            <p><?php echo esc_html__('Your projects, research papers, and sprint tiers are ready.', 'kinetix'); ?></p>
            <button type="button" class="button" id="kinetix-import-modal-close"><?php echo esc_html__('Close', 'kinetix'); ?></button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('kinetix-import-demo');
            const spinner = document.getElementById('kinetix-import-spinner');
            const status = document.getElementById('kinetix-import-status');
            const modal = document.getElementById('kinetix-import-modal');
            const modalClose = document.getElementById('kinetix-import-modal-close');
            if (!button) return;
            modalClose.addEventListener('click', function () {
                modal.classList.remove('is-visible');
            });
            button.addEventListener('click', function () {
                button.disabled = true;
                spinner.classList.add('is-active');
                const data = new FormData();
                data.append('action', 'kinetix_import_starter_site');
                data.append('nonce', '<?php echo esc_js(wp_create_nonce('kinetix_importer_nonce')); ?>');
                fetch(ajaxurl, { method: 'POST', credentials: 'same-origin', body: data })
                    .then(response => response.json())
                    .then(result => {
                        status.textContent = result.success && result.data && result.data.message
                            ? result.data.message
                            : '<?php echo esc_js(__('The demo import could not be completed.', 'kinetix')); ?>';
                        status.style.color = result.success ? '#46b450' : '#dc3232';
                        if (result.success) {
                            modal.classList.add('is-visible');
                        }
                    })
                    .catch(() => {
                        status.textContent = '<?php echo esc_js(__('The demo import could not be completed.', 'kinetix')); ?>';
                        status.style.color = '#dc3232';
                    })
                    .finally(() => {
                        button.disabled = false;
                        spinner.classList.remove('is-active');
                    });
            });
        });
    </script>
    <?php
}
