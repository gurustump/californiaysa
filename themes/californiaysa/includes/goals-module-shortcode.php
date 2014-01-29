<?php
function goals_module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'Goals',
		'type' => 'goal',
		'page' => 'Goals',
		'numposts' => -1
	), $atts ) );
	
	$theGoalsModuleNav = '';
	$theGoalsModuleOverlay = '';
	$theGoalsModule = "<div class='module module-goals'>\n";
	$theGoalsModule .= "\t<h2><a href='".get_permalink(get_page_by_title($page)->ID)."'>".$name."</a></h2>\n\t<div class='module-content'>\n";
	$theGoalsModule .= "\t\t<ul class='chart-container'>\n";
	
	$goalCategories = get_terms('goal_category');
	foreach($goalCategories as $cat) {
		$theGoalsModule .= "\t\t\t<li class='chart-".$cat->slug."'>\n\t\t\t\t<div class='chart-wrapper' id='chart-".$cat->slug."'></div>\n";
		
		$thisGoalData = get_posts(array( 'post_type' => $type, 'goal_category' => $cat->slug, 'numberposts' => $numposts ));
		foreach($thisGoalData as $data) {
			$theGoalsModule .= "\t\t\t\t<fieldset class='".$data->post_name."'>\n";
			$metaFields = get_post_meta($data->ID, 0);
			ksort($metaFields);
			foreach($metaFields as $key => $meta) {
				if(strpos($key, 'calysa') === false) { continue; }
				$theGoalsModule .= "\t\t\t\t\t<input type='hidden' class='".str_replace('calysa_', '', $key)."' value='".$meta[0]."' />\n";
			}
			$theGoalsModule .= "\t\t\t\t</fieldset>\n";
		}
		
		$theGoalsModule .= "\t\t\t</li>\n";
		
		$theGoalsModuleNav .= "<a href='chart-".$cat->slug."' class='".$cat->slug."'>".$cat->slug."</a>";
		$theGoalsModuleOverlay .= "<div class='".$cat->slug."'>".$cat->name."</div>";
		
			/*echo '<pre>';
				print_r($cat);
			echo '</pre>';*/
	}
	
	$theGoalsModule .= "\t\t</ul>\n";
	$theGoalsModule .= "\t\t<div class='module-content-overlay'>\n\t\t\t";
	$theGoalsModule .= $theGoalsModuleOverlay;
	$theGoalsModule .= "\t\t</div>\n";
	
	$theGoalsModule .= "\t</div>\n";
	
	$theGoalsModule .= "\t<div class='module-nav'>\n\t\t";
	$theGoalsModule .= $theGoalsModuleNav;
	$theGoalsModule .= "\t</div>\n";
	
	$theGoalsModule .= "</div>\n";
	
	return $theGoalsModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>