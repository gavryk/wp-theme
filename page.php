<?php get_header(); ?>
<div class="default-page-content page_id_<?php the_ID() ?> m-space-md">
	<div class="row">
		<main>
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
			<div class="wys">
				<?php if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
				endif;
				?>
			</div>
		</main>
	</div>
</div>
<?php get_footer(); ?>