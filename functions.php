<?php
define( 'HOME_PAGE_ID', get_option( 'page_on_front' ) );
define( 'BLOG_ID', get_option( 'page_for_posts' ) );
define( 'POSTS_PER_PAGE', get_option( 'posts_per_page' ) );
/* INCLUD CUSTOM FUNCTIONS
   ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
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
	'main_menu'   => 'Main navigation',
	'second_menu' => 'Second navigation',
	'foot_menu'   => 'Footer navigation'
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

add_filter('wp_check_filetype_and_ext', 'ignore_upload_ext', 10, 4);
function ignore_upload_ext($checked, $file, $filename, $mimes)
{
    //we only need to worry if WP failed the first pass
    if (!$checked['type']) {
        //rebuild the type info
        $wp_filetype = wp_check_filetype($filename, $mimes);
        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;
        //preserve failure for non-svg images
        if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
            $ext = $type = false;
        }
        //everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.
        $checked = compact('ext', 'type', 'proper_filename');
    }
    return $checked;
}

/**
 * Add file support for media
 *
 */
function svg_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'svg_myme_types', 1, 1);

// [button link='URL' text='TEXT' target='_blank' class='CLASS']
// or [button link='URL' target='_blank' class='CLASS']TEXT[/button]
// or fancybox [button data-src='URL' text='TEXT' class='CLASS']
function content_btn( $attr, $content ) {
    $attr = shortcode_atts( array(
        'text'     => 'Read More',
        'link'     => site_url(),
        'data-src' => '',
        'class'    => false,
        'target'   => '_self'
    ), $attr );

    $btn_content = $content ? $content : $attr['text'];
    $btn_class   = $attr['class'] ? ' ' . $attr['class'] : '';
    $btn_target  = $attr['target'] ? 'target="' . $attr['target'] . '"' : '';
    $btn_rel     = $attr['target'] == '_blank' ? 'rel="noopener"' : '';

    if ( ! ! $attr['data-src'] ) {
        $result = '<a data-fancybox data-src="' . $attr['data-src'] . '" href="javascript:;" class="btn' . $btn_class . '">' . $btn_content . '</a>';
    } else {
        $result = '<a href="' . $attr['link'] . '" ' . $btn_rel . ' class="btn' . $btn_class . '" ' . $btn_target . '>' . $btn_content . '</a>';
    }

    return $result;
}

add_shortcode( "button", "content_btn" );

function imgSvg($imageUrl) {
    $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
    
    $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
    if (strtolower($extension) === 'svg') {
        
        $svgCode = file_get_contents($imageUrl, false, stream_context_create($arrContextOptions));
        return $svgCode;
    } else {
        $imgTag = '<img src="' . $imageUrl . '" alt="Image">';
        return $imgTag;
    }
}