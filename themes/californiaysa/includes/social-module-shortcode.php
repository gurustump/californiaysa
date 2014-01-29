<?php
function social_module_shortcode($atts) {
	extract( shortcode_atts( array(
		'name' => 'Social',
	), $atts ) );
	
	$theSocialModule = "<div class='module module-social'>\n";
	$theSocialModule .= "\t<h2><span class='dead'>".$name."</span></h2>\n";
	$theSocialModule .= "\t<div class='module-content'>\n";
	$theSocialModule .= "\t<ul class='social-icons'>\n";
	$theSocialModule .= "\t\t<li class='facebook'><a class='tblank' href='http://www.facebook.com/californiaYSA'>Facebook</a></li>\n";
	$theSocialModule .= "\t\t<li class='youtube'><a class='tblank' href='http://www.youtube.com/californiaysa'>Youtube</a></li>\n";
	$theSocialModule .= "\t\t<li class='twitter'><a class='tblank' href='http://twitter.com/californiaysa'>Twitter</a></li>\n";
	$theSocialModule .= "\t\t<li class='rss'><a class='tblank' href='".get_bloginfo('rss2_url')."'>RSS</a></li>\n";
	$theSocialModule .= "\t</ul>\n";
	$theSocialModule .= "\t<a class='a2a_dd' href='http://www.addtoany.com/share_save'><img src='http://static.addtoany.com/buttons/share_save_171_16.png' width='171' height='16' border='0' alt='Share'/></a>\n";
	$theSocialModule .= "\t<script type='text/javascript'>\n\t\tvar a2a_config = a2a_config || {};\n\t\ta2a_config.color_main = '0081c6';\n\t\ta2a_config.color_border = '005695';\n\t\ta2a_config.color_link_text = '333333';\n\t\ta2a_config.color_link_text_hover = 'ffffff';\n\t\ta2a_config.color_arrow_hover = 'fff';\n\t</script>\n";
	$theSocialModule .= "\t<script type='text/javascript' src='http://static.addtoany.com/menu/page.js'></script>\n";
	$theSocialModule .= "</div>\n</div>\n";
	return $theSocialModule;
}
	
/*
echo '<pre>';
print_r($thisModuleData);
echo '</pre>';
*/
?>