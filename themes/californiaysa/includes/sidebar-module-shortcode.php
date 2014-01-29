<?php
function sidebar_module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'Sidebar'
	), $atts ) );
	
	$theSidebarModule = '';
	
	ob_start();
	dynamic_sidebar('module-sidebar');
	$theSidebarModule .= ob_get_contents();
	ob_end_clean();
	
	return $theSidebarModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>