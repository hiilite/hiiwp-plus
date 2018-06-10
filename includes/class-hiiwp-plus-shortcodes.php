<?php
/**
 * The HiiWP Plus Shortcodes class.
 * Handles adding all admin options
 *
 * @package     HiiWP_Plus
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

/**
 * HiiWP_Plus_Shortcodes class.
 * Handels the creation of shortcodes, including the output of front end CSS, JS, and display of options panels
 *
 * @since 1.0
 */
class HiiWP_Plus_Shortcodes {
	
	public function __construct(){
		
		/* Add with options in Custumizer */
		if(get_theme_mod( 'blog_author_bio' ) == true){
			require_once( plugin_dir_path( __FILE__ ) . '/includes/shortcodes/author-info.php');
		}
		
		/*
		 * Auto include all shortcodes
		 */
		foreach (glob(plugin_dir_path( __FILE__ )."shortcodes/*.php") as $filename) {
			$template_file_with_ext = str_replace( plugin_dir_path( __FILE__ ), '', $filename);
			preg_match('/[^\/]+?(?=\.)/', $template_file_with_ext, $template_file);
		    require_once( 'shortcodes/'.$template_file[0].'.php' );
		} 
		
	}
	
}