<?php get_header(); ?>
	<div class="content">
		<div class="content-primary">
			<?php if (have_posts() || (is_category('announcements') && count(get_posts(array('post_type' => 'activity', 'activity_category' => 'announcements'))) > 0)) : ?>

				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<div class="heading-wrapper"><h1><?php single_cat_title(); ?></h1></div>

				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<div class="heading-wrapper"><h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1></div>

				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<div class="heading-wrapper"><h1>Archive for <?php the_time('F jS, Y'); ?></h1></div>

				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<div class="heading-wrapper"><h1>Archive for <?php the_time('F, Y'); ?></h1></div>

				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<div class="heading-wrapper"><h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1></div>

				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<div class="heading-wrapper"><h1 class="pagetitle">Author Archive</h1></div>

				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<div class="heading-wrapper"><h1 class="pagetitle">Blog Archives</h1></div>
				
				<?php } ?>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
				
				<?php if (is_category('announcements')) {
					$announcementData = get_posts(array('post_type' => 'post', 'category' => get_category_by_slug('announcements')->term_id, 'numberposts' => -1, 'orderby' => $orderby));
						$activityAnnouncementData = get_posts(array('post_type' => 'activity', 'activity_category' => 'announcements', 'numberposts' => -1, 'orderby' => $orderby));
						$allAnnouncementData = array_merge($announcementData,$activityAnnouncementData);
						function announcementSorter($a,$b) {
							return (strtotime($a->post_date) < strtotime($b->post_date)) ? 1 : -1;
						}
						usort($allAnnouncementData, 'announcementSorter');
						foreach($allAnnouncementData as $post) { ?>
							<article <?php post_class() ?>>
								<div class="post-content">
									<h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
									<div class="entry"><?php echo $post->post_excerpt ?></div>
								</div>
							</article>
						<?php }
				} else { ?>

					<?php while (have_posts()) : the_post(); ?>
					
						<article <?php post_class() ?>>
						
							<?php echo customPostThumbnail(get_the_ID(),'thumbnail'); ?>
							<div class="post-content">
								<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							
								<?php if(get_post_meta(get_the_ID(),'calysa_post_author',true) != '') {
									$thisAuthor = get_post_meta(get_the_ID(),'calysa_post_author',true);
								} else {
									$thisAuthor = get_the_author();
								} ?><div class="post-attribution"><strong >by <?php echo $thisAuthor; ?></strong> - <?php echo get_the_date('F j, Y') ?></div>

								<div class="entry">
									<?php the_excerpt(); ?>
								</div>
							</div>

						</article>

					<?php endwhile; ?>
					
				<?php } ?>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
				
			<?php else : ?>

				<h2>Nothing found</h2>

			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
