<?php
/**
 * The HiiWP Plus Theme Options class.
 * Handles adding all admin options
 *
 * @package     HiiWP_Plus
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HiiWP_Plus_Theme_Options class.
 * Adds options to the customizer and Theme Options page by passing settings through to Kirki and CMB2
 *
 * @since 0.4.3
 */
class HiiWP_Plus_Theme_Options {
	
	public function __construct() {
		add_action( 'init', array($this, 'get_options_panels'), 20 );
	}
	
	public function get_options_panels() {
		global $hiilite_options;
		require_once( 'theme_options/theme_options-portfolio_section.php' );
		require_once( 'theme_options/theme_options-team_section.php' );
		require_once( 'theme_options/theme_options-testimonial_section.php' );
	}
}