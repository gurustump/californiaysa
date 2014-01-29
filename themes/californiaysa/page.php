<?php get_header(); ?>
	<?php if (is_front_page()) {
		include 'includes/home-page.php';
	} else { ?>
	<div class="content">
		<div class="content-primary">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<article class="post" id="post-<?php the_ID(); ?>">
				
				<?php if (!(is_front_page())) { ?>
				<div class="heading-wrapper"><h1><?php the_title(); ?></h1></div>
				<?php } ?>

				<?php /*include (TEMPLATEPATH . '/_/inc/meta.php' );*/ ?>

				<div class="entry">

					<?php the_content(); ?>

					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

				</div>

				<?php /* edit_post_link('Edit this entry.', '<p>', '</p>');*/ ?>
				
				<?php if (is_page('activities')) {
					$activitiesPosts = get_posts(array('post_type' => 'activity', 'numberposts' => -1, meta_key => 'calysa_date','orderby' => 'meta_value', 'order' => 'ASC')); ?>
					<ul class="post-list">
					<?php foreach($activitiesPosts as $post) { ?>
							<li class="<?php echo get_post_meta($post->ID,'calysa_activity_type',true); ?>">
								<span class="activity-icon"></span>
								<div class="post-content">
									<h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
									<div class="activity-date-time"><?php echo date_format(date_create(get_post_meta($post->ID,'calysa_date',true)),'j M, Y').' - '.get_post_meta($post->ID,'calysa_time',true); ?></div>
									<div class="post-content"><?php echo $post->post_excerpt ?></div>
								</div>
							</li>
					<?php } ?>
					</ul>
				<?php } ?>

			</article>
			
			<?php /*comments_template(); */?>

			<?php endwhile; endif; ?>
			
			
			<?php if(get_post_meta($post->ID,'Gallery',true)) { ?>
				<div class="gallery">
					<?php echo get_post_meta($post->ID,'Gallery',true); ?>
				</div>
			<?php } else {
				$gallery = get_posts( array('post_type'=>'module','name'=>'gallery') );
				if ( isset( $gallery[0] ) ) { ?>
					<div class="gallery">
						<?php echo $gallery[0]->post_content; ?>
					</div>
				<?php } 
				} ?>
		</div>		
		<?php get_sidebar(); ?>
	</div>
	<?php } ?>
<?php get_footer(); ?>
