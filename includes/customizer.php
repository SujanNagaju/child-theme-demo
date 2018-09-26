<?php
//customizer
function cd_customizer_settings( $wp_customize ){
	$wp_customize->add_section ( 'social_links', array(
		'title' => 'Social Links',
		'priority' => 100,
	) );

	$wp_customize->add_setting('facebook_field', array(
		'default' => 'Default Value',
		'type' => 'theme_mod',
		'sanitization_callback' => 'facebook_sanitize_function',
	) );

	$wp_customize->add_control('facebook_field', array(
		'label' => 'Facebook Field',
		'section' => 'social_links',
		'settings' => 'facebook_field',
		'type' => 'text',
	));	

	//uploading image from customizer 
	//
	$wp_customize->add_setting('upload_image', array(
		'type' => 'theme_mod'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_image', array(
		'label' => 'Images',
		'settings' => 'upload_image',
		'section' => 'social_links'
	)) );

	//twitter field
	$wp_customize->add_setting('twitter_field',array(
		'default' => 'Default Value',
		'type' => 'theme_mod',
		'sanitization_callback' => 'twitter_sanitization_function',
	));

	$wp_customize->add_control('twitter_field', array(
		'label' => 'Twitter Field',
		'section' => 'social_links',
		'settings' => 'twitter_field',
		'type' => 'text',
	));

	$wp_customize->add_setting('linked_in_field',array(
		'default' => 'Default Value',
		'type' => 'theme_mod',
		'sanitization_callback' => 'linked_in_sanitization_function'
	));

	$wp_customize->add_control('linked_in_field', array(
		'label' => 'LinkedIn Field',
		'section' => 'social_links',
		'type' => 'text',
		'settings' => 'linked_in_field',

	));


	//extra section today just  fot testing purpose
	$wp_customize->add_section('today', array(
		'title' => 'Today',
	));

	$wp_customize->add_setting('today_field', array(
		'default' => 'Default Value',
		'type' => 'theme_mod',
	));

	$wp_customize->add_control('today_field', array(
		'label' => 'Horoscope Today',
		'settings'=> 'today_field',
		'type' => 'text',
		'section' => 'today'
	));

	//extra section ends 

}

function facebook_sanitization_function( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
} 

function twitter_sanitization_function( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
} 

function linked_in_sanitization_function( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
} 

add_action('customize_register', 'cd_customizer_settings')
;
/*
**************************************************************
Test diffrent input types
*/
add_action( 'customize_register', 'test_customizer_settings' );
function test_customizer_settings( $wp_customize ) {
	/*Try Checkboxes checkbox male*/
	$wp_customize->add_section( 'test_inputs' , array(
		'title'      => 'Test',
		'priority'   => 0,
	) );

	$wp_customize->add_setting('checkbox_field_male', array( 
		'default' => 'male',
		'type' => 'theme_mod',
		
	) );

	$wp_customize->add_control('checkbox_field_male', array( 
		'label' => 'Male',
		'section' => 'test_inputs',
		'settings' => 'checkbox_field_male',
		'type' => 'checkbox'
	) );

	/*checkbox female*/
 
	$wp_customize->add_setting('checkbox_field_female', array( 
		'default' => 'Default Value',
		'type' => 'theme_mod',
		
	) );

	$wp_customize->add_control('checkbox_field_female', array( 
		'label' => 'Female',
		'section' => 'test_inputs',
		'settings' => 'checkbox_field_female',
		'type' => 'checkbox'
	) );
	#checkbox female ends
 

	//test checkbox 
	//show or hide copyright text using checkbox	
	$wp_customize->add_setting(
		'copyright_textbox',
		array(
			'default' => 'Default copyright text',
			'sanitize_callback' => 'copyright_sanitization_function',

		)
	);

	$wp_customize->add_control('copyright_textbox',
		array(
			'label' => 'Copyright Text',
			'section' => 'test_inputs',
			'type' => 'text'
		)
	);

	$wp_customize->add_setting('hide_copyright');

	$wp_customize->add_control('hide_copyright',
			array(
				'type' => 'checkbox',
				'label' => 'Hide copyright text',
				'section' => 'test_inputs'
			)
	);

	//test Radio Button inputs 
	$wp_customize->add_setting('test_radio', 
		array(
			'default' => 'left',
			'sanitization_callback' => 'radiobutton_sanitazation_function',
		)
	);

	$wp_customize->add_control('test_radio', array(
				'type' => 'radio',
				'label' => 'Logo Position',
				'section' => 'test_inputs',
				'choices' => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center'
				),
	) );

	//select options testing 
	$wp_customize->add_setting('test_select_dropdown', array(
			'default' => 'wordpress',
			'sanitization_callback' => 'dropdown_sanitization_function',
	) );

	$wp_customize->add_control('test_select_dropdown', array(
			'type' => 'select',
			'label' => 'powered by',
			'section' => 'test_inputs',
			'choices' => array(
				'wordpress' => 'Wordpress',
				'redbull' => 'Redbull',
				'ncell' => 'Ncell'
			),
	));

	//test_textarea
	$wp_customize->add_setting('text_textarea', array(
			'default' => 'write your comments',
			'sanitization_callback' => 'text_area_sanitization_function',
	) );

	$wp_customize->add_control('text_textarea', array(
				'label' => 'Comments',
				'section' => 'test_inputs',
				'type' => 'textarea',

	) );
}



//sanitization for copyright textinput 
function copyright_sanitization_function($input) {
	return wp_kses_post( force_balance_tags( $input ) );
}
function radiobutton_sanitazation_function($input) {
	$valid = array(
		'left' => 'Left',
		'right' => 'Right',
		'center' => 'Center',
	);	

	if(in_array ($input, $valid) ){
		return $input;
	}
	else{
		return '';
	}
}
function dropdown_sanitization_function ($input){
	$valid = array(
		'wordpress' => 'Wordpress',
		'redbull' => 'Redbull',
		'ncell' => 'Ncell'
	);

	if(in_array($input, $valid) ){
		return $input;
	}
	else{
		return '';
	}
}

function text_area_sanitization_function($input){
	return wp_kses_post( force_balance_tags( $input ) ) ;
}