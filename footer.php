<?php
/**
 * The master footer for Kinetix Enterprise.
 *
 * @package Kinetix
 */

defined('ABSPATH') || exit;
?>
<footer class="kinetix-footer border-top border-secondary-subtle py-4">
    <div class="container">
        <p class="mb-0 text-center small text-secondary">
            <?php
            printf(
                esc_html__('&copy; %1$s ISTIAK. All rights reserved.', 'kinetix'),
                esc_html(wp_date('Y'))
            );
            ?>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
