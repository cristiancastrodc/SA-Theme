<?php 

//Template name: Landing Page

add_filter( 'body_class', 'sa_desktop_body_class' );
function sa_desktop_body_class( $classes ) {
	$classes[] = 'page-landing';
	return $classes;
}

// Enqueue Headroom
add_action( 'wp_enqueue_scripts', 'sa_desktop_landing_enqueue_scripts' );
function sa_desktop_landing_enqueue_scripts() {
	wp_enqueue_style( 'landing-styles', '/wp-content/themes/sa-theme-desktop/style-landing.css' );
}

// Remove the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );

// Remove header
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//Remove post title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open',  5  );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//Remove Footer
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

remove_action( 'genesis_header', 'sa_mobile_header_widgets' );
remove_action( 'genesis_after', 'sa_mobile_swipe_menu' );
remove_action( 'genesis_after_header' , 'sa_mobile_logo' );
remove_action( 'genesis_before_footer', 'sa_tablet_contact_form' );
remove_action( 'genesis_footer', 'sa_mobile_footer', 10 );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

genesis();