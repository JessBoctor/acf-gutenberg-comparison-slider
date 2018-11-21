<?php
/*
Plugin Name:  ACF Comparison Slider
Plugin URI:   https://jessboctor.com/acf-comparison-slider
Description:  A Gutenberg block which allows the user to create a comparison image slider
Version:      0.0.1
Author:       Jess Boctor
Author URI:   https://jessboctor.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/	

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'ACF_COMP_IMG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACF_COMP_IMG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//Enqueue the CSS and JS
add_action( 'wp_enqueue_scripts', 'acf_comp_img_scripts' );
add_action( 'admin_enqueue_scripts', 'acf_comp_img_scripts' );

function acf_comp_img_scripts(){
	
	global $post;
	
	//>>Register the CSS
	$test_css = wp_register_style( 
		'comp_img_style',
		ACF_COMP_IMG_PLUGIN_URL . 'assets/css/style.css',
		array()
	);
	
	//>>Register the JS
	$test_js = wp_register_script(
		'comp_img_scripts',
		ACF_COMP_IMG_PLUGIN_URL . 'assets/js/main.js',
		array('jquery')
	);
	
	write_log( '/*-------------------------------------*/');
	write_log( 'Page Relaod');
	write_log( 'Css registration test: ' . $test_css );
	write_log( ACF_COMP_IMG_PLUGIN_URL . 'assets/acf-comp-img-style.css');
	write_log( 'js registration test: ' . $test_js  );
	
	//>>Localize the JS Script
	wp_localize_script( 
		'comp_img_scripts',
		'comp_img_data',
		array()
	);
	
	//>>Check to see if our block is being used on the post
	$blocks = gutenberg_parse_blocks( $post->post_content );
	
	$block_names = wp_list_pluck( $blocks, 'blockName' );
	write_log( 'block names:');
	write_log( $block_names );
	
	

	//>>If the block is present, enqueue the scripts
    if ( in_array( 'acf/comparison-images', $block_names ) ) {
	    
	    write_log( 'passed block test' );
	    wp_enqueue_style( 'comp_img_style' );
		$test_css_enqueue = wp_style_is( 'comp_img_style' );
		
		wp_enqueue_script( 'comp_img_scripts' );
		$test_js_enqueue = wp_script_is( 'comp_img_scripts' );
		
		write_log($test_css_enqueue );
		write_log($test_js_enqueue  );
	    
    }
    
}

//Register the block as an option for the field groups
add_action('acf/init', 'acf_comp_img_init');
function acf_comp_img_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'comparison_images',
			'title'				=> __('Comparison Images'),
			'description'		=> __('A block for comparison images.'),
			'render_callback'	=> 'acf_comp_img_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'dashicons-images-alt',
			'keywords'			=> array( 'images', 'comparison' ),
		));
	}
}

//Render the block
function acf_comp_img_block_render_callback( $block ) {
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( ACF_COMP_IMG_PLUGIN_DIR . "acf-comparison-slider-block.php") ) {
		write_log( 'Passed file exists test' );
		include( ACF_COMP_IMG_PLUGIN_DIR . "acf-comparison-slider-block.php" );
	}

}