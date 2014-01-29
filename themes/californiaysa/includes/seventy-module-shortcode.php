<?php
function seventy_module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'From the Seventy',
		'type' => 'module',
		'numposts' => 1,
		'catName' => 'seventy'
	), $atts ) );
	
	
	$seventyModuleData = get_posts(array( 'post_type' => $type, 'name' => $name, 'category' => get_category_by_slug($catName)->term_id, 'numberposts' => $numposts ));
	

	$theSeventyModule = "<div class='module module-seventy'>\n";
	$theSeventyModule .= "\t<h2><a class='modal-activator' href='".$seventyModuleData[0]->post_content."'>".$name."</a></h2>\n\t<div class='module-content'>";
	if ( has_post_thumbnail($seventyModuleData[0]->ID) ) {
		$theSeventyModule .= "\t\t<a class='modal-activator' href='".$seventyModuleData[0]->post_content."'>\n\t\t\t";
		$theSeventyModule .= get_the_post_thumbnail($seventyModuleData[0]->ID, 'full');
		$theSeventyModule .= "\n\t\t</a>\n";
	}
	$theSeventyModule .= "\t\t<a class='btn modal-activator' href='".$seventyModuleData[0]->post_content."'><span><span class='icn-play'></span></span></a>\n\t</div>\n";
	$theSeventyModule .= "\t<div class='modals'>\n";
	if(count(get_post_meta($seventyModuleData[0]->ID,'calysa_modal',true)) > 0) { 
		$theSeventyModule .= get_post_meta($seventyModuleData[0]->ID,'calysa_modal',true);
	}
	$theSeventyModule .= "\t</div>\n</div>\n";
	return $theSeventyModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>