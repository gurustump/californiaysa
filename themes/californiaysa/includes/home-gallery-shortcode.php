<?php
function banner_shortcode($atts) {
	extract( shortcode_atts( array(
		'type' => 'module',
		'numposts' => 4,
		'orderby' => 'date',
	), $atts ) );
	
	
	$theBanner = '<div class="content-gallery">';
	$bannerGalleryModules = get_posts(array( 'post_type' => 'module', 'module_category' => 'banners', 'numberposts' => $numposts ));
	if ( isset($bannerGalleryModules[0]) ) { 
		$bannerList = '';
		$thumbList = '';
		$bannerBackground = '';
		$bannerClass = '';
		$bannerModals = '';
		foreach($bannerGalleryModules as $key => $module) {
			if(count(get_post_meta($module->ID,'calysa_module_image',true)) > 0) { 
				$bannerBackground = wp_get_attachment_image_src(get_post_meta($module->ID,'calysa_module_image',true),'full');
			}
			if(count(get_post_meta($module->ID,'calysa_css_classes',true)) > 0) { 
				$bannerClass = get_post_meta($module->ID,'calysa_css_classes',true);
			}
			if(count(get_post_meta($module->ID,'calysa_modal',true)) > 0) { 
				$bannerModals .= get_post_meta($module->ID,'calysa_modal',true);
			}
			$bannerList .= "<li class='".$bannerClass."' style='background:url(".$bannerBackground[0].") no-repeat;'>\n<div class='banner-content'>\n";
			$bannerList .= "<h2>".$module->post_title."</h2>\n";
			$bannerList .= $module->post_content;
			$bannerList .= "</div>\n</li>\n";
			
			if ( has_post_thumbnail($module->ID) ) {
				$thumbList .= '<a class="item-'.$key.'" href="#">';
				$thumbList .= get_the_post_thumbnail($module->ID, array(120,95));
				$thumbList .= '</a>';
			} else {
				$thumbList .= '<a class="item-'.$key.' no-post-thumb" href="#">';
				$thumbList .= '<img src="'.$bannerBackground[0].'" />';
				$thumbList .= '</a>';
			}
		}
		$theBanner .= "<ul class='banner-rotator animRotator'>\n";
		$theBanner .= $bannerList . "\n";
		$theBanner .= "</ul>\n";
		$theBanner .= "<div class='banner-rotator-thumbs manual-rotator-nav'>\n";
		$theBanner .=  $thumbList;
		$theBanner .= "</div>\n</div>\n";
		$theBanner .= "<div class='modals content-gallery-modals'>\n";
		$theBanner .= $bannerModals;
		$theBanner .= "</div>\n";
	} 
	// return the rendered module to be inserted into the content of the post
	return $theBanner;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>