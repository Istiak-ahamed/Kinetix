<?php
defined('ABSPATH') || exit;
?>
<nav class="kinetix-nav-floating" aria-label="<?php echo esc_attr__('Primary navigation', 'kinetix'); ?>">
    <div class="d-flex align-items-center justify-content-between gap-3">
        <a class="kinetix-brand text-decoration-none" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="text-white fw-bold">ISTIAK<span class="text-danger">.</span></span>
        </a>

        <div class="d-none d-lg-flex align-items-center justify-content-center gap-1">
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#work')); ?>"><?php echo esc_html__('Work', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#clients')); ?>"><?php echo esc_html__('Clients', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#sprints')); ?>"><?php echo esc_html__('Sprints', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#research')); ?>"><?php echo esc_html__('Research', 'kinetix'); ?></a>
            <a class="kinetix-nav-link" href="<?php echo esc_url(home_url('/#about')); ?>"><?php echo esc_html__('About', 'kinetix'); ?></a>
        </div>

        <a class="btn-kinetix-crimson text-nowrap" href="<?php echo esc_url(home_url('/#book-a-sprint')); ?>">
            <?php echo esc_html__('Book a Sprint', 'kinetix'); ?>
        </a>
    </div>
</nav>
