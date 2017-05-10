<?php
get_template_part('templates/head');
get_template_part('templates/header');
do_action('bwt\before_content'); ?>

    <div id="content" class="content">
        <?php
        global $wp_query;
        if (is_front_page()) {
            new \BokkaWP\Theme\controllers\HomeController();
        } elseif (is_page(181)) {
            new \BokkaWP\Theme\controllers\StyleguideController();
        } elseif (is_page('ask-a-question')) {
            new \BokkaWP\Theme\controllers\ContactUsController();
        } elseif (is_page(2785)) {
            new \BokkaWP\Theme\controllers\TeamController();
        } elseif (is_singular('communities')) {
            new \BokkaWP\Theme\controllers\NeighborhoodsController();
        } elseif (is_singular('plans')) {
            new \BokkaWP\Theme\controllers\FloorplanController();
        } elseif (is_singular('model')) {
            new \BokkaWP\Theme\controllers\ModelDetailController();
        } elseif (is_singular('home')) {
            new \BokkaWP\Theme\controllers\HomesController();
        } elseif (is_page('our-neighborhoods')) {
            new \BokkaWP\Theme\controllers\NeighborhoodsOvController();
        } elseif (is_page('quick-move-in-homes')) {
            new \BokkaWP\Theme\controllers\QuickMoveInHomesController();
        } elseif (is_page('model-homes')) {
            new \BokkaWP\Theme\controllers\ModelHomesController();
        } elseif (is_page('our-locations')) {
            new \BokkaWP\Theme\controllers\OrganismsController();
            new \BokkaWP\Theme\controllers\LocationsController();
        } elseif (is_page()) {
            new \BokkaWP\Theme\controllers\OrganismsController();
        } elseif (is_post_type_archive('blog-post') ||
            is_tax('blog-post-category') ||
            is_post_type_archive('career') ||
            is_tax('career-category') ||
            is_post_type_archive('event') ||
            is_tax('event-category') ||
            is_post_type_archive('testimonial') ||
            is_tax('testimonial-category')) {
            new \BokkaWP\Theme\controllers\CustomPostArchiveController();
        } elseif (is_tax()) {
        } elseif (is_archive()) {
        } elseif (is_singular(array('blog-post', 'career', 'event', 'testimonial'))) {
            new \BokkaWP\Theme\controllers\CustomPostSingleController();
        } elseif (is_single()) {
        } elseif (is_category()) {
        } elseif (is_404()) {
            new \BokkaWP\Theme\controllers\PageNotFoundController();
        } else {
        }
        //Determine which controller to use
        ?>
    </div><!--/content-->

<?php do_action('bwt\after_content');
get_template_part('templates/footer');

?>