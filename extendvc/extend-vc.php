<?php	
global $hiilite_options;


/**
 * Hii Button
 * Adds Visual Composer option for the Hii Button.
 *
 * @since  1.0.1
 */
vc_map( array( 
		"name" => "Hii Button", 
		"base" => "button",
		"category" => 'HiiWP',
		"description" => "HiiWP default button",
		"icon" => "icon-wpb-ui-button",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Type",
				"description" => "Defined in the customizer",
				"param_name" => "button_type",
				"value" => array(
					"Default" => "",
					"Primary" => "button-primary",	
					"Secondary" => "button-secondary",
				),
				'save_always' => true
			),
			
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text"
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use a Google Font?', 'hiiwp' ),
				'param_name' => 'use_google_font',
				'description' => __( 'Override the default font and select from a list of Google Fonts.', 'hiiwp' ),
				'value' => array( __( 'Yes', 'hiiwp' ) => 'true' ),
			),
			array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts',
                'value' => __( 'Default value', 'hiiwp' ),
                'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900bold italic:900:italic'),
                'settings' => array(
                    'fields'=>array(
	                    'font_family_description' => __('Select font family.','hiiwp'),
                        'font_style_description' => __('Select font styling.','hiiwp')
                  )
                ),
                'description' => __( 'Description for this group', 'hiiwp' ), 
                "dependency" => array (
					"element" => "use_google_font",
					"value" => "true"
				),
            ),
			array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Align",
				"param_name" => "button_align",
				"value" => array(
					"Default" => "",
					"Left" => "align-left",	
					"Center" => "align-center",
					"Right" => "align-right"	
				),
				'save_always' => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Classes",
				"param_name" => "classes"
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "ID",
                "param_name" => "button_id",
                "description" => "Set unique button ID attribute"
            ),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
	        array(
				"type" => "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> "On Click Action",
				"param_name" 	=> "on_click",
				"description"	=> "ex: ga('send', 'event', 'Category', 'Action', 'Label', 'Value');",
				'group' 		=> __( 'Advanced', 'hiiwp' ),
			),
	       
		)
) );

/**
 * Portfolio
 * Adds Visual Composer option for the Portfolio shortcodes.
 *
 * @since  1.0.0
 */
if($hiilite_options['portfolio_on']):
	$title = get_theme_mod( 'portfolio_title', 'Portfolio' );
	$portfolio_slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$tax_title = get_theme_mod( 'portfolio_tax_title', 'Work' );
	$portfolio_tax_slug = get_theme_mod( 'portfolio_tax_slug', 'work' );

	$sections = get_terms($portfolio_tax_slug);
	$hiilite_options['portfolio_work']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['portfolio_work'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "portfolio",
		"category" => 'by Hiilite',
		"description" => "Show your portfolio work",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/layout-boxed.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Work",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['portfolio_work']
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Style",
				"param_name" => "portfolio_image_style",
				'save_always' => true,
				"value" => array(
					'Default' => 'default',
					'Square' => 'square',
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Info Box",
				"param_name" => "portfolio_show_info",
				'save_always' => true,
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Position",
				"param_name" => "portfolio_image_pos",
				'save_always' => true,
				"value" => array(
					'Image Behind' => 'image-behind',
					'Image Left' => 'image-left',
					'Image Above' => 'image-above',
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				'save_always' => true,
				"param_name" => "show_title",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "portfolio_heading_size",
				"value" => array(
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'strong' => 'strong',
				),
				"dependency" => array (
					"element" => "show_title",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Is Slider",
				"param_name" => "is_slider",
				"value" => true,
			),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows', 'hiiwp'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile', 'hiiwp'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon', 'hiiwp'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size', 'hiiwp'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type', 'hiiwp'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color', 'hiiwp'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color', 'hiiwp'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end portfolio_on
	
/**
 * Testimonials
 * Adds Visual Composer option for the Testimonials Slider.
 *
 * @since  1.0.0
 */
if($hiilite_options['testimonials_on']):
	$title = get_theme_mod( 'testimonials_title', 'Testimonials' );
	$testimonials_slug = get_theme_mod( 'testimonials_slug', 'testimonials' );
	$tax_title = get_theme_mod( 'testimonials_tax_title', 'Testimonials Categories' );
	$testimonials_tax_slug = get_theme_mod( 'testimonials_tax_slug', 'testimonials_category' );

	$sections = get_terms($testimonials_tax_slug);
	$hiilite_options['testimonials_sections']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['testimonials_sections'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "testimonials",
		"category" => 'by Hiilite',
		"description" => "Show your testimonials",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/comments.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Categories",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['testimonials_sections']
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Image",
				"param_name" => "show_image",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Style",
				"param_name" => "image_style",
				"value" => array(
					'none' => 'None',
					'Circle' => 'circle',
					'As Background' => 'ad_background',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Position",
				"param_name" => "image_position",
				"value" => array(
					'above' => 'above',
					//'right' => 'right',
					'bottom' => 'bottom',
					//'left' => 'left',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_title",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "heading_tag",
				"value" => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'strong' => 'strong',
				),
				"dependency" => array (
					"element" => "show_title",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Show Rating",
				"param_name" => "show_rating",
				"value" => true,
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Is Slider",
				"param_name" => "is_slider",
				"value" => true,
			),
/* slider standards */
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Slider Layout', 'hiiwp'),
			'param_name'=> 'slider_layout',
			'description' => __( 'Responsive: will fit to the content within the slider (ideal for slides with text content). Fixed: Will maintain a fixed aspect ratio based on an initially set width and height (ideal for background image only sliders)', 'hiiwp' ),
			'value'		=> array(
				'Responsive' => 'responsive',
				'Fixed' => 'fixed',
			),
			'std' 		=> 'responsive',
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'slider_min_height',
			'value'		 => '530',
			'description' => __( 'Site a minimum height the slider can scale down too.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'responsive',
			),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
			),
			'std' => 'none',
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows', 'hiiwp'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile', 'hiiwp'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon', 'hiiwp'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size', 'hiiwp'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type', 'hiiwp'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color', 'hiiwp'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color', 'hiiwp'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Bullets', 'hiiwp'),
			'param_name'=> 'show_bullets',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Bullets', 'hiiwp'),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Bullet Color', 'hiiwp'),
			'param_name'=> 'bullet_color',
			'group'		=> __('Bullets', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'show_bullets',
				'value' => 'true'
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end testimonials_on

/**
 * Teams
 * Adds Visual Composer option for the Teams Slider.
 *
 * @since  1.0.0
 */
if($hiilite_options['teams_on']):
	$title = get_theme_mod( 'team_title', 'Teams' );
	$teams_slug = get_theme_mod( 'team_slug', 'team' );
	$tax_title = get_theme_mod( 'team_tax_title', 'Position' );
	$teams_tax_slug = get_theme_mod( 'team_tax_slug', 'position' );

	$sections = get_terms($teams_tax_slug);
	$hiilite_options['team_positions']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['team_positions'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "teams",
		"category" => 'by Hiilite',
		"description" => "Show your team members",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/user-group.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Positions",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['team_positions']
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Image",
				"param_name" => "show_image",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Style",
				"param_name" => "image_style",
				"value" => array(
					'none' => 'None',
					'Circle' => 'circle',
					'As Background' => 'ad_background',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Position",
				"param_name" => "image_position",
				"value" => array(
					'above' => 'above',
					//'right' => 'right',
					'bottom' => 'bottom',
					//'left' => 'left',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_title",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "heading_tag",
				"value" => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'strong' => 'strong',
				),
				"dependency" => array (
					"element" => "show_title",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Is Slider",
				"param_name" => "is_slider",
				"value" => true,
			),
/* slider standards 
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Slider Layout', 'hiiwp'),
			'param_name'=> 'slider_layout',
			'description' => __( 'Responsive: will fit to the content within the slider (ideal for slides with text content). Fixed: Will maintain a fixed aspect ratio based on an initially set width and height (ideal for background image only sliders)', 'hiiwp' ),
			'value'		=> array(
				'Responsive' => 'responsive',
				'Fixed' => 'fixed',
			),
			'std' 		=> 'responsive',
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'slider_min_height',
			'value'		 => '530',
			'description' => __( 'Site a minimum height the slider can scale down too.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'responsive',
			),
		),
		
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
			),
			'std' => 'none',
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows', 'hiiwp'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile', 'hiiwp'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon', 'hiiwp'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size', 'hiiwp'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type', 'hiiwp'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color', 'hiiwp'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color', 'hiiwp'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end teams_on
