<?php
function custom_scripts_method()
{
wp_register_script('customscripts', 'https://code.jquery.com/jquery-3.6.0.min.js', array('jquery'), '3.6.0', true);
wp_enqueue_script('customscripts');
}

add_action('wp_enqueue_scripts', 'custom_scripts_method');