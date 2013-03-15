	<?php get_header(); ?><?php get_sidebar(); ?>		
	<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				
			<div class="details"><?php the_time('F jS, Y') ?> by <?php the_author() ?> in <?php the_category(', '); ?></div>
			<?php the_content('Read the rest of this entry &raquo;'); ?>
			<div class="details"><?php the_tags( '<p class="post-info">Tags: ', ', ', '</p>'); ?></div>
			<div class="details">
				<b><?php comments_popup_link(__('0 Comments'), __('1 Comment'), __('% Comments')); ?></b>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php the_permalink() ?>">Read More >></a>&nbsp;<?php edit_post_link('Edit'); ?>

			</div>
				<br />				
				<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
			<p><?php next_posts_link('&laquo; Older Entries') ?></p>
			<p><?php previous_posts_link('Newer Entries &raquo;<br>') ?></p>
		</div>
		
	<?php get_footer(); ?>