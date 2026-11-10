<?php
/**
 * The main template file
 *
 * @package Kinetix
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main class="py-5" style="padding-top: 140px; min-height: 80vh;">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php
get_footer();