<?php
define( 'HOME_PAGE_ID', get_option( 'page_on_front' ) );
define( 'BLOG_ID', get_option( 'page_for_posts' ) );
define( 'POSTS_PER_PAGE', get_option( 'posts_per_page' ) );
/* INCLUD CUSTOM FUNCTIONS
	 ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
require_once( 'include/wpadmin/admin-addons.php' );
// Custom functionality
require_once 'include/core.php';
require_once 'include/acf/acf-settings.php';
//require_once 'include/woocommerce.php';
// require_once('include/cpt.php');

//update image  size
// add_image_size( '2048x2048_cropped', '2048', '2048', true );
add_image_size( 'free', '1920', '', true );

function set_default_image_sizes() {
	update_option( 'thumbnail_size_w', 400 );
	update_option( 'thumbnail_size_h', 400 );
	update_option( 'medium_size_w', 800 );
	update_option( 'medium_size_h', 800 );
	update_option( 'large_size_w', 2048 );
	update_option( 'large_size_h', 2048 );
}

add_action( 'after_switch_theme', 'set_default_image_sizes' );


/* REGISTER MENUS
	 ========================================================================== */
register_nav_menus( array(
	'main_menu' => 'Main navigation',
	'second_menu' => 'Second navigation',
	'foot_menu' => 'Footer navigation'
) );

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

add_filter( 'wp_check_filetype_and_ext', 'ignore_upload_ext', 10, 4 );

function ignore_upload_ext( $checked, $file, $filename, $mimes ) {
	//we only need to worry if WP failed the first pass
	if ( ! $checked['type'] ) {
		//rebuild the type info
		$wp_filetype = wp_check_filetype( $filename, $mimes );
		$ext = $wp_filetype['ext'];
		$type = $wp_filetype['type'];
		$proper_filename = $filename;
		//preserve failure for non-svg images
		if ( $type && 0 === strpos( $type, 'image/' ) && $ext !== 'svg' ) {
			$ext = $type = false;
		}
		//everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.
		$checked = compact( 'ext', 'type', 'proper_filename' );
	}
	return $checked;
}

/**
 * Add file support for media
 *
 */
function svg_myme_types( $mime_types ) {
	$mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
	return $mime_types;
}
add_filter( 'upload_mimes', 'svg_myme_types', 1, 1 );

function numbered_pagination() {
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?sf_paged=%#%',
		'current' => max(
			1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => __( '<svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64644L3.82843 0.464464C4.02369 0.269202 4.34027 0.269202 4.53553 0.464464C4.7308 0.659726 4.7308 0.976309 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.73079 4.02369 7.73079 3.82843 7.53553L0.646446 4.35355ZM26 4.5L1 4.5L1 3.5L26 3.5L26 4.5Z" fill="#1D1D1D"/></svg>', 'textdomain' ),
		'next_text' => __( '<svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25.3536 4.35355C25.5488 4.15829 25.5488 3.84171 25.3536 3.64644L22.1716 0.464464C21.9763 0.269202 21.6597 0.269202 21.4645 0.464464C21.2692 0.659726 21.2692 0.976309 21.4645 1.17157L24.2929 4L21.4645 6.82843C21.2692 7.02369 21.2692 7.34027 21.4645 7.53553C21.6597 7.73079 21.9763 7.73079 22.1716 7.53553L25.3536 4.35355ZM4.37114e-08 4.5L25 4.5L25 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#1D1D1D"/></svg>', 'textdomain' ),
	) );
}

// [button link='URL' text='TEXT' target='_blank' class='CLASS']
// or [button link='URL' target='_blank' class='CLASS']TEXT[/button]
// or fancybox [button data-src='URL' text='TEXT' class='CLASS']
function content_btn( $attr, $content ) {
	$attr = shortcode_atts( array(
		'text' => 'Read More',
		'link' => site_url(),
		'data-src' => '',
		'class' => false,
		'target' => '_self',
		'icon' => '',
	), $attr );

	$btn_content = $content ? $content : $attr['text'];
	$btn_class = $attr['class'] ? ' ' . $attr['class'] : '';
	$btn_target = $attr['target'] ? 'target="' . $attr['target'] . '"' : '';
	$btn_rel = $attr['target'] == '_blank' ? 'rel="noopener"' : '';
	$icon_html = $attr['icon'] ? html_entity_decode( $attr['icon'] ) : '';

	if ( ! empty( $attr['data-src'] ) ) {
		$result = '<a data-fancybox data-src="' . esc_url( $attr['data-src'] ) . '" href="javascript:;" class="btn' . esc_attr( $btn_class ) . '">' . $icon_html . '<span>' . $btn_content . '</span></a>';
	} else {
		$result = '<a href="' . esc_url( $attr['link'] ) . '" ' . $btn_rel . ' class="btn' . esc_attr( $btn_class ) . '" ' . $btn_target . '>' . $icon_html . '<span>' . $btn_content . '</span></a>';
	}

	return $result;

}

add_shortcode( "button", "content_btn" );

add_shortcode( "button", "content_btn" );

function imgSvg( $imageUrl ) {
	$extension = pathinfo( $imageUrl, PATHINFO_EXTENSION );

	$arrContextOptions = array(
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);
	if ( strtolower( $extension ) === 'svg' ) {

		$svgCode = file_get_contents( $imageUrl, false, stream_context_create( $arrContextOptions ) );
		return $svgCode;
	} else {
		$imgTag = '<img src="' . $imageUrl . '" alt="Image">';
		return $imgTag;
	}
}

function get_img_srcset( $image_id, $image_size, $max_width ) {

	// check the image ID is not blank
	if ( $image_id != '' ) {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// generate the markup for the responsive image
		echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';

	}
}