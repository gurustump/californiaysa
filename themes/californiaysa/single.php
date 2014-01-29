<?php get_header(); ?>
	<div class="content">
		<div class="content-primary">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
					<div class="heading-wrapper">
						<?php if(get_post_type() == 'activity') { ?>
						<span class="activity-icon <?php echo get_post_meta($post->ID,'calysa_activity_type',true); ?>"></span>
						<?php } ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</div>

					<div class="entry-content">
						
						<?php if(get_post_type() == 'activity') { 
							if ( has_post_thumbnail(get_the_ID()) ) {
								echo '<p>';
								the_post_thumbnail(get_the_ID(), 'full');
								echo '</p>';
							}
						 } ?>
						
						<?php	if( get_post_type() != 'activity') { // no attribution for activities ?> 
							<?php if(get_post_meta(get_the_ID(),'calysa_post_author',true) != '') {
								$thisAuthor = get_post_meta(get_the_ID(),'calysa_post_author',true);
							} else {
								$thisAuthor = get_the_author();
							} ?><div class="post-attribution"><strong >by <?php echo $thisAuthor; ?></strong> - <?php echo get_the_date('F j, Y') ?></div>
						<?php } else { ?>
							<div class="activity-date-time"><?php echo date_format(date_create(get_post_meta(get_the_ID(),'calysa_date',true)),'F j, Y'); ?> - <?php echo get_post_meta(get_the_ID(),'calysa_time',true); ?></div>
						<?php } ?>
						
						<?php the_content(); ?>

						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
						
						<?php // the_tags( 'Tags: ', ', ', ''); ?>
					
						<?php // include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

					</div>
					
					<?php edit_post_link('Edit this entry','','.'); ?>
					
				</article>

			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
		</div>
	
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>