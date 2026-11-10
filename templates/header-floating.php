<?php
defined('ABSPATH') || exit;
?>
<?php
$header_style = isset($args['header_style']) ? $args['header_style'] : get_theme_mod('kinetix_header_style', 'pill');
?>
<nav class="kinetix-nav-floating header-layout-<?php echo esc_attr($header_style); ?>" aria-label="<?php echo esc_attr__('Primary navigation', 'kinetix'); ?>">
    <div class="kinetix-header-inner d-flex align-items-center justify-content-between gap-3">
        <a class="kinetix-brand text-decoration-none" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="text-white fw-bold">ISTIAK<span class="text-danger">.</span></span>
        </a>

        <div class="kinetix-header-nav d-none d-lg-flex align-items-center justify-content-center gap-1">
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#work')); ?>"><?php echo esc_html__('Work', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#clients')); ?>"><?php echo esc_html__('Clients', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#sprints')); ?>"><?php echo esc_html__('Sprints', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#research')); ?>"><?php echo esc_html__('Research', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#about')); ?>"><?php echo esc_html__('About', 'kinetix'); ?></a>
        </div>

        <a class="btn-kinetix-crimson aceternity-shimmer-btn kinetix-header-cta text-nowrap" href="<?php echo esc_url(home_url('/#book-a-sprint')); ?>">
            <?php echo esc_html__('Book a Sprint', 'kinetix'); ?>
        </a>
    </div>
</nav>
