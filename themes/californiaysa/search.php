<?php get_header(); ?>

	<div class="content">
		<div class="content-primary">
			<?php if (have_posts()) : ?>
			
				<div class="heading-wrapper"><h1>Search Results</h1></div>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

				<?php while (have_posts()) : the_post(); ?>

					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

							<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
						
							<?php if(get_post_meta(get_the_ID(),'calysa_post_author',true) != '') {
								$thisAuthor = get_post_meta(get_the_ID(),'calysa_post_author',true);
							} else {
								$thisAuthor = get_the_author();
							} ?><div class="post-attribution"><strong >by <?php echo $thisAuthor; ?></strong> - <?php echo get_the_date('F j, Y') ?></div>

							<div class="entry">
								<?php the_excerpt(); ?>
							</div>

					</article>

				<?php endwhile; ?>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

			<?php else : ?>

				<h2>No posts found.</h2>

			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
