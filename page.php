<?php

/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage immistudy
 */


get_header(); ?>

	<div class="grid">
		<div class="unit">	
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				
				<?php get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; else: ?>
				<p><?php _e('No posts were found. Sorry!'); ?></p>
			<?php endif; ?>
		</div>
	</div>

	

<!--<?php get_sidebar(); ?>-->
<?php get_footer(); ?>