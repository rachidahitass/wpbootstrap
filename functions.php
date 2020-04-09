<?php
/**
 * WpBootstrap functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since 1.0.0
 */
@ini_set( 'upload_max_filesize' , '120M' );
@ini_set( 'post_max_size', '12M');
@ini_set( 'max_execution_time', '300' );

/**
 * Monozygote only works in WordPress 4.7 or later.
 */
if ( ! function_exists( 'wpbootstrap_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wpbootstrap_setup() {

		require_once('inc/class-wp-bootstrap-navwalker.php');
		/**
		 * Enable support for post thumbnails and featured images.
		 */
		add_theme_support( 'post-thumbnails' );
		// Set custom thumbnail dimensions
		set_post_thumbnail_size( 900, 600, true );

		// Add theme support for HTML5 Semantic Markup
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
 
		// Add theme support for document Title tag
		add_theme_support( 'title-tag' );
 
		// Add theme support for Translation
		load_theme_textdomain( 'text_domain', get_template_directory() . '/language' );

		/**
		 * Add support for two custom navigation menus.
		 **/
			register_nav_menus(
				array(
				'primary'   => __('Primary Menu'),
				'footer' => __('Secondary Menu')
			)
			);

		/**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 **/
		add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video', 'link' ) );

		/**
		 * Enqueue scripts and styles.
		 **/
		function wpbootstrap_scripts() {
			wp_enqueue_style('bootstrapmin', '//stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css','','3.2.1', 'all');
			wp_enqueue_script('bootstrapjsmin', '//stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js',array('jquery'), '3.2.1', true);
		}
		add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts' );
		function init_widgets($id) {
			register_sidebar( array(
				'name'          => __( 'Sidebar', 'wpbootstrap' ),
				'id'            => 'sidebar',
				'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'wpbootstrap' ),
				'before_widget' => '<div id="%1$s" class="w3-col m3 l3 widget side-widget %2$s">',
				'after_widget'  => '</div>'
			));
		}
		/*function wpbootstrap_init_widget() {
			register_widget('wpbootstrap_Widget_Categories');
		}*/
		add_action('widgets_init','init_widgets');
		//add_action('widgets_init', 'wpbootstrap_init_widget');
	}
endif;
	add_action('after_setup_theme','wpbootstrap_setup');