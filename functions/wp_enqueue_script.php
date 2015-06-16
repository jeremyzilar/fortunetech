<?php

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function coop_scripts() {
  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if (WP_ENV === 'development') {
    $assets = array(
      'css'       => '/assets/css/main.css',
      'js'        => '/assets/js/scripts.js',
      'modernizr' => '/assets/vendor/modernizr/modernizr.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js'
    );
  } else {
    $get_assets = file_get_contents(get_template_directory() . '/assets/manifest.json');
    $assets     = json_decode($get_assets, true);
    $assets     = array(
      'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
      'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
      'modernizr' => '/assets/js/vendor/modernizr.min.js',
      // 'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'
      'jquery' => '/assets/js/jquery.min.js' // For working locally without wifi
    );
  }

  wp_enqueue_style('coop_css', get_template_directory_uri() . $assets['css'], false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
  wp_enqueue_script('jquery');
  wp_enqueue_script('coop_js', get_template_directory_uri() . $assets['js'], array(), null, true);
}
add_action('wp_enqueue_scripts', 'coop_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function coop_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?1.11.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'coop_jquery_local_fallback');

function scripts_styles() {
	global $wp_styles;
	$q = 'v115';
	// Le JS
	// wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), $q, true );
	//wp_enqueue_script('color-js', get_template_directory_uri() . '/js/jquery-color.js', array( 'jquery' ), $q, true );
	// wp_enqueue_script('moment-js', get_template_directory_uri() . '/js/moment.min.js', array( 'jquery' ), $q, true );
	// wp_enqueue_script('psfc', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), $q, true );
	// wp_enqueue_script('beta', get_template_directory_uri() . '/js/beta.js', array( 'jquery' ), $q, true );

	// Le CSS
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',array(), $q);
	// wp_enqueue_style( 'openwebicons', get_template_directory_uri() . '/css/openwebicons-bootstrap.css',array(), $q);
	// wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css',array(), $q);
	// wp_enqueue_style( 'psfc', get_stylesheet_uri(),array(), $q);
	// wp_enqueue_style( 'beta', get_template_directory_uri() . '/css/beta.css',array(), $q);
	// wp_enqueue_style( 'docs', get_template_directory_uri() . '/css/docs.css',array(), $q);
	// wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css',array(), $q);
}
add_action( 'wp_enqueue_scripts', 'scripts_styles' );

// function load_admin_style() {
//   $v = date('d');
//   wp_enqueue_script( 'admin_js', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), $v, 'all' );
//   wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/css/admin.css', false, $v, 'all' );
// }
// add_action( 'admin_enqueue_scripts', 'load_admin_style' );


function fortune_media_popup_init() {
  $v = date('d');
  wp_enqueue_script( 'admin-media', get_template_directory_uri() . '/assets/js/admin/media.js', array( 'media-editor' ), $v, 'all');
}
add_action( 'load-post.php', 'fortune_media_popup_init' );
add_action( 'load-post-new.php', 'fortune_media_popup_init' );

?>
