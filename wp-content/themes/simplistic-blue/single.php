	<?php get_header(); ?><?php get_sidebar(); ?>	
		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div><br />
				<h1><?php the_title(); ?></h1>
				<div class="details"><?php the_time('F jS, Y') ?> by <?php the_author() ?> in <?php the_category(', '); ?></div>
					<p><?php the_content('Read the rest of this entry &raquo;'); ?></p>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p class="post-info">Tags: ', ', ', '</p>'); ?>					
							
								<?php comments_template(); ?>
								
			<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
			
			</div><!--/#post-area-->
		
		</div><!--/div#main-content-->
		
	<?php get_footer(); ?>