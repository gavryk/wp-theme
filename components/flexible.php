<div class="flexible">
	<?php
	if ( have_rows( 'flexible' ) ) :
		$layouts = array(
			'left_right_content' => 'left-right-content.php',
			'form_before_footer' => 'form-before-footer.php',
			'full_screen_block' => 'full-screen-block.php',
			'two_row' => 'two-row.php',
			'text_columns' => 'text-columns.php',
			'wysiwyg_content' => 'wysiwyg-content.php',
			'faq' => 'faq.php',
			'slider_1' => 'slider-1.php',
			'icons_section' => 'icons-section.php',
			'reviews' => 'reviews.php',
		);

		while ( have_rows( 'flexible' ) ) :
			the_row();
			$layout = get_row_layout();
			if ( $layout == 'other_group' ) {
			} elseif ( isset( $layouts[ $layout ] ) ) {
				include locate_template( 'components/flexible_components/' . $layouts[ $layout ] );
			}
		endwhile;
	endif;
	?>
</div>