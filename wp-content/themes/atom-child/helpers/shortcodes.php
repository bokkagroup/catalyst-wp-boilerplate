<?php

function button_shortcode($atts, $content = "")
{
    $a = shortcode_atts(array(
        'url' => '',
        'color' => '',
        'class' => '',
        'target' => '_self'
    ), $atts);
    $color = esc_attr($a['color']);
    $class = esc_attr($a['class']);
    $target = esc_attr($a['target']);
    $output = '<a class="button ' . $color . ' ' . $class . '" href="' . esc_attr($a['url']) . '" target="' . $target . '">' . $content . '</a>';
    return $output;
}
add_shortcode('button', 'button_shortcode');

// output URL parameters
function get_parameters($atts)
{
    $a = shortcode_atts(array(
        'q' => '',
    ), $atts);

    $q = $a['q'];
    return $_GET[$q];
}
add_shortcode('parameters', 'get_parameters');
