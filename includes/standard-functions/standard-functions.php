<?php 

//* Inject optimized CSS before the HEAD tag
add_filter('autoptimize_filter_css_replacetag','sa_desktop_override_css_replacetag',10,1);
function sa_desktop_override_css_replacetag($replacetag) {
	return array("</head>","before");
}

//* Add class to .site-container
add_filter( 'genesis_attr_site-container', 'genesis_bootstrap_container' );
function genesis_bootstrap_container( $attributes ) {

	$attributes['class'] .= ' container-fluid';
	return $attributes;
 
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove Secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 0 );

// Add H1 Heading to tags and categories
add_action( 'genesis_before_loop' , 'genesis_child_category_header');
function genesis_child_category_header() {
	if ( is_category() || is_tag() )  {
		echo '<h1 class="archive-title">';
		echo single_cat_title();
		echo '</h1>';
	}
}

// Add support for PHP in widgets
add_filter('widget_text','sa_desktop_execute_php',100);
function sa_desktop_execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}

//* Add support for custom sidebars for parent pages
function is_tree( $pid ) {      
    global $post; 
    if ( is_page($pid) )
        return true;
    $anc = get_post_ancestors( $post->ID );
    foreach ( $anc as $ancestor ) {
        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }
    return false;  // we arn't at the page, and the page is not an ancestor
}

//* Adding Additional Nav Menu (Sitemap)
function sa_desktop_sitemap() {
	register_nav_menu( 'sitemap' ,__( 'Sitemap Menu' ));
}
add_action( 'init', 'sa_desktop_sitemap' );

function sitemap_menu( $theme_location ) {
	if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
		$menu = get_term( $locations[$theme_location], 'nav_menu' );
		wp_nav_menu( array('menu' => $menu->term_id ));
	} else {
		$menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
	}
	echo $menu_list;
}

function dynamic_sitemap() {
	sitemap_menu('sitemap');
}

add_shortcode( 'spp-sitemap','dynamic_sitemap' );

//* Added Lazy shortcode video
function lazy_video($atts){
	$a = shortcode_atts( array(
		'id' 	=>	'',
		'image'	=>	'',
	), $atts );
	return '<div class="youtube" data-id="'. esc_attr( $a['id'] ) .'" style="background-image:url('. esc_attr( $a['image'] ) .')">
	    		<div class="play-button"></div>      
			</div>';
}
add_shortcode( 'lazy_video', 'lazy_video' );

// Remove entry meta from entry footer incl. markup
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Modify the Excerpt read more link
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ) {
    return '... <a class="more-link" href="' . get_permalink() . '">[Read More]</a>';
}

//* Customize the header for mobile 
add_action( 'genesis_header', 'sa_mobile_header_widgets' );
function sa_mobile_header_widgets() { 
	 ?>
		<div class="hidden-desktop">
			<div class="row">
				<div class="col-xs-6">
					<div class="pull-left">
						<?php
							if ( is_active_sidebar( 'sa-mobile-phone-header' ) ) {
								genesis_widget_area( 'sa-mobile-phone-header' );
							}
						?>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="pull-right">
						<span class="menu-toggle">MENU</span>
					</div>
				</div>
			</div>
		</div>
	<?php	
}

//* Add featured full width for single 
add_action( 'genesis_after_header', 'entry_featured_image' );
function entry_featured_image(){
	$image 	= get_the_post_thumbnail_url( get_the_ID() , 'full' );
	if ( in_category('blog') && is_single()  && !empty($image) ) {		
		?>
		<div class="entry-featured-image" style="background-image: url('<?php echo $image; ?>')"></div>			

		<?php
	}
}

add_filter( 'gform_tabindex', '__return_false' );
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'widget_text', 'do_shortcode' );

function html_widget_title( $title )  {
	
	//HTML tag opening/closing brackets
	$title = str_replace( '[', '<', $title );
	$title = str_replace( ']', '>', $title );
	$title = str_replace( '[/', '</', $title );

	return $title;

}

add_filter( 'widget_title', 'html_widget_title' );
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'genesis_after_header', 'genesis_child_featured_banner', 10, 1 );
function genesis_child_featured_banner() {
	$page_id	= get_the_ID();
	$enable 	= get_post_meta( $page_id, '_gcfb_enable', true );
	$title 		= get_the_title( $page_id );
	$desc1 		= get_post_meta( $page_id, '_gcfb_description', true );
	$ctaTitle 	= get_post_meta( $page_id, '_gcfb_ctcT', true );
	$ctaURL 	= get_post_meta( $page_id, '_gcfb_ctc', true );
	$image 		= get_post_meta( $page_id, '_gcfb_image', true );
	?>
	
	<?php if ($enable): ?>

		<?php if ( !is_single()): ?>
			<?php 
			
			remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
			remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

			?>

			<div class="banner-featured-image content-row" style="background-image: url(' <?php echo $image; ?>');">
				<div class="wrap">
					<div class="row">
						<div class="col-sm-6">
							<?php if (!empty($title)): ?>
								<h1 class="entry-title"><?php echo $title; ?></h1>
							<?php endif ?>						
							<?php if (!empty($desc1)): ?>
								<p class="banner-description"><?php echo $desc1; ?></p>			
							<?php endif ?>
							<?php if (!empty($ctaTitle) && !empty($ctaURL)): ?>
								<a href="<?php echo $ctaURL; ?>" class="button button-1"><?php echo $ctaTitle; ?></a>			
							<?php endif ?>
						</div>
					</div>
				</div>			
			</div>
		<?php endif ?>
	<?php else: ?>
		<?php if (is_page()): ?>
			<?php 
			remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
			remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
			?>
			<div class="banner-featured-background content-row">
				<div class="wrap">
					<h1 class="banner-title"><?php echo $title; ?></h1>
				</div>			
			</div>
		<?php endif ?>
	<?php endif ?>

	<?php
}

add_filter( 'photogallery_taxonomy_disclaimer_filter', 'custom_taxonomy_disclaimer' );
function custom_taxonomy_disclaimer ( $disclaimer ) {
 $disclaimer = "";
 return $disclaimer;
}

add_filter('photogallery_archive_sections_order_filter', 'remove_permalink_archive');
function remove_permalink_archive($sections){
 $sections['permalink'] = false;
 return $sections;
}

add_action( 'loop_end', 'sa_desktop_taxonomy_bottom' );
function sa_desktop_taxonomy_bottom(  ) {
 if ( is_tax('procedures') ||  is_tax( 'procedures-tags' ) || is_post_type_archive('photo-gallery')  ) {
   echo '<p class="text-disclaimer">* Each patient is unique and individual results may vary.</p>';
 }
}

add_filter( 'photogallery_taxonomy_content_sections_filter', 'custom_taxonomy_description' );
function custom_taxonomy_description ($sections) {
	$sections['patient_description'] = false;
	return $sections;
}


?>