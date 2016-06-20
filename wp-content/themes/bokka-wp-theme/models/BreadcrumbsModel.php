<?php

namespace BokkaWP\Theme\models;

class BreadcrumbsModel extends \BokkaWP\MVC\Model
{
    public function initialize()
    {
        if (is_singular(array('plans')) ||
            is_singular(array('model'))) {
            $this->data = $this->breadcrumbs();
        } elseif(is_singular(array('home'))) {
            $this->data = $this->breadcrumbs_homes();
        }
    }

    /**
     * Generates an array of links and their title
     * @return array
     */
    public function breadcrumbs()
    {
        global $post;
        $obj =   get_post_type_object( get_post_type($post) );
        $postfix = $obj->labels->singular_name;
        $crumbs = [];
        $crumbs[0]['title'] = 'Home';
        $crumbs[0]['link'] = '/';
        $crumbs[1]['title'] = get_the_title($post->neighborhood);
        $crumbs[1]['link'] = get_permalink($post->neighborhood);
        $crumbs[1]['class'] = 'icon icon-our-neighborhoods';
        $crumbs[2]['title'] = $post->post_title .' '. $postfix;
        $crumbs[2]['link'] = '#';
        $crumbs[2]['class'] = 'icon icon-our-homes';
        return $crumbs;
    }

    public function breadcrumbs_homes()
    {
        global $post;
        $crumbs = [];
        $crumbs[0]['title'] = 'Home';
        $crumbs[0]['link'] = '/';
        $crumbs[1]['title'] = get_the_title($post->neighborhood);
        $crumbs[1]['link'] = get_permalink($post->neighborhood);
        $crumbs[1]['class'] = 'icon icon-our-neighborhoods';
        $crumbs[2]['link'] = get_the_title($post->neighborhood)."/#quick-move-in";
        $crumbs[2]['title'] = "Quick Move-In Homes";
        $crumbs[3]['title'] = $post->post_title;
        $crumbs[3]['link'] = '#';
        $crumbs[3]['class'] = 'icon icon-our-homes';
        return $crumbs;
    }
}
