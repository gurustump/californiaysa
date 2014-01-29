<?php
function module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'blank',
		'type' => 'post',
		'numposts' => 1,
		'headtext' => '',
		'moretext' => 'More &raquo;',
		'morelink' => '',
		'subcat' => '',
		'orderby' => 'ID',
		'anim' => '',
	), $atts ) );
	
	// set up today's date
	$today_date = date('Y-m-d');
	// get the data
	if($type == 'category') {
		$catName = ($subcat !== '') ? $subcat : $name;
		if($name == 'announcements') {
			$announcementData = get_posts(array('post_type' => 'post', 'category' => get_category_by_slug($catName)->term_id, 'numberposts' => -1, 'orderby' => $orderby));
			$activityAnnouncementData = get_posts(array('post_type' => 'activity', 'activity_category' => 'announcements', 'numberposts' => -1, 'orderby' => $orderby));
			$allAnnouncementData = array_merge($announcementData,$activityAnnouncementData);
			function announcementSorter($a,$b) {
				return (strtotime($a->post_date) < strtotime($b->post_date)) ? 1 : -1;
			}
			usort($allAnnouncementData, 'announcementSorter');
			$thisModuleData = $allAnnouncementData;
		} else {
			$thisModuleData = get_posts(array('category' => get_category_by_slug($catName)->term_id, 'numberposts' => $numposts, 'orderby' => $orderby));
		}
	} elseif($type == 'module_category') {
		$thisModuleData = get_posts(array('post_type' => 'module', 'module_category' => $name, 'numberposts' => $numposts, 'orderby' => $orderby));
	} elseif($type == 'activity') {
		$allActivityData = get_posts(array('post_type' => 'activity', 'numberposts' => -1, meta_key => 'calysa_date','orderby' => 'meta_value', 'order' => 'ASC'));
		
		foreach($allActivityData as $key => $thisActivity) {
			if(strtotime(get_post_meta($thisActivity->ID,'calysa_date',true)) < strtotime($today_date)) {
				unset($allActivityData[$key]);
			}
		}
		$thisModuleData = array_slice($allActivityData,0,$numposts,true);
	} else {
		$thisModuleData = get_posts(array( 'post_type' => $type, 'name' => $name, 'numberposts' => $numposts));
	}
	if (count($thisModuleData) < 1) {return;}
	
	// set up post thumbnail, if it exists
	if (has_post_thumbnail($thisModuleData[0]->ID)) {
		$thisThumbnail = get_the_post_thumbnail($thisModuleData[0]->ID,'full');
	}
	
	
	// render the module
	$theModule = '<div class="module module-'.$name.'"><h2>';
	
	// customize title depending on whether the type is category or something else
	if($type == 'category') {
		if ($headtext == '') {
			$theHeadingText = (get_category_by_slug($name)->description != '') ? get_category_by_slug($name)->description : get_category_by_slug($name)->cat_name;
		} else {
			$theHeadingText = $headtext;
		}
		$theModule .= '<a href="'.get_category_link(get_category_by_slug($name)->term_id).'">' . $theHeadingText .'</a>';
	} elseif ($type == 'module_category') {
		$theModule .= '<a href="'.get_term_link($name,$type).'">$name</a>';
	} elseif ($type == 'activity') {
		$landingPage = get_page_by_title($name);
		$theModule .= '<a href="'.get_permalink($landingPage->ID).'">Activities</a>';
	} else {
		if ($headtext == '') {
			$theHeadingText = $thisModuleData[0]->post_title; 
		} else {
			$theHeadingText = $headtext;
		}
		$theModule .= '<a href="'.get_permalink($thisModuleData[0]->ID).'">' . $theHeadingText .'<span class="fold"></span></a>';
	}
	$theModule .= '</h2><div class="module-content">';
	
	
	// render the module content
	if ($type == 'page') {
		$pageExcerpt = get_post_custom_values('pictageu_excerpt',$thisModuleData[0]->ID);
		$theModule .= customPostThumbnail($thisModuleData[0]->ID,'full');
		//$theModule .= $pageExcerpt[0];
	// } elseif ($numposts > 0) {
	} else {
		$theModule .= '<ul class="post-list '.$anim.'">';
		foreach($thisModuleData as $thisData) {
			if($type == 'activity') { 
				$theModule .= '<li class="'.get_post_meta($thisData->ID,'calysa_activity_type',true).'"><a class="activity-icon" href="' .get_permalink($thisData->ID). '"></a>';
			} else {
			$theModule .= '<li>';
			}
			$theModule .= customPostThumbnail($thisData->ID,'thumbnail');
			$theModule .= '<div class="post-content"><h3><a href="' .get_permalink($thisData->ID). '">';
			if (get_post_meta($thisData->ID,'calysa_secondary_title',true) && $name == 'announcements') {
				$theModule .= get_post_meta($thisData->ID,'calysa_secondary_title',true);
			} else {
				$theModule .= $thisData->post_title;
			}
			$theModule .= '</a></h3>';
			if($type == 'activity') { 
				$theModule .= '<div class="activity-date-time">'.date_format(date_create(get_post_meta($thisData->ID,'calysa_date',true)),'M j, Y').' - '.get_post_meta($thisData->ID,'calysa_time',true).'</div>';
			}
			if(get_post_meta($thisData->ID,'calysa_post_author',true) != '') {
				$thisAuthor = get_post_meta($thisData->ID,'calysa_post_author',true);
			} else {
				$thisAuthor = get_the_author_meta('display_name',$thisData->post_author);
			}
			$theModule .= '<div class="post-attribution"><strong >by '.$thisAuthor.'</strong> - '.get_the_time('F j, Y',$thisData->ID).'</div>';
			$theModule .= '<div class="post-excerpt">'.$thisData->post_excerpt.'</div>';
			// category more link
			if($type == 'category'){
				$theModule .= '<div class="actions"><a class="more" href="' .get_permalink($thisData->ID). '">'.$moretext.'</a></div>';
			}
			$theModule .= '</div></li>';
			/*echo '<pre>';
			print_r($thisData);
			echo '</pre>';*/
		}
		$theModule .= '</ul>';
		if ($anim == 'animSlider'){
			$theModule .= '<div class="manual-rotator-nav"></div>';
		}
	} /*else {
		foreach($thisModuleData as $thisData) {
			$theModule .= $thisData->post_excerpt;
		}
	}*/
	
	// render the "view all" link for activities
	if($type == 'activity' || $name == 'announcements'){
		$theModule .= '<div class="actions">';
		$theModule .= '<a class="more" href="';
		if ($morelink != '') {
			if (strpos($morelink,'http') === 0) {
				$theModule .= $morelink;
			} else {
				$theModule .= get_bloginfo('url') . '/' . $morelink;
			}
		} elseif ($type == 'activity' ) {
			$theModule .= get_permalink($landingPage->ID);
		} else {
			$theModule .= get_category_link(get_category_by_slug($name)->term_id);
		}
		$theModule .='"><span>'.$moretext.'</span></a></div>';
	}
	$theModule .= '</div></div><!--last-->';
	
	// return the rendered module to be inserted into the content of the post
	return $theModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>