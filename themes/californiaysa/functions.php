<?php
// Load jQuery
if ( !function_exists(core_mods) ) {
	function core_mods() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
			wp_enqueue_script('jquery');
		}
	}
	core_mods();
}

// body class filter
add_filter('body_class','custom_body_classes');
function custom_body_classes($classes) {
	global $post;
	$gallery = get_posts( array('post_type'=>'module','name'=>'gallery') );
	if(get_post_meta($post->ID,'Gallery',true) || isset($gallery[0]) ) {
		$classes[] = 'has-gallery';
	}
	$classes[] = $post->post_name;
	return $classes;
}

// register menus
add_action( 'init', 'register_menus' );
function register_menus() {
	register_nav_menus(
		array(
			'main-menu'		=> __( 'Main Menu' ),
			'sidebar-menu'	=> __( 'Sidebar Menu' ),
			'footer-menu'	=> __( 'Footer Menu' )
		)
	);
}

function add_first_and_last($output) {
	$output = preg_replace('/class="(\w*\s)?menu-item/', 'class="$1first-menu-item menu-item', $output, 1);
	$pos=strripos($output, 'class="menu-item');
	$len=strlen('class="menu-item');
	$rep='class="last-menu-item menu-item';
	//double-check for a later entry with menu-item later in the
	//class list
	if(strripos($output, ' menu-item ')>$pos){
	  $pos=strripos($output, ' menu-item ');
	  $len=strlen(' menu-item ');
	  $rep=' last-menu-item menu-item ';
	}
	$output = substr_replace($output, $rep, $pos, $len);
	return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

// post thumbnail support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
}


// register Activity category and post type
add_action( 'init', 'create_activity_taxonomy', 0 );
function create_activity_taxonomy() {
	register_taxonomy('activity_category',array('activity'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Activity Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Activity Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Activity Categories' ),
			'all_items' => __( 'All Activity Categories' ),
			'parent_item' => __( 'Parent Activity Category' ),
			'parent_item_colon' => __( 'Parent Activity Category:' ),
			'edit_item' => __( 'Edit Activity Category' ), 
			'update_item' => __( 'Update Activity Category' ),
			'add_new_item' => __( 'Add New Activity Category' ),
			'new_item_name' => __( 'New Activity Category Name' ),
			'menu_name' => __( 'Activity Categories' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'activity_category' ),
  ));
}
add_action( 'init', 'activity_post_type_init' );
function activity_post_type_init() {
	$labels = array(
		'name' => _x( 'Activities', 'post type general name' ), 
		'singular_name' => _x( 'Activity', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'activity' ),
		'add_new_item' => __( 'Add New Activity' ),
		'edit_item' => __( 'Edit Activity' ),
		'new_item' => __( 'New Activity' ),
		'view_item' => __( 'View Activity' ),
		'search_items' => __( 'Search Activity' ),
		'not_found' =>  __( 'No activities found' ),
		'not_found_in_trash' => __( 'No activities found in Trash' ),
		'parent_item_colon' => ''
	);
	 
	$args = array( 
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
 
	register_post_type( 'activity', $args ); 
}

// register Goal category and post type
add_action( 'init', 'create_goal_taxonomy', 0 );
function create_goal_taxonomy() {
	register_taxonomy('goal_category',array('goal'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Goal Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Goal Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Goal Categories' ),
			'all_items' => __( 'All Goal Categories' ),
			'parent_item' => __( 'Parent Goal Category' ),
			'parent_item_colon' => __( 'Parent Goal Category:' ),
			'edit_item' => __( 'Edit Goal Category' ), 
			'update_item' => __( 'Update Goal Category' ),
			'add_new_item' => __( 'Add New Goal Category' ),
			'new_item_name' => __( 'New Goal Category Name' ),
			'menu_name' => __( 'Goal Categories' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'goal_category' ),
  ));
}
add_action( 'init', 'goal_post_type_init' );
function goal_post_type_init() {
	$labels = array(
		'name' => _x( 'Goals', 'post type general name' ), 
		'singular_name' => _x( 'Goal', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'goal' ),
		'add_new_item' => __( 'Add New Goal' ),
		'edit_item' => __( 'Edit Goal' ),
		'new_item' => __( 'New Goal' ),
		'view_item' => __( 'View Goal' ),
		'search_items' => __( 'Search Goal' ),
		'not_found' =>  __( 'No goals found' ),
		'not_found_in_trash' => __( 'No goals found in Trash' ),
		'parent_item_colon' => ''
	);
	 
	$args = array( 
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
 
	register_post_type( 'goal', $args ); 
}

// register Module category and post type
add_action( 'init', 'create_module_taxonomy', 0 );
function create_module_taxonomy() {
	register_taxonomy('module_category',array('module'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Module Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Module Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Module Categories' ),
			'all_items' => __( 'All Module Categories' ),
			'parent_item' => __( 'Parent Module Category' ),
			'parent_item_colon' => __( 'Parent Module Category:' ),
			'edit_item' => __( 'Edit Module Category' ), 
			'update_item' => __( 'Update Module Category' ),
			'add_new_item' => __( 'Add New Module Category' ),
			'new_item_name' => __( 'New Module Category Name' ),
			'menu_name' => __( 'Module Categories' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'module_category' ),
  ));
}
add_action( 'init', 'module_post_type_init' );
function module_post_type_init() {
	$labels = array(
		'name' => _x( 'Modules', 'post type general name' ), 
		'singular_name' => _x( 'Module', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'module' ),
		'add_new_item' => __( 'Add New Module' ),
		'edit_item' => __( 'Edit Module' ),
		'new_item' => __( 'New Module' ),
		'view_item' => __( 'View Module' ),
		'search_items' => __( 'Search Module' ),
		'not_found' =>  __( 'No modules found' ),
		'not_found_in_trash' => __( 'No modules found in Trash' ),
		'parent_item_colon' => ''
	);
	 
	$args = array( 
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
 
	register_post_type( 'module', $args ); 
}

// register Module Sidebar (widgets)
register_sidebar(array(
	'name' => __( 'Module Sidebar' ),
	'id' => 'module-sidebar',
	'description' => __( 'Widgets in this area will be shown wherever the sidebar module is called' ),
	'before_widget' => '<div class="module module-sidebar">',
	'after_widget' => '</div>',
	'before_title' => '<h2><a>',
	'after_title' => '</a></h2>'
));

// shortcodes
// root path shortcode
function root_path_shortcode() {
	return get_bloginfo('url') . '/';
}
add_shortcode('root_path', 'root_path_shortcode');

// picasa gallery shortcode
	include 'includes/picasa-gallery-shortcode.php';
add_shortcode('picasa', 'picasa_gallery_shortcode');
add_shortcode('picasa_full', 'picasa_gallery_full_shortcode');

// add home page gallery shortcode
	include 'includes/home-gallery-shortcode.php';
add_shortcode('banners', 'banner_shortcode');

// add home page module shortcode
	include 'includes/module-shortcode.php';
add_shortcode('module', 'module_shortcode');

// add map module shortcode
	include 'includes/map-module-shortcode.php';
add_shortcode('map_module', 'map_module_shortcode');

// add social module shortcode
	include 'includes/social-module-shortcode.php';
add_shortcode('social_module', 'social_module_shortcode');

// add Seventy module shortcode
	include 'includes/seventy-module-shortcode.php';
add_shortcode('seventy_module', 'seventy_module_shortcode');

// add goals module shortcode
	include 'includes/goals-module-shortcode.php';
add_shortcode('goals_module', 'goals_module_shortcode');

// add sidebar module shortcode
	include 'includes/sidebar-module-shortcode.php';
add_shortcode('sidebar_module', 'sidebar_module_shortcode');

// run shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

// post thumbnail function
function customPostThumbnail($postID,$size) {
	if ( has_post_thumbnail($postID) ) {
		$thisThumbnail = '<a class="post-thumbnail-container" href="';
		$thisThumbnail .= get_permalink($postID);
		$thisThumbnail .= '">';
		$thisThumbnail .= get_the_post_thumbnail($postID, $size);
		$thisThumbnail .= '</a>';
		return $thisThumbnail;
	}
}
include 'includes/meta-box.php';


// adding new setting for site offline mode to general settings page
// borrowed from http://codex.wordpress.org/Settings_API
function offline_setting_init() {
// Add the section to reading settings so we can add our
// fields to it
add_settings_section('offline_setting_section',
	'Site Offline Switch',
	'offline_setting_section_callback_function',
	'general');

// Add the field with the names and function to use for our new
// settings, put it in our new section
add_settings_field('offline_setting_name',
	'<strong>Site Offline</strong>',
	'offline_setting_callback_function',
	'general',
	'offline_setting_section');

// Register our setting so that $_POST handling is done for us and
// our callback function just has to echo the <input>
register_setting('general','offline_setting_name');
}// offline_settings_api_init()

add_action('admin_init', 'offline_setting_init');


// ------------------------------------------------------------------
// Settings section callback function
// ------------------------------------------------------------------
//
// This function is needed if we added a new section. This function 
// will be run at the start of our section
//

function offline_setting_section_callback_function() {
echo '<div style="max-width:500px"><p>This checkbox allows you to take the site offline and display only the "placeholder.php" file located at wp-content\themes\californiaysa\includes to users who are not logged in.</p><p>The checkbox should remain <strong>unchecked</strong> for <strong>normal site operation</strong>.</p><p>The checkbox should be <strong>checked</strong> to take the site <strong>offline</strong>.</p></div>';
}

// ------------------------------------------------------------------
// Callback function for our example setting
// ------------------------------------------------------------------
//
// creates a checkbox true/false option. Other types are surely possible
//

function offline_setting_callback_function() {
echo '<input name="offline_setting_name" id="gv_thumbnails_insert_into_excerpt" type="checkbox" value="1" class="code" ' . checked( 1, get_option('offline_setting_name'), false ) . ' />';
}

// this will load the placeholder page for all non-logged in users as long as it's enabled.
if (get_option('offline_setting_name') == true) {
	function maintenace_mode() {
		if ( !current_user_can( 'read' ) || !is_user_logged_in() ) {
			die(include 'includes/placeholder.php');
		}
	}
	add_action('get_header', 'maintenace_mode');
}

date_default_timezone_set('America/Los_Angeles');

?>