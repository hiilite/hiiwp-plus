<?php
/**
 * Plugin Name: HiiWP Plus
 * Plugin URI: https://github.com/hiilite/hiiwp-plus
 * Description: Add a portfolio to your HiiWP Theme.
 * Version: 1.0.3
 * Author: Peter Vigilante
 * Author URI: https://hiilite.com/
 * Requires at least: 4.0.0
 * Tested up to: 4.0.0
 *
 * Text Domain: hiiwp-plus
 * Domain Path: /languages/
 *
 * @package HiiWP_Plus
 * @category Core
 * @author Peter Vigilante
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns the main instance of HiiWP_Plus to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object HiiWP_Plus
 */
function HiiWP_Plus() {
	return HiiWP_Plus::instance();
} // End HiiWP_Plus()

add_action( 'plugins_loaded', 'HiiWP_Plus' );

/**
 * Main HiiWP_Plus Class
 *
 * @class HiiWP_Plus
 * @version	1.0.0
 * @since 1.0.0
 * @package	HiiWP_Plus
 * @author Peter Vigilante
 */
final class HiiWP_Plus {
	/**
	 * HiiWP_Plus The single instance of HiiWP_Plus.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	/**
	 * The plugin directory URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_url;

	/**
	 * The plugin directory path.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_path;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * The settings object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings;
	// Admin - End

	// Post Types - Start
	/**
	 * The post types we're registering.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $post_types = array();
	// Post Types - End
	
	/**
	 * The load templates.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $templates;
	
	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	
	public function __construct () {
		define('HIIWP_PLUS_PLUGIN_DIR', plugin_dir_path( dirname(__FILE__) ));
		$this->token 			= 'hiiwp-plus';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.3';

		// Admin - Start
		require_once( 'includes/class-hiiwp-plus-settings.php' );
			$this->settings = HiiWP_Plus_Settings::instance();

		if ( is_admin() ) {
			require_once( 'includes/class-hiiwp-plus-admin.php' );
			$this->admin = HiiWP_Plus_Admin::instance();
		}
		// Admin - End

		// Post Types - Start
		require_once( 'includes/class-hiiwp-plus-template-loader.php' );
		require_once( 'includes/class-hiiwp-plus-post-types.php' );
		require_once( 'includes/class-hiiwp-plus-theme-options.php' );
		require_once( 'includes/class-hiiwp-plus-shortcodes.php' );
		require_once( 'includes/class-hiiwp-plus-taxonomy.php' );
		require_once( 'includes/class-hiiwp-plus-schema.php' );
		require_once( 'includes/class-hiiwp-plus-seo.php' );
		
		$this->post_types	= new HiiWP_Plus_Post_Types();
		$this->theme_options= new HiiWP_Plus_Theme_Options();
		$this->shortcodes	= new HiiWP_Plus_Shortcodes();


		$title 		= get_theme_mod( 'portfolio_title', 'Portfolio' );
		$slug 		= get_theme_mod( 'portfolio_slug', 'portfolio' );
		$tax_title 	= get_theme_mod( 'portfolio_tax_title', 'Work' );
		$tax_slug 	= get_theme_mod( 'portfolio_tax_slug', 'work' );
		
		
		// Post Types - End
		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
		/*
		Include Support Add-ons	
		*/
		if(class_exists('Vc_Manager')){
			/*
			Include VC Extend file
			*/
			add_action( 'init', array( $this, 'requireVcExtend' ), 10);	
		}
		
	} // End __construct()

	/**
	 * Main HiiWP_Plus Instance
	 *
	 * Ensures only one instance of HiiWP_Plus is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see HiiWP_Plus()
	 * @return Main HiiWP_Plus instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'hiiwp-plus', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	} // End load_plugin_textdomain()

	/**
	 * Cloning is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	} // End __wakeup()

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 */
	public function install () {
		$this->_log_version_number();
	} // End install()

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 */
	private function _log_version_number () {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	} // End _log_version_number()
	
	/**
	 * requireVcExtend function.
	 * 
	 * @access public
	 * @return void
	 */
	public function requireVcExtend(){
		require_once('extendvc/extend-vc.php');
	}
} // End Class
