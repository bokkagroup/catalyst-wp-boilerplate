<?php
namespace BokkaWP\Theme\models;

class ModelDetail extends \BokkaWP\MVC\Model
{
    public function initialize()
    {
        global $post;
        $post->neighborhood = get_post($post->neighborhood);
        $post->neighborhood->link = get_the_permalink($post->neighborhood);
        $post->neighborhood->title = get_the_title($post->neighborhood);
        $form = gravity_form(4, false, false, false, null, $ajax = true, 0, false);
        $post->brand_window_form = array('modal_content'=> $form);
        $post->map = array(
            'address_1' => $post->address_1,
            'address_2' => $post->address_2,
            'city'      => $post->neighborhood->city,
            'state'     => $post->neighborhood->state,
            'zip'       => $post->neighborhood->zip,
            'hours'     => $post->neighborhood->hours,
            'phone'     => $post->neighborhood->phone,
            'latitude'  => $post->latitude,
            'longitude' => $post->longitude,
            'zoom'      => 14
        );

        $post->map['sale_team_members'] = getSalesTeamMembers($post->neighborhood->ID);

        $post->pdf = wp_get_attachment_url($post->pdf);
        $form = gravity_form(4, false, false, false, null, $ajax = true, 0, false);
        $post->coming_soon =  array('modal_content'=> $form);
        $this->data = $post;
    }
}