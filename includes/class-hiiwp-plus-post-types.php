<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * HiiWP Plus Post Type Class
 *
 * All functionality pertaining to post types in HiiWP Plus.
 *
 * @package WordPress
 * @subpackage HiiWP_Plus
 * @category Plugin
 * @author Peter Vigilante
 * @since 1.0.0
 */
class HiiWP_Plus_Post_Types {
	/**
	 * The post type token.
	 * @access public
	 * @since  1.0.0
	 * @var    string
	 */
	public $post_type;

	/**
	 * The post type singular label.
	 * @access public
	 * @since  1.0.0
	 * @var    string
	 */
	public $singular;

	/**
	 * The post type plural label.
	 * @access public
	 * @since  1.0.0
	 * @var    string
	 */
	public $plural;

	/**
	 * The post type args.
	 * @access public
	 * @since  1.0.0
	 * @var    array
	 */
	public $args;

	/**
	 * The taxonomies for this post type.
	 * @access public
	 * @since  1.0.0
	 * @var    array
	 */
	public $taxonomies;
	
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  1.0.0
	 */
	private static $_instance = null;
	
	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since  1.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor function.
	 * @access public
	 * @since 1.0.0
	 */
	public function __construct() {
		
		add_action( 'init', array( $this, 'register_post_types'), 0 );
		add_action('cmb2_init', array( $this, 'add_post_options' ) );

		add_action( 'after_setup_theme', array( $this, 'ensure_post_thumbnails_support' ) );
	} // End __construct()

	/**
	 * register_post_types function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register_post_types() {
		global $hiilite_options;
		require_once( 'post_types/post_type-portfolio.php' );
		require_once( 'post_types/post_type-team.php' );
		require_once( 'post_types/post_type-testimonial.php' );
		require_once( 'post_types/post_type-menu.php' );
		
		
		flush_rewrite_rules();
	}
	
	public function add_post_options() {
		require_once( 'post_options/post_options-testimonials.php' );
		require_once( 'post_options/post_options-menu.php' );
	}

	/**
	 * Run on activation.
	 * @access public
	 * @since 1.0.0
	 */
	public function activation () {
		$this->flush_rewrite_rules();
	} // End activation()

	/**
	 * Flush the rewrite rules
	 * @access public
	 * @since 1.0.0
	 */
	private function flush_rewrite_rules () {
		$this->register_post_type();
		flush_rewrite_rules();
	} // End flush_rewrite_rules()

	/**
	 * Ensure that "post-thumbnails" support is available for those themes that don't register it.
	 * @access public
	 * @since  1.0.0
	 */
	public function ensure_post_thumbnails_support () {
		if ( ! current_theme_supports( 'post-thumbnails' ) ) { add_theme_support( 'post-thumbnails' ); }
	} // End ensure_post_thumbnails_support()
} // End Class
