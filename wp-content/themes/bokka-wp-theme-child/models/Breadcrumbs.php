<?php

namespace BokkaWP\Theme\models;

class Breadcrumbs extends \BokkaWP\MVC\Model
{
    public function initialize()
    {
        if (is_singular(array('plans')) ||
            is_singular(array('model'))) {
            $this->data = $this->plansAndModels();
        } elseif (is_singular(array('home'))) {
            $this->data = $this->homes();
        } elseif (is_singular(array('communities')) || is_page('all-neighborhoods')) {
            $this->data = $this->neighborhoods();
        }
    }

    /**
     * Generates an array of links and their title
     * @return array
     */
    public function plansAndModels()
    {
        global $post;
        $obj = get_post_type_object(get_post_type($post));
        $postfix = $obj->labels->singular_name;

        return array(
            array(
                'title' => 'Home',
                'link' => '/'
            ),
            array(
                'title' => get_the_title($post->neighborhood),
                'link' => get_permalink($post->neighborhood),
                'class' => 'icon icon-our-neighborhoods'
            ),
            array(
                'title' => $post->post_title .' '. $postfix,
                'link' => '#',
                'class' => 'icon icon-our-homes'
            )
        );
    }

    public function homes()
    {
        global $post;

        return array(
            array(
                'title' => 'Home',
                'link' => '/'
            ),
            array(
                'title' => get_the_title($post->neighborhood),
                'link' => get_permalink($post->neighborhood),
                'class' => 'icon icon-our-neighborhoods'
            ),
            array(
                'title' => 'Quick Move-In Homes',
                'link' => get_the_title($post->neighborhood)."/#quick-move-in"
            ),
            array(
                'title' => $post->post_title,
                'link' => '#',
                'class' => 'icon icon-our-homes'
            )
        );
    }

    public function neighborhoods()
    {
        global $post;

        return array(
            array(
                'title' => 'Home',
                'link' => '/'
            ),
            array(
                'title' => get_the_title($post->neighborhood),
                'link' => get_permalink($post->neighborhood),
                'class' => 'icon icon-our-neighborhoods'
            )
        );
    }
}
