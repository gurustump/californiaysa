<?php get_header(); ?>
	<div class="content">
		<div class="content-primary">
			<div class="heading-wrapper"><h1><?php _e('Error 404 - Page Not Found','html5reset'); ?></h1></div>
			<p>We appear to have misplaced the page you are looking for. Perhaps if we back-track to the <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?> home page</a>, we'll be able to figure out where the pesky thing has gotten to.
		</div>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>