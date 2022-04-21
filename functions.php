<?php
/****************************************************************************
*************** FUNCION PARA HABILITAR THUMBNAIL EN WP **********************
*****************************************************************************/
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );
/***************************************************************************
****************** FUNCION PARA REGISTRAR EL MENU **************************
****************************************************************************/
function register_try_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'sidebar-menu' => __( 'Sidebar Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
      'services-footer-menu' => __( 'Services footer menu' )
    )
  );
}
add_action( 'init', 'register_try_menus' );
/****************************************************************************
*** Limpiar de caractaeres especiales los numeros de telefonos  ***
*****************************************************************************/
function numberPhone($string) {
  $string = preg_replace("/[^0-9]/", "", $string);
  return $string; // Removes special chars.
  }
/***************************************************************************
******************************  BREADCRUMBS  *******************************
****************************************************************************/
include_once('inc/breadcrumbs.php');
/***************************************************************************
*****************  DESHABILITAR COMENTARIOS EN WORDPRESS  ******************
****************************************************************************/
include_once('inc/disable-comments.php');
/****************************************************************************
**************** AGREGANDO CUSTOM POST TYPE PARA SERVICIOS ******************
*****************************************************************************/
include_once('inc/custom-post-type.php');
/****************************************************************************
***************************** REMOVE ACTIONS ********************************
*****************************************************************************/
include_once('inc/remove-actions.php');
/****************************************************************************
***************************** WIDGETS OPTIONS *******************************
*****************************************************************************/
include_once('inc/widgets.php');
/****************************************************************************
************************* CONTACT FORM 7 FUNCTIONS **************************
*****************************************************************************/
include_once('inc/cf7-functions.php');
/****************************************************************************
 ******************* THEME OPTIONS REDUX FRAMEWORK ***************************
 *****************************************************************************/

if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/vendor/redux-framework/redux-framework.php')) {
    require_once(dirname(__FILE__) . '/vendor/redux-framework/redux-framework.php');
  }  
  if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/vendor/redux-framework/sample/options.php')) {  
    require_once(dirname(__FILE__) . '/vendor/redux-framework/sample/options.php');
  }
  Redux::disable_demo();


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/vendor/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		
		// <snip />
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			// <snip>...</snip>
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
		*/
	);

	tgmpa( $plugins, $config );

}