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
		if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
			// file does not exist... return an error.
			return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
		} else {
			// file exists... require it.
			require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
		}
		require_once get_template_directory() . '/widgets/class-wp-widget-categories.php';
		require_once get_template_directory() . '/widgets/class-wp-widget-recent-comments.php';
		require_once get_template_directory() . '/widgets/class-wp-widget-recent-posts.php';
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
		load_theme_textdomain( 'text_domain', get_template_directory_uri() . '/language' );

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
			wp_enqueue_style('bootstrapmin', '//stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css','','3.4.1', 'all');
			wp_enqueue_style('wpbscustom', get_template_directory_uri() . '/css/wpbcss.css','','1.0', 'all');
			wp_enqueue_style('fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css','','4.7.0', 'all');
			wp_enqueue_script('bootstrapjsmin', '//stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js',array('jquery'), '3.4.1', true);
			wp_enqueue_script('wpbscript', get_template_directory_uri() . '/js/script.js','', '1.0', true);
		}
		//echo get_template_directory();
		add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts' );
		function init_widgets($id) {
			register_sidebar( array(
				'name'          => __( 'Sidebar', 'wpbootstrap' ),
				'id'            => 'sidebar',
				'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'wpbootstrap' ),
				'before_widget' => '<div class="panel panel-default">',
				'before_title'	=> '<div class="panel-heading"><h3>',
				'after_title'	=> '</h3></div>',
				'after_widget'  => '</div>'
			));
		}
		// Adds 'list-group-item' to categories li
		function add_new_class_list_categories($list){
			$list = str_replace('cat-item', 'cat-item list-group-item', $list);
			return $list;
		}
		// Add Comments
		function add_theme_comments($comment, $args, $depth){
			$GLOBALS['comment'] = $comment;
			extract($args, EXTR_SKIP);
			if ( 'div' === $args['style'] ) {
				$tag       = 'div';
				$add_below = 'comment';
			} else {
				$tag       = 'li';
				$add_below = 'div-comment';
			}?>
			<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
			if ( 'div' != $args['style'] ) { ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
			} ?>
				<div class="comment-author vcard"><?php 
					if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] ); 
					} 
					printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
				</div><?php 
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
				} ?>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
						/* translators: 1: date, 2: time */
						printf( 
							__('%1$s at %2$s'), 
							get_comment_date(),  
							get_comment_time() 
						); ?>
					</a><?php 
					edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
				</div>
		
				<?php comment_text(); ?>
		
				<div class="reply"><?php 
						comment_reply_link( 
							array_merge( 
								$args, 
								array( 
									'add_below' => $add_below, 
									'depth'     => $depth, 
									'max_depth' => $args['max_depth'] 
								) 
							) 
						); ?>
				</div><?php 
			if ( 'div' != $args['style'] ) : ?>
				</div><?php 
			endif;
		}
		add_filter('wp_list_categories', 'add_new_class_list_categories');
		function wpbootstrap_init_widget() {
			register_widget('Wpbootstrap_Widget_Categories');
			register_widget('Wpbootstrap_Widget_Recent_posts');
			register_widget('Wpbootstrap_Widget_Recent_Comments');
		}
		add_action('widgets_init','init_widgets');
		add_action('widgets_init', 'wpbootstrap_init_widget');
	}
endif;
	add_action('after_setup_theme','wpbootstrap_setup');