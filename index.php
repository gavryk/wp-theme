<?php get_header();
if ( is_home() ) {
	$queryname = get_the_title( BLOG_ID );
} else {
	$queryname = 'Archive of ' . get_the_archive_title();
} ?>

<div class="blog-posts--section">
	<div class="row1200">
		<div class="blog-posts--wrapper">
			<h3 class="category-title">
				Highlights
			</h3>
			<?php if ( have_posts() ) : ?>
				<div class="posts-list">
					<?php while ( have_posts() ) :
						the_post(); ?>
						<div class="post-item">
							<a href="<?php the_permalink(); ?>" class="post-thumb">
								<img src="<?php echo has_post_thumbnail()
									? esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) )
									: esc_url( get_stylesheet_directory_uri() . '/img/holder.png' ); ?>" alt="<?php the_title_attribute(); ?>">
								<span class="tag-label">Article</span>
							</a>
							<div class="tag-list">
								<?php $tags = get_the_tags(); ?>
								<?php if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) : ?>
									<span class="tag"><?php echo esc_html( $tags[0]->name ); ?></span>
								<?php endif; ?>
								<time><?php echo esc_html( get_the_date( 'j M, Y' ) ); ?></time>
							</div>
							<h5 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>
							<div class="bottom-wrapper flex">
								<span class="tag-label">Article</span>
								<time><?php echo esc_html( get_the_date( 'j M, Y' ) ); ?></time>
								<span class="line"></span>
								<span class="arrow">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
											stroke-linejoin="round" />
										<path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
											stroke-linejoin="round" />
									</svg>
								</span>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<div class="blog-posts--pagination">
					<?php echo numbered_pagination(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>