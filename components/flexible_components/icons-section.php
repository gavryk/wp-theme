<?php if ( $icons = get_sub_field( 'icons' ) ) { ?>
	<div class="flx-icons--section">
		<div class="wrap">
			<div class="flx-icons--wrapper flex">
				<?php foreach ( $icons as $item ) {
					$icon = $item['icon'];
					$text = $item['text'];
					?>
					<div class="icon-col">
						<?php if ( $icon ) { ?>
							<div class="icon">
								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
							</div>
						<?php } ?>
						<?php if ( $text ) { ?>
							<div class="text">
								<span><?php echo $text; ?></span>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>