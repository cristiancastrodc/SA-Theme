<?php

// Template name: Front Page
add_action( 'genesis_meta', 'sa_desktop_home_genesis_meta' );

// DECLARE THE WIDGETS
function sa_desktop_home_genesis_meta () {
	add_action( 'genesis_after_header', 'frontpage_slider' );
	add_action( 'genesis_before_content', 'frontpage_before_content' );
	/* The loop goes here*/
	add_action( 'genesis_after_content', 'frontpage_after_content' );

	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	remove_action( 'genesis_after_header', 'genesis_child_featured_banner', 10, 1 );
}

function frontpage_slider() {
	?>	<div class="featured-slider row"><?php
	if ( is_active_sidebar( 'slider' ) ) {
		genesis_widget_area('slider');
	}else{
		?><h4 class="widgettitle">Slider</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
	}
	?></div><?php
}

function frontpage_before_content() {
	?><div class="featured-1 content-row">
		<div class="wrap">
			<div class="row">
				<div class="col-md-4">
					<?php
					if (is_active_sidebar( 'sidebar-1' )) {
						genesis_widget_area( 'sidebar-1' );
					}else{
						?><h4 class="widgettitle">Home Widget 1</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
					}
					?>
				</div>
				<div class="col-md-4">
					<?php
					if (is_active_sidebar( 'sidebar-2' )) {
						genesis_widget_area( 'sidebar-2' );
					}else{
						?><h4 class="widgettitle">Home Widget 2</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
					}
					?>
				</div>
				<div class="col-md-4">
					<?php
					if (is_active_sidebar( 'sidebar-3' )) {
						genesis_widget_area( 'sidebar-3' );
					}else{
						?><h4 class="widgettitle">Home Widget 3</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
					}
					?>
				</div>
			</div>
		</div>
		</div><?php
	}

	function frontpage_after_content() {
		?><div class="featured-2 content-row">
			<div class="wrap">
				<div class="row">
					<div class="col-md-6">
						<?php
						if (is_active_sidebar( 'sidebar-4' )) {
							genesis_widget_area( 'sidebar-4' );
						}else{
							?><h4 class="widgettitle">Home Widget 4</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
						}
						?>
					</div>
					<div class="col-md-6">
						<?php
						if (is_active_sidebar( 'sidebar-5' )) {
							genesis_widget_area( 'sidebar-5' );
						} else {
							?><h4 class="widgettitle">Home Widget 5</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						<?php } ?>
					</div>
				</div>
			</div>
			</div><?php
		}


		genesis();