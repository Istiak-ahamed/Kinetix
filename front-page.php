<?php
/**
 * Front page template.
 *
 * @package Kinetix
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="kinetix-hero py-5" aria-labelledby="kinetix-hero-title">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge rounded-pill border border-danger-subtle bg-transparent px-3 py-2 text-danger text-uppercase">
                        <?php echo esc_html__('Broadcast design / creative direction', 'kinetix'); ?>
                    </span>
                    <h1 id="kinetix-hero-title" class="display-1 display-heading mt-4 mb-4">
                        <?php echo esc_html__('BROADCAST DESIGN BUILT FOR THE BIG STAGE.', 'kinetix'); ?>
                    </h1>
                    <p class="lead mb-4 text-secondary">
                        <?php echo esc_html__('High-impact visual systems, show packages, and motion identities for brands that need to own the room.', 'kinetix'); ?>
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a class="btn-kinetix-crimson" href="<?php echo esc_url(home_url('/#work')); ?>">
                            <?php echo esc_html__('View the work', 'kinetix'); ?>
                        </a>
                        <a class="btn btn-outline-light rounded-pill px-4" href="<?php echo esc_url(home_url('/#book-a-sprint')); ?>">
                            <?php echo esc_html__('Start a sprint', 'kinetix'); ?>
                        </a>
                    </div>
                    <p class="small text-secondary mb-0">
                        <?php echo esc_html__('Former COO, RTB Esports', 'kinetix'); ?>
                        <span class="mx-2 text-danger" aria-hidden="true">/</span>
                        <?php echo esc_html__('Built for broadcast, esports, and culture.', 'kinetix'); ?>
                    </p>
                </div>

                <div class="col-lg-5">
                    <article class="kinetix-card h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="badge rounded-pill bg-danger text-white"><?php echo esc_html__('ON-AIR READY', 'kinetix'); ?></span>
                            <span class="small text-secondary"><?php echo esc_html__('01 / 04', 'kinetix'); ?></span>
                        </div>
                        <div class="ratio ratio-16x9 mb-4 rounded-4 bg-black d-flex align-items-center justify-content-center overflow-hidden">
                            <span class="small text-uppercase text-secondary"><?php echo esc_html__('Showreel / cutout', 'kinetix'); ?></span>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <span class="d-block small text-secondary"><?php echo esc_html__('Deliverable', 'kinetix'); ?></span>
                                <strong class="d-block mt-1"><?php echo esc_html__('Full show package', 'kinetix'); ?></strong>
                            </div>
                            <div class="col-6">
                                <span class="d-block small text-secondary"><?php echo esc_html__('Turnaround', 'kinetix'); ?></span>
                                <strong class="d-block mt-1"><?php echo esc_html__('Sprint-ready', 'kinetix'); ?></strong>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
