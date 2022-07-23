<?php
show_admin_bar(false);

/***************************************
 *     CREATE GLOBAL VARIABLES
 ***************************************/
define('HOME_URI', home_url());
define('THEME_URI', get_template_directory_uri());
define('THEME_IMAGES', THEME_URI . '/dist-assets/img');
define('DEV_CSS', THEME_URI . '/dev-assets/css');
define('DEV_JS', THEME_URI . '/dev-assets/js');
define('DIST_CSS', THEME_URI . '/dist-assets/css');
define('DIST_JS', THEME_URI . '/dist-assets/js');


/***************************************
 * Include helpers (post types, taxonomies, metaboxes etc.)
 ***************************************/


/***************************************
 * Theme Support
 ***************************************/
function theme_setup(){
	/** tag-title **/
	add_theme_support( 'title-tag' );
	/** HTML5 support **/
	add_theme_support( 'html5', array( 'script', 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style' ) );
	/* Logo Support */
	add_theme_support( 'custom-logo' );
	/* Gutenberg Styles */
	add_theme_support( 'editor-styles' );
	/* Gutenberg Colors */
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Schwarz', 'awt-theme' ),
			'slug'  => 'awt-black',
			'color'	=> '#000',
		),
		array(
			'name'  => __( 'Weiss', 'awt-theme' ),
			'slug'  => 'awt-white',
			'color' => '#fff',
		)
	) );
}
add_action('after_setup_theme','theme_setup');

/***************************************
 * Create new image sizes
 ***************************************/
/* if ( function_exists('add_image_size') ) {
	add_image_size( 'slider_lg', 960 );
} */


/***************************************
 * Enqueue scripts and styles.
 ***************************************/
function awt_style_and_scripts() {
	/* Theme Styles and Scripts einbinden */
	$js_deps = array(
		'jquery'
	);
	if ( WP_DEBUG ) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme-purge.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_enqueue_style( 'awt-style', DEV_CSS . '/theme-purge.css', array(), $modificated_css );
		wp_register_script( 'awt-script', DEV_JS . '/theme.js', $js_deps, $modificated_js, true );
	} else {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme-purge.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_enqueue_style( 'awt-style', DIST_CSS . '/theme-purge.min.css', array(), $modificated_css);
		wp_register_script( 'awt-script', DIST_JS . '/theme.min.js', $js_deps, $modificated_js, true);
	}
	/* Globale JavaScript Variabeln ausgeben */
	$awt_global_vars = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'awt-script', 'awt_vars', $awt_global_vars );
	/* JavaScript ausgeben */
	wp_enqueue_script( 'awt-script' );
}
add_action( 'wp_enqueue_scripts', 'awt_style_and_scripts' );


/***************************************
 * Add WP-Menu support and register location
 ***************************************/
function awt_register_menus() {
	$args = array(
		'socialmenu' => __( 'Social Media Menü' )
	);
	register_nav_menus( $args );
}
add_action( 'init', 'awt_register_menus' );


/***************************************
 * Remove jQuery Migrate
 ***************************************/
function awt_remove_jquery_migrate( $scripts ) {
	if ( !is_admin() && isset($scripts->registered['jquery']) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) { // Check whether the script has any dependencies
			$script->deps = array_diff( $script->deps, array(
				'jquery-migrate'
			) );
		}
	}
}
add_action( 'wp_default_scripts', 'awt_remove_jquery_migrate' );

/***************************************
 * 	Standard Taxonomies entfernen
 ***************************************/
function awt_remove_default_taxonomies(){
	global $pagenow;
	register_taxonomy( 'post_tag', array() );
	register_taxonomy( 'category', array() );
	$tax = array( 'post_tag','category' );
	if( $pagenow == 'edit-tags.php' && in_array( $_GET['taxonomy'], $tax ) ){
		wp_die('Invalid taxonomy');
	}
}
add_action( 'init', 'awt_remove_default_taxonomies' );

/***************************************
 * 	Remove unused Admin Menu Pages
 ***************************************/
function awt_remove_menus(){
	remove_menu_page( 'edit-comments.php' );		//Comments
	remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'awt_remove_menus' );


/***************************************
 * 	Dynamische Widgets definieren
 ***************************************/
function awt_widgets_init() {
 
	register_sidebar( array(
			'name' => __( 'Header', 'awt-theme' ),
			'id' => 'header',
			'description' => __( 'Widgets für den Header', 'awt-theme' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'awt-theme' ),
		'id' => 'footer',
		'description' => __( 'Widgets für den Footer', 'awt-theme' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'awt_widgets_init' );