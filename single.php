<?php get_header();
global $post; ?>
<div id="content" class="wrap flex">
  <main class="index-main">
    <h1 class="post-title"><?php the_title(); ?></h1>
    
    <span class="category">
      <?php the_category(', '); ?>
    </span>
    
    <div class="author">
      By <?php the_author_meta( 'display_name', $post->post_author ); ?>
    </div>
    <?php if ( has_post_thumbnail() ) { ?>
    <img src="  <?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="">
    <?php } ?>
    <div class="wysiwyg">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      the_content();
      endwhile; endif; ?>
    </div>
    <?php
    echo get_the_tag_list( '<p>Tags: ', ', ', '</p>' );
    ?>
    <?php comments_template(); ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>