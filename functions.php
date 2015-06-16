<?php

ini_set( 'upload_max_size' , '64M' );
ini_set( 'post_max_size', '64M');
ini_set( 'max_execution_time', '300' );

include_once 'functions/wp_enqueue_script.php';
include_once 'functions/loop.php';
include_once 'functions/images.php';
include_once 'functions/related-link.php';
include_once 'functions/kicker.php';
include_once 'functions/page-nav.php';
include_once 'functions/templates.php';
include_once 'functions/custom-post-template.php';

// include_once 'functions/timeline.php';
// include_once 'functions/steps.php';



// Variables
if (! defined('WP_ENV'))
{
	define('WP_ENV', 'production');	// default to production environment
}

$tdir = get_template_directory_uri();
define('TDIR', $tdir);

$theme = get_template_directory_uri();
define('THEME', $theme);

$root = get_template_directory();
define('ROOT', $root);

// Includes Path
$inc = $root . '/inc/';
define('INC', $inc);

// Templates Path
$temp = $root . '/templates/';
define('TEMP', $temp);

// The Common Grid — used in multiple places
// $grid = 'entry-box col-lg-10 col-md-8 col-sm-9 col-md-offset-1 col-sm-offset-1';
$grid = 'entry-box col-xs-12 col-sm-8 col-sm-offset-2';
define('GRID', $grid);

// Hide WP Admin Bar
add_filter('show_admin_bar', '__return_false');


// WP Theme Supports
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image',  'video', 'audio', 'chat', 'status', 'quote', 'link') );

add_theme_support( 'infinite-scroll', array(
	'type'			 		 => 'click',
	'container' 		 => 'blog',
	'render'  		 	 => 'loop',
	'footer' => 'page'
) );
add_theme_support( 'post-thumbnails' );

// Register a Menu
function fortune_register_menu() {
  register_nav_menu('app-menu',__( 'App Menu' ));
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'fortune_register_menu' );


// Nav Menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
	if( in_array('current-menu-item', $classes) ){
		$classes[] = 'active ';
	}
	return $classes;
}



if (!is_admin()) {
	// If Logged In, Add DRAFTS to Query
	if ( is_user_logged_in() ) {
		add_action( 'pre_get_posts', 'add_my_post_status_to_query' );
		function add_my_post_status_to_query( $query ) {
			if ( is_home() && $query->is_main_query() || is_feed())
				$query->set(
					'post_status', array('publish', 'pending', 'draft', 'future', 'private', 'inherit')
				);
			return $query;
		}
	}

}



function page_link($slug) {
  echo esc_url(home_url('/')) . $slug;
}



function fortune_get_link_url() {
	$has_url = get_the_post_format_url();
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}



// Related
function get_related(){
  $source = get_post_meta( get_the_ID(), 'related_link_source', true );
  $url = get_post_meta( get_the_ID(), 'related_link_url', true );
	$related = '<p class="via"><img src="http://www.google.com/s2/favicons?domain='.$url.'"/><a href="'.$url.'" title="'.$source.'"><strong>'.$source.'</strong> '.substr($url,0,35).'...';$url.'</a></p>';
	if (!empty($url)) {
		return $related;
	}
}

// Headline
function fortune_headline($type){
  // $the_title = get_the_title();
  $the_title = 'Headline Tech, Promising Future, Rain or Sunshine';
  // $the_permalink = get_the_permalink();
  $the_permalink = './tech/2015/06/14/headline-lorem-ipsum-long/';

  if ( is_single() && $type == '' ) {
    echo <<< EOF
    <h1 class="entry-head">$the_title</h1>
EOF;
  }

  if ($type == 'h5') {
    echo <<< EOF
    <h5 class="entry-head">
      <a href="$the_permalink" rel="bookmark">$the_title</a>
    </h5>
EOF;
  }

  if ($type == 'h3') {
    echo <<< EOF
    <h3 class="entry-head">
      <a href="$the_permalink" rel="bookmark">$the_title</a>
    </h3>
EOF;
  }
  
}


// Entry Meta
if ( ! function_exists( 'fortune_entry_meta' ) ) :
function fortune_entry_meta() {

  // $author = get_the_author();
  // $author_user = get_the_author_meta( 'user_login' );
  // $author_link = get_author_posts_url(get_the_author_meta( 'ID' ));
	// echo '<span class="author_img"><img src="'.TDIR.'/assets/img/team/'.$author_user.'.png" alt="'.$author.'"> By '.$author.' | ';

	// fortune_entry_date();

	// if ( is_user_logged_in() ) {
	// 	$edit = get_edit_post_link($id);
	// 	echo '<a href="'.$edit.'" class="btn-edit btn btn-xs btn-primary">edit</a>';
	// }

	// if (is_single()){
	// 	// Translators: used between list items, there is a space after the comma.
	// 	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	// 	if ( $tag_list ) {
	// 		echo ' <span class="tags-links pull-right">' . $tag_list . '</span>';
	// 	}
	// }
  echo <<< EOF
  <div class="entry-meta">
    <p class="byline">by <a href="#">Author Name</a></p>
    <p class="date">July 15, 2015</p>
  </div>
EOF;
}
endif;


// CATEGORY
function fortune_category(){
  if (!is_category()) {
    foreach((get_the_category()) as $category) {
      if ($category->cat_name !== 'Uncategorized') {
        echo ' <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
      }
    }
  }
}

// DATE
function fortune_entry_date( $echo = true ) {
  $date = '<div class="date"><a class="date" href="'.get_permalink().'" title="'.the_title_attribute( 'echo=0' ).'" rel="bookmark"><time class="dt-published published entry-date rel_time" datetime="'.get_the_date('c').'"><span>'.get_the_time('F j, Y g:i a').'</span></time></a></div>';
  return $date;
}

function fortune_byline_card(){
  $date = fortune_entry_date();
	echo <<< EOF
  <div class="byline-card">
    <div class="media">
      <img src="http://placehold.it/150x150" class="img-responsive">
    </div>
    <h5>by <a href="#">Alan Murray</a> <span><a href="http://twitter.com/alanmurray"><i class="fa fa-twitter"></i> @alanmurray</a></span></h5>
    <h6>Editor</h6>
    $date
  </div>
EOF;
}



// The Excerpt
function entry_excerpt(){
  $e = get_the_excerpt() . ' <p><a class="more" href="'. get_permalink( get_the_ID() ) . '">Read&nbsp;More&nbsp;»</a></p>';
  echo $e;
}

function new_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




?>
