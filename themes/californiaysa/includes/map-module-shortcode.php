<?php
function map_module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'Find Your Location',
		'type' => 'module',
		'numposts' => 1,
		'moretext' => 'More &raquo;',
		'morelink' => '',
		'subcat' => '',
		'orderby' => 'date',
	), $atts ) );
	
	$theMapModule = "<div class='module module-google-map'>\n";
	$theMapModule .= "\t<h2><a href=''>".$name."</a></h2>\n";
	$theMapModule .= "</div>\n";
	return $theMapModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>