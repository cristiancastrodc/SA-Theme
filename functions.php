<?php

//* Start the engine
require_once( get_template_directory() . '/lib/init.php' );
require_once( get_stylesheet_directory() . '/includes/standard-functions/standard-functions.php');
require_once( get_stylesheet_directory() . '/includes/custom-fields/custom-fields.php');

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'SA Theme Desktop', 'sa-desktop' );
define( 'CHILD_THEME_URL', 'http://surgeonsadvisor.com' );

//* Enqueue Scripts/Styles
add_action( 'wp_enqueue_scripts', 'sa_desktop_enqueue_scripts_styles' );
function sa_desktop_enqueue_scripts_styles () {


	/* Bootstrap */
	wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri().'/includes/lib/bootstrap/css/bootstrap.min.css', array(), PARENT_THEME_VERSION );
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() .'/includes/lib/bootstrap/js/bootstrap.min.js', array('jquery') );

	/* Swipe menu*/
	wp_enqueue_script( 'hammer', get_stylesheet_directory_uri().'/includes/lib/swipe/hammer.min.js' );

	/* Custom */
	wp_enqueue_style( 'standard-styles', get_stylesheet_directory_uri().'/includes/css/style-standard.css', array(), PARENT_THEME_VERSION );
	wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/style.css', array(), PARENT_THEME_VERSION );
	wp_enqueue_script( 'scripts',get_stylesheet_directory_uri().'/includes/js/scripts.js' );

	/* Fonts */
	wp_enqueue_style( 'google-font', get_stylesheet_directory_uri().'/includes/lib/fonts/fonts.css', array(), PARENT_THEME_VERSION );

	/* FontAwesome */
	wp_enqueue_style( 'prefix-font-awesome', get_stylesheet_directory_uri().'/includes/lib/font-awesome/css/font-awesome.min.css' );

	/* Lity */
	if (!is_post_type_archive( 'testimonial' ) && !is_tax('testimonial') && !is_singular('testimonial')) {
		wp_enqueue_style( 'lity-css', get_stylesheet_directory_uri().'/includes/lib/lity/lity.min.css' );
		wp_enqueue_script( 'lity-js', get_stylesheet_directory_uri().'/includes/lib/lity/lity.min.js' );
	}

	/* Lazy Load */
	wp_enqueue_style( 'lazy-video-css', get_stylesheet_directory_uri().'/includes/lib/lazy-load-youtube/styles.css' );
	wp_enqueue_script( 'lazy-video-js', get_stylesheet_directory_uri().'/includes/lib/lazy-load-youtube/script.js' );

	/* Custom styles */
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri().'/custom.css' );
}


//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 146,
	'height'          => 134,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

// Change the footer text

# Remove the inner footer markup
remove_action( 'genesis_footer', 'genesis_do_footer' );
# Remove the footer opening markup
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
# Remove the footer closing markup
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

/*add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_filter' );
function sp_footer_creds_filter( $creds ) {
	$creds = '<p>&copy; Copyright ' . date("Y") . '. ' . get_bloginfo ( 'title' ) . '. ' . ' ' . get_bloginfo ( 'description' ) . '.';
	return $creds;
}*/

// Customize entry meta in the entry header
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter( $post_info ) {
	if (is_category( 'blog' ) || in_category( 'blog')) {
		$post_info = '[post_date] by <a href="#">DR. NAME</a> [post_comments] [post_edit]';
	}else{
		$post_info = '';
	}

	return $post_info;

}

// Schema Medical Procedures
add_filter( 'genesis_attr_entry', 'sa_desktop_schema_article', 20 );
add_filter( 'genesis_attr_entry-title', 'sa_desktop_schema_article_title', 20 );
add_filter( 'genesis_attr_entry-content', 'sa_desktop_schema_article_content', 20 );

function sa_desktop_schema_article( $attributes ) {
if (is_tree( is_tree( PROCEDURE_ID ) )) {
		$attributes['itemtype'] = 'https://health-lifesci.schema.org/MedicalProcedure';
		return $attributes;
	}else{
		$attributes['itemtype'] = 'https://schema.org/CreativeWork';
		return $attributes;
	}
}
function sa_desktop_schema_article_title( $attributes ) {
	if (is_tree( is_tree( PROCEDURE_ID ) )) {
		$attributes['itemprop'] = 'name';
		return $attributes;
	}else{
		$attributes['itemprop'] = 'headline';
		return $attributes;
	}
}
function sa_desktop_schema_article_content( $attributes ) {
if (is_tree( is_tree( PROCEDURE_ID ) )) {
		$attributes['itemprop'] = 'description';
		return $attributes;
	}else{
		$attributes['itemprop'] = 'text';
		return $attributes;
	}
}

//* Order of the widgets for the sidebar
add_action( 'genesis_before_sidebar_widget_area', 'sa_desktop_custom_sidebar', 10, 1 );
function sa_desktop_custom_sidebar(){
	if ( is_active_sidebar( 'sidebar-form' ) ) {
		if (!is_page( CONTACT_PAGE )) {
			genesis_widget_area( 'sidebar-form' );
		}
	}else{ ?>
		<h4 class="widgettitle">Sidebar Contact Form</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
	<?php }

	if (is_active_sidebar('sidebar-videogallery')) {
		if ( is_post_type_archive('video-gallery') || is_tax('video-category') || is_singular('video-gallery') ) {
			genesis_widget_area( 'sidebar-videogallery' );
		}
	}else{ ?>
		<h4 class="widgettitle">Sidebar Video Gallery</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
	<?php }

	if (is_active_sidebar('sidebar-photogallery')){
		if ( is_post_type_archive('photo-gallery') || is_tax('procedures') ||  is_tax( 'procedures-tags' )  || is_singular('photo-gallery') ){
			genesis_widget_area( 'sidebar-photogallery' );
		}
	}else{ ?>
		<h4 class="widgettitle">Sidebar Photo Gallery</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
	<?php }

	if (is_active_sidebar('sidebar-photogallery-shortcode')){
		if ( !is_post_type_archive('photo-gallery') && !is_tax('procedures') &&  !is_tax( 'procedures-tags' )  && !is_singular('photo-gallery') ){
			genesis_widget_area( 'sidebar-photogallery-shortcode' );
		}
	}else{ ?>
		<h4 class="widgettitle">Sidebar Photo Gallery Shortcode</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
	<?php }

	if (is_active_sidebar( 'sidebar-review' )) {
		if ( !is_post_type_archive( 'testimonial' ) && !is_tax('testimonial') && !is_singular('testimonial')) {
			genesis_widget_area( 'sidebar-review' );
		}
	}else{ ?>
		<h4 class="widgettitle">Sidebar Review</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
	<?php }
}

// add_action( 'genesis_footer', 'sa_footer');

function sa_footer(){
	?>
		<div class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
			<div class="wrap">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( 'footer-1' )) {
							genesis_widget_area( 'footer-1' );
						}else { ?>
							<h4 class="widgettitle">Footer 1</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						<?php } ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( 'footer-2' )) {
							genesis_widget_area( 'footer-2' );
						}else { ?>
						<h4 class="widgettitle">Footer 2</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						<?php } ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( 'footer-3' )) {
							genesis_widget_area( 'footer-3' );
						}else { ?>
						<h4 class="widgettitle">Footer 3</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						<?php } ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( 'footer-4' )) {
							genesis_widget_area( 'footer-4' );
						}else { ?>
						<h4 class="widgettitle">Footer 4</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						<?php } ?>
					</div>
				</div>
				<?php if (is_active_sidebar( 'footer-description' )): ?>
					<div class="site-footer-description">
					 	<?php genesis_widget_area( 'footer-description' ); ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	<?php
}

//* Begin Desktop widgets
genesis_register_widget_area( array(
	'id'          => 'slider',
	'name'        => __( 'Slider', 'sa-desktop' ),
	'description' => __( 'This is the widget for the slider', 'sa-desktop' ),
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-1',
	'name'			=> 'Home Credentials',
	'description'	=> 'This is the Credentials widget.'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-2',
	'name'			=> 'Home Doctor 1',
	'description'	=> 'This is the Home Doctor 1'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-3',
	'name'			=> 'Home Doctor 2',
	'description'	=> 'This is the Home Doctor 2'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-4',
	'name'			=> 'Home Doctor 3',
	'description'	=> 'This is the Home Doctor 3'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-5',
	'name'			=> 'Home Our Procedures',
	'description'	=> 'This is the Home Our Procedures'
	));

//* Begin footer widgets
genesis_register_sidebar( array(
	'id'			=> 'footer-1',
	'name'			=> 'Footer 1',
	'description'	=> 'This is the Footer 1 section'
	));

genesis_register_sidebar( array(
	'id'			=> 'footer-2',
	'name'			=> 'Footer 2',
	'description'	=> 'This is the Footer 2 section'
	));

genesis_register_sidebar( array(
	'id'			=> 'footer-3',
	'name'			=> 'Footer 3',
	'description'	=> 'This is the Footer 3 section'
	));

genesis_register_sidebar( array(
	'id'			=> 'footer-4',
	'name'			=> 'Footer 4',
	'description'	=> 'This is the Footer 4 section'
	));

genesis_register_sidebar( array(
	'id'			=> 'footer-description',
	'name'			=> 'Footer Description',
	'description'	=> 'This is the Footer Description section'
) );

//* Begin standard widgets
genesis_register_sidebar( array(
	'id'			=> 'sidebar-form',
	'name'			=> 'Contact Form',
	'description'	=> 'This is the Sidebar Contact Form section'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-photogallery',
	'name'			=> 'Photo Gallery',
	'description'	=> 'This is the Sidebar Photo Gallery section'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-photogallery-shortcode',
	'name'			=> 'Shortcode Photo Gallery',
	'description'	=> 'This is the Sidebar Shortcode Photo Gallery section'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-review',
	'name'			=> 'Reviews',
	'description'	=> 'This is the Sidebar Reviews section'
	));

genesis_register_sidebar( array(
	'id'			=> 'sidebar-videogallery',
	'name'			=> 'Sidebar Video Gallery',
	'description'	=> 'This is the Sidebar Video Gallery section'
	));

genesis_register_widget_area( array(
	'id'          => 'sa-mobile-phone-header',
	'name'        => __( 'Phone - Header', 'sa-mobile' ),
	'description' => __( 'This is the widget for mobile phone in header', 'sa-mobile' ),
));