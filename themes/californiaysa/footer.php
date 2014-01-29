
	<?php if(!is_page_template('full_page_picasa_gallery.php')){ ?>
	<div class="main-actions">
		<?php if(is_front_page()) { ?>
			<a href="https://www.regonline.com/2012cysa" class="btn register tblank"><span>Register Now!</span></a>
		<?php } ?>
		<div class="main-menu">
			<a class="menu-activator" href="#">Menu</a>
			<?php wp_nav_menu( array('theme_location' => 'main-menu' )); ?>
		</div>
	</div>
	
	</div><!-- </ page-wrap > -->
    <div class="push"></div>
	</div><!-- </ wrap > -->

	
	<footer id="footer">
		<div class="footer-inner-wrapper">
			<div class="source-org vcard copyright">
				<small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
<div class="main-menu-overlay"></div>
	<?php } else { ?>
	</div></div><!-- </ page-wrap and wrap > -->
	<?php } ?>
<!-- here comes the javascript -->

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<?php // if(is_front_page() || is_page('Goals')) { ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/highcharts.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/goalcharts.js"></script>
<?php // } ?>

<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/utils.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/functions.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
	 This is currenly using the GA account found in the old CaliforniaYSA Joomla site
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8914334-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->

</body>

</html>
