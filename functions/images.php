<?php
// This sets the 3 different DEFAULT WordPress sizes to the 3 sizes that best fit in the posts and pages

// Add filters here
// update_option('thumbnail_size_w', 75);
// update_option('thumbnail_size_h', 75);
// update_option('thumbnail_crop', 1);

// update_option('medium_size_w', 214);
// update_option('medium_size_h', 9999);
// update_option('medium_crop', 0);

// update_option('large_size_w', 900);
// update_option('large_size_h', 9999);
// update_option('large_crop', 0);

// These are the additional image sizes that will be cut when adding an image to WP
// add_image_size('w50', 50, 50, true );         // 50 pixels wide x 50 pixels tall
add_image_size('w75', 75, 75, true );        // 75 pixels wide x 75 pixels tall
add_image_size('w163', 163, 9999, false );    //163 pixels wide (and unlimited height)
// add_image_size('w214', 214, 9999, false );    //214 pixels wide (and unlimited height)
add_image_size('w376', 376, 9999, false);     //376 pixels wide (and unlimited height)
add_image_size('w610', 610, 9999, false);     //600 pixels wide (and unlimited height)
add_image_size('w770', 770, 9999, false);     //600 pixels wide (and unlimited height)
add_image_size('w1024', 1024, 9999, false);     //600 pixels wide (and unlimited height)

// These are the sizes that show up in the Admin
$fortune_imgsizes = array(
  "w75S" => __("Thumb (75)"),
  "w163" => __("Wide Thumb (w163)"),
  // "w214" => __("Small (w214)"),
  "w376" => __("Medium (w376)"),
  "w600" => __("Large Fit (w610)"),
  "w770" => __("Large Wide (w770)"),
  "w1024" => __("Jumbo (w1024)")
);

function custom_image_sizes($sizes) {
  global $fortune_imgsizes;
  $newimgsizes = array_merge($sizes, $fortune_imgsizes);
  return $newimgsizes;
}
add_filter('image_size_names_choose', 'custom_image_sizes');

// add_image_size( 'homepage-thumb', 280, 180, true ); //(cropped)







// // Automatically set the featured image when there is an image in the post
function wpforce_featured() {
	global $post;
	$already_has_thumb = has_post_thumbnail($post->ID);
	if (!$already_has_thumb)  {
		$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
		if ($attached_image) {
			foreach ($attached_image as $attachment_id => $attachment) {
				set_post_thumbnail($post->ID, $attachment_id);
			}
		}
	}
}  //end function
add_action('the_post', 'wpforce_featured');
add_action('save_post', 'wpforce_featured');
add_action('draft_to_publish', 'wpforce_featured');
add_action('new_to_publish', 'wpforce_featured');
add_action('pending_to_publish', 'wpforce_featured');
add_action('future_to_publish', 'wpforce_featured');





function fortune_get_featured_image($size){
	global $post;
	if ( has_post_thumbnail() ) {
		$thumb = get_the_post_thumbnail( $post->ID, $size);
		$thumb = preg_replace( '/(width|height)="\d*"\s/', "", $thumb ); // Removes height & width
		$thumb = str_replace( 'class="', 'class="img-responsive ', $thumb );
		if (is_single()) {
			echo '<div class="photo '.$size.'">' . $thumb . '</div>';
		} else {
			echo '<div class="photo '.$size.'"><a href="' . get_permalink() . '">' . $thumb . '</a></div>';
		}
		
	}
}









// // Controls the Image HTML by modifying the WordPress Image shortcode.
// // http://codex.wordpress.org/Function_Reference/add_filter
function new_img_shortcode_filter($val, $attr, $content = null) {

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => '',
		'src' => ''
	), $attr));
  
  $find = 'attachment_';
  $cust_id = str_replace($find, '', $id);
  $post_custom = get_post_custom($cust_id);
  // $isrc = $src;
  
  // if ( 1 > (int) $width || empty($caption) ) {
  //   return $val;
  // }

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '"';
	}

  
  $raw = do_shortcode( $content );
  $img = preg_replace( '/(width|height)="\d*"\s/', "", $raw); // Removes Height and Width from images
  $img = str_replace('class="', 'class="img-responsive ', $img); // adds in the .img-responsive class to all images
  if ($width == 75 || $width == 163 ) { // if image doesn't need a caption
    return '<div class="photo w'.(0 + (int) $width).'">' . $img . '</div>';
  } else { // all other images
    return '<div class="photo w'.(0 + (int) $width).'">' . $img . '<p class="caption">' . $caption . '</p></div>';
  }
}
add_filter('img_caption_shortcode', 'new_img_shortcode_filter',10,3);







/******    REWRITE THE GALLERY FUNCTION FROM WORDPRESS   **********/

add_shortcode('gallery', 'fortune_gallery_shortcode');

function fortune_gallery_shortcode($attr) {
  $counter=0;

    $post = get_post();

static $instance = 0;
$instance++;

if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
}


// Allow plugins/themes to override the default gallery template.
$output = apply_filters('post_gallery', '', $attr);
if ( $output != '' )
    return $output;

// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
}

extract(shortcode_atts(array(

/******    CHANGE TO FULL SIZE TO GET THE CORRECT INFORMATION **********/
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'dl',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
    'columns'    => 3,
    'size'       => 'Full size',
    'include'    => '',
    'exclude'    => ''
), $attr));

/***********************************************************************/

$id = intval($id);
if ( 'RAND' == $order )
    $orderby = 'none';

if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
    }
} elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
} else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
}

if ( empty($attachments) )
    return '';

if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
}

$itemtag = tag_escape($itemtag);
$captiontag = tag_escape($captiontag);
$icontag = tag_escape($icontag);
$valid_tags = wp_kses_allowed_html( 'post' );
if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'dl';
if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

$columns = intval($columns);
$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
$float = is_rtl() ? 'right' : 'left';

$selector = "gallery-{$instance}";
$gallery_div ="<div class='pictures-content'>";
$gallery_style ="";

$output = apply_filters( 'gallery_style', "\n\t\t" . $gallery_div );

$i = 0;
$count=0;
$c=0;

$output .= <<<EOF

EOF;
$output .= "<div id='carousel-post-".$post->ID."' class='carousel slide' data-ride='carousel'>\n";
$output .= "<ol class='carousel-indicators'>\n";

foreach ( $attachments as $id => $attachment ) {
  if ($c == 0) {
    $output .= "<li data-target='#carousel-post-".$post->ID."' data-slide-to='".$c."' class='active'></li>\n";
  } else {
    $output .= "<li data-target='#carousel-post-".$post->ID."' data-slide-to='".$c."'></li>\n";
  }
  $c++;
}
$output .= "</ol>\n";

$output .= "<div class='carousel-inner'>\n";
foreach ( $attachments as $id => $attachment ) {
  $test = $attachments[$id];
  $link = $test->guid;
  if ($count == 0) {
    $output .= "<div class='item active'><img src='$link'/></div>";
  } else {
    $output .= "<div class='item'><img src='$link'/></div>";
  }
  $count++;
}
$output .= "</div>\n";
$output .= <<<EOF
  <a class="left carousel-control" href="#carousel-post-$post->ID" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-post-$post->ID" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
EOF;
$output .= "</div>\n";
$output .= "</div>\n";
// $output .= "</div>\n";
return $output;
}















?>