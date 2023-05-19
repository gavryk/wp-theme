<?php $bg = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), "large");
$bg = $bg ? $bg : wp_get_attachment_image_src(get_field("default_background","option"), "top"); ?>
<div id="top" class="alc bg-center" style="background-image: url(<?php echo $bg[0]; ?>);">
    <div class="row">
        <?php if ( get_field( "title" ) ) { ?>
            <h1><?php the_field( "title" ); ?></h1>
        <?php } else { ?>
            <h1><?php the_title(); ?></h1>
        <?php } ?>
        <?php the_field( "description" ); ?>
    </div>
</div>