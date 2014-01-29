<?php
/**
 * Registering meta boxes
 * For all meta box definitions, see meta-box-demo.php
 * For more information, please visit: 
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'calysa_';

global $meta_boxes;

$meta_boxes = array();


$meta_boxes[] = array(
	'id' => 'module-custom',
	'title' => 'Module Custom Fields',
	'pages' => array( 'module' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// NEW(!) PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'	=> 'Module Image',
			'desc'	=> 'Image or background image for certain modules',
			'id'	=> "{$prefix}module_image",
			'type'	=> 'plupload_image'
		),
		array(
			'name'	=> 'Modals',
			'desc'	=> "Enter modal windows and content here. The div class='modals' will be generated automatically, and need not be included.",
			'id'	=> $prefix . 'modal',
			'type'	=> 'textarea',
			'cols'	=> "40",
			'rows'	=> "8"
		),
		array(
			'name'	=> 'Additional CSS Classes',
			'id'	=> $prefix . 'css_classes',
			'type'	=> 'text'
		)
	)
);
$meta_boxes[] = array(
	'id' => 'activities',
	'title' => 'Activities Custom Fields',
	'pages' => array( 'activity' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Activity Type',
			'id'		=> $prefix . 'activity_type',
			'type'		=> 'select',
			// Array of 'key' => 'value' pairs for select box
			'options'	=> array(
				''					=> 'Choose a type &nbsp;',
				'missionary'		=> 'Missionary',
				'reach-rescue'		=> 'Reach and Rescue',
				'service'			=> 'Service',
				'temple'			=> 'Temple'
			)
		),
		array(
			'name'		=> 'Date',
			'id'		=> $prefix . 'date',
			'type'		=> 'date'
		),
		array(
			'name'		=> 'Time',
			'id'		=> $prefix . 'time',
			'type'		=> 'time',
			'format'	=> 'h:mm TT'
		),
		array(
			'name'	=> 'Street',
			'id'	=> $prefix . 'address_street1',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'Street 2',
			'id'	=> $prefix . 'address_street2',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'City',
			'id'	=> $prefix . 'address_city',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'State',
			'id'	=> $prefix . 'address_state',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'Zip Code',
			'id'	=> $prefix . 'address_zip',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'Secondary Title',
			'id'	=> $prefix . 'secondary_title',
			'type'	=> 'text'
		)
	)
);
$meta_boxes[] = array(
	'id' => 'custom-posts',
	'title' => 'Post Custom Fields',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'	=> 'Author',
			'id'	=> $prefix . 'post_author',
			'type'	=> 'text'
		)
	)
);
$meta_boxes[] = array(
	'id' => 'goals',
	'title' => 'Goal Fields',
	'pages' => array( 'goal' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'	=> 'April 22 Count',
			'id'	=> $prefix . '04_22_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'April 29 Count',
			'id'	=> $prefix . '04_29_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'May 6 Count',
			'id'	=> $prefix . '05_06_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'May 13 Count',
			'id'	=> $prefix . '05_13_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'May 20 Count',
			'id'	=> $prefix . '05_20_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'May 27 Count',
			'id'	=> $prefix . '05_27_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'June 3 Count',
			'id'	=> $prefix . '06_03_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'June 10 Count',
			'id'	=> $prefix . '06_10_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'June 17 Count',
			'id'	=> $prefix . '06_17_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'June 24 Count',
			'id'	=> $prefix . '06_24_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'July 1 Count',
			'id'	=> $prefix . '07_01_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'July 8 Count',
			'id'	=> $prefix . '07_08_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'July 15 Count',
			'id'	=> $prefix . '07_15_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'July 22 Count',
			'id'	=> $prefix . '07_22_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'July 29 Count',
			'id'	=> $prefix . '07_29_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'August 5 Count',
			'id'	=> $prefix . '08_05_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'August 12 Count',
			'id'	=> $prefix . '08_12_goal_count',
			'type'	=> 'text'
		),
		array(
			'name'	=> 'August 19 Count',
			'id'	=> $prefix . '08_19_goal_count',
			'type'	=> 'text'
		),
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function calysa_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'calysa_register_meta_boxes' );