<?php
/**
 * Theme functions and definitions
 */

// load stylesheets in proper order
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'astra-theme-css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'astra-theme-css' ),
		wp_get_theme()->get( 'Version' )
	);
}

// load theme text domain
add_action( 'after_setup_theme', 'astra_child_simplon_theme_setup' );

function astra_child_simplon_theme_setup() {
	load_child_theme_textdomain( 'astra-child-simplon' );
}

// add custom section to customizer

add_action(
	'customize_register',
	'astra_child_simplon_add_stuff_to_customizer'
);

function astra_child_simplon_add_stuff_to_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'astra-child-section',
		array(
			'title' => __( 'Astra Child Theme Settings', 'astra-child-simplon' ),
		)
	);
	$wp_customize->add_setting(
		'astra_child_fixed_navbar',
		array(
			'default' => true,
			function( $checked ) {
					return ( ( isset( $checked ) && true == $checked ) ? true : false );
			},
		)
	);
	$wp_customize->add_control(
		'astra_child_fixed_navbar',
		array(
			'type'        => 'checkbox',
			'section'     => 'astra-child-section', // Required, core or custom.
			'label'       => __( 'Fixed navigation bar', 'astra-child-simplon' ),
			'description' => __( 'Check here if you want your navigation bar fixed to the top of the screen.', 'astra-child-simplon' ),
		)
	);
}

// add custom class to body

add_filter( 'body_class', 'astra_child_simplon_add_body_class' );

function astra_child_simplon_add_body_class( $classes ) {
	if ( get_theme_mod( 'astra_child_fixed_navbar' ) ) {
		 $classes[] = 'sticky-navbar';
	}

	return $classes;
}

/* your code starts here 👇 */

// add custom color palette to the block editor

add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'White', 'textdomain' ),
			'slug'  => 'white',
			'color'	=> '#FFFFFF',
		),
	  array(
			'name'	=> __( 'Black', 'textdomain' ),
			'slug'  => 'black',
			'color'	=> '#000000',
		),
		array(
			'name'  => __( 'Carbon', 'textdomain' ),
			'slug'  => 'carbon',
			'color'	=> '#4A4A4A',
		),
		array(
			'name'  => __( 'Caramel,', 'textdomain' ),
			'slug'  => 'caramel,',
			'color'	=> '#8B572A',
		),
		array(
			'name'  => __( 'Vanilla,', 'textdomain' ),
			'slug'  => 'vanilla,',
			'color'	=> '#EBE5D9',
		),
		array(
			'name'  => __( 'cappuccino,', 'textdomain' ),
			'slug'  => 'cappuccino,',
			'color'	=> '#B09F82',
		)
	) );
