<?php get_header();
global $post; ?>
<section id="content">
	<div class="container row">
		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
	</div>
</section>
<?php get_footer(); ?>