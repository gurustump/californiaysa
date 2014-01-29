<div id="sidebar">

<?php 
global $post;
if (is_front_page()){ ?>
	<div class="reviews-container">
		<h2><?php echo get_category_by_slug('reviews')->name; ?></h2>
		<ul class="reviews">
			<?php
				$reviews_array = get_posts( array(
					'numberposts' => 3,
					'category' => get_category_by_slug('reviews')->term_id
				));
				foreach($reviews_array as $post) : setup_postdata($post); ?>
					<li>
						<div class="post-thumb">
							<?php the_post_thumbnail(62,62); ?>
						</div>
						<div class="review-content">
							<div class="rating" style="width:<?php echo 71 - ((5 - round(get_post_meta($post->ID,'Review Rating',true)))*14.2);?>px;">
								
								<span style="width:<?php echo 65 - ((5 - get_post_meta($post->ID,'Review Rating',true))*13);?>px;"><?php echo get_post_meta($post->ID,'Review Rating',true); ?></span>
							</div>
							<p class="author"><?php echo get_post_meta($post->ID,'Review Author',true); ?> - <span><?php echo get_post_meta($post->ID,'Review Author Location',true); ?></span></p>
							<strong><?php the_title(); ?></strong> <?php remove_filter('the_content', 'wpautop'); the_content(); ?>
						</div>
					</li>
				<?php endforeach;
			?>
		</ul>
	</div>
<?php } ?>
<div class="widget sidebar-module sidebar-module-register">
	<h2>Want to Attend?</h2>
	<p>The 2012 California YSA Conference registration is now open. Sign up today!</p>
	<a class="tblank btn" href="https://www.regonline.com/2012cysa"><span>Register Now</span></a>
</div>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>

	<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
<?php /*
	<?php get_search_form(); ?>

	<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>

	<h2>Archives</h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>
	
	<h2>Categories</h2>
	<ul>
	   <?php wp_list_categories('show_count=1&title_li='); ?>
	</ul>
	
	<?php wp_list_bookmarks(); ?>

	<h2>Meta</h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
		<?php wp_meta(); ?>
	</ul>
	
	<h2>Subscribe</h2>
	<ul>
		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
	</ul>

*/ ?>
<?php endif; ?>

</div>