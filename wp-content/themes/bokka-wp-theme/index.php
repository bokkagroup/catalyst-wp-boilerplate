<?php
get_template_part('patterns/head');
get_template_part('patterns/header');
do_action('bwt\before_content'); ?>

    <div id="content" class="content">
        <?php

        //Determine which controller to use
        if (is_front_page()) {
            new \BokkaWP\Theme\controllers\HomeController();
        } elseif (is_page(181)) {
            new \BokkaWP\Theme\controllers\StyleguideController();
        } elseif (is_singular('communities')) {
            new \BokkaWP\Theme\controllers\HomesController();
        } elseif (is_tax()) {
        } elseif (is_archive()) {
        } elseif (is_single()) {
        } elseif (is_category()) {
        } elseif (is_404()) {
        }
        ?>
    </div><!--/content-->

<?php do_action('bwt\after_content');
get_template_part('patterns/footer');

?>
