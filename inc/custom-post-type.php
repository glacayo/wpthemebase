<?php
add_action( 'init', 'cptui_register_my_cpts_services' );

function cptui_register_my_cpts_services() {

  $labels = array(

    "name" => __( 'Services', '' ),

    "singular_name" => __( 'Service', '' ),

    "menu_name" => __( 'Services', '' ),

    "all_items" => __( 'All Services', '' ),

    "add_new" => __( 'Add New', '' ),

    "add_new_item" => __( 'Add New Services', '' ),

    "edit_item" => __( 'Edit Services', '' ),

    "new_item" => __( 'New Services', '' ),

    "view_item" => __( 'View Service', '' ),

    "search_items" => __( 'Search Service', '' ),

    "not_found" => __( 'No Services Found', '' ),

    "not_found_in_trash" => __( 'No Services Found in Trash', '' ),

    "parent" => __( 'Parent Service', '' ),

    "featured_image" => __( 'Featured Image for this service', '' ),

    "set_featured_image" => __( 'Set Featured Image for this service', '' ),

    "remove_featured_image" => __( 'Remove Featured Image for this service', '' ),

    "use_featured_image" => __( 'Use as Featured Image for this service', '' ),

    "archives" => __( 'Service Archive', '' ),

    "insert_into_item" => __( 'Insert into Service', '' ),

    "filter_items_list" => __( 'Filter Services List', '' ),

    "items_list_navigation" => __( 'Services List Navigation', '' ),

    "items_list" => __( 'Services List', '' ),

    );



  $args = array(

    "label" => __( 'Services', '' ),

    "labels" => $labels,

    "description" => "En esta sección se guardaran todos los servicios que ofrece la empresa",

    "public" => true,

    "publicly_queryable" => false,

    "show_ui" => true,

    "show_in_rest" => false,

    "rest_base" => "",

    "has_archive" => false,

    "show_in_menu" => true,

    "exclude_from_search" => false,

    "capability_type" => "post",

    "map_meta_cap" => true,

    "hierarchical" => false,

    "rewrite" => array( "slug" => "services", "with_front" => true ),

    "query_var" => true,

    "menu_icon" => "dashicons-hammer",   

    "supports" => array( "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ),        

  );

  register_post_type( "services", $args );



}

add_action( 'init', 'cptui_register_my_taxes_services' );

function cptui_register_my_taxes_services() {

  $labels = array(

    "name" => __( 'Services', '' ),

    "singular_name" => __( 'Service', '' ),

    );



  $args = array(

    "label" => __( 'Services', '' ),

    "labels" => $labels,

    "public" => true,

    "hierarchical" => false,

    "label" => "Services",

    "show_ui" => true,

    "query_var" => true,

    "rewrite" => array( 'slug' => 'services', 'with_front' => true ),

    "show_admin_column" => false,

    "show_in_rest" => false,

    "rest_base" => "",

    "show_in_quick_edit" => false,

  );

  register_taxonomy( "services", array( "services" ), $args );



}

add_action( 'pre_get_posts', 'cptui_register_my_taxes_services' ); // SE ELIMINO LA FUNCION QUE AGREGA EL POST TYPE AL LOOP MAIN DE WP

function add_my_post_types_to_query( $query ) {

  if ( is_home() && $query->is_main_query() )

    $query->set( 'post_type', array( 'post', 'services' ) );

  return $query;

}