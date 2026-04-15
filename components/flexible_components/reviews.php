<?php if ($reviews = get_field('reviews', 'options')) { ?>
    <div class="slider-2 reviews">
        <div class="wrap">
            <div class="flex">
                <div class="title-section">
                    <?php if (get_sub_field('review_sub_title', 'options')) { ?>
                        <h5><?php echo get_sub_field('review_sub_title', 'options'); ?></h5>
                    <?php } ?>
                    <?php if (get_sub_field('review_title', 'options')) { ?>
                        <h2><?php echo get_sub_field('review_title', 'options'); ?></h2>
                    <?php } ?>
                </div>
                <div class="btn-group">
                    <div class="swiper-button button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
                            <path d="M8.62134 1.06055L2.12134 7.56055L8.62134 14.0605" stroke="white" stroke-width="3"/>
                        </svg>
                    </div>
                    <div class="swiper-button button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
                            <path d="M1.37866 1.06055L7.87866 7.56055L1.37866 14.0605" stroke="white" stroke-width="3"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="swiper"> 
                <div class="swiper-wrapper">
                    <?php foreach ($reviews as $review) { ?>
                        <div class="swiper-slide">
                            <?php if ( $image = $review['image'] ) : ?>
                                <?php $size = "medium"; ?>
                                <figure class='image'>
                                    <img src="<?php echo $image['sizes'][ $size ] ?>"
                                    width="<?php echo $image['sizes'][ $size . '-width' ]; ?>"
                                    height="<?php echo $image['sizes'][ $size . '-height' ]; ?>"
                                    alt="<?php echo $image['alt'] ? $image['alt'] : $image['title'] ?>">
                                </figure>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>