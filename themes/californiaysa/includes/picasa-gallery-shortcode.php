<?php
function picasa_gallery_shortcode($atts) {
	extract( shortcode_atts( array(
		'user' => '104278673862575974562',
		'album' => '',
		'title' => ''
	), $atts ) );
	
	return '<a target="_blank" href="http://picasaweb.google.com/data/feed/api/user/'.$user.'/album/'.$album.'?alt=json-in-script&amp;imgmax=800&amp;thumbsize=64c" class="picasa-source">'.$title.'</a>';
}

function picasa_gallery_full_shortcode($atts) {
	extract( shortcode_atts( array(
		'user' => '117284551889203885860',
		'albums' => '',
		'random' => 'false',
		'maxresults' => '-1'
	), $atts ) );
	
	return '<script class="picasa-gallery-full-source" type="text/javascript">picasaGalleryFullSource = ['.$albums.'];picasaGalleryUser = "'.$user.'";picasaGalleryRandomizer = "'.$random.'";picasaGalleryMaxResults = "'.$maxresults.'";</script><ul class="picasa-gallery-full"><li class="active initial"><img src="'.get_bloginfo('stylesheet_directory').'/img/slider-conference.png" alt="Lift Where You Stand - 2012 California Young Single Adult Conference" /><div class="controls"><label for="">Set number of seconds between images:</label> <select id="picasa-gallery-interval-selector"><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8" selected="selected">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option></select> <a href="#" class="btn"><span>Start Slideshow</span></a></div></li></ul>';
	
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>