<?php

// Template name: Front Page
add_action( 'genesis_meta', 'sa_desktop_home_genesis_meta' );

// DECLARE THE WIDGETS
function sa_desktop_home_genesis_meta () {
	add_action( 'genesis_header_right', 'frontpage_header' );
	add_action( 'genesis_after_header', 'frontpage_slider' );
	add_action( 'genesis_before_content', 'frontpage_before_content' );

	/* The loop goes here*/
  // Remove posts.
  remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_after_content', 'frontpage_after_content' );

	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	remove_action( 'genesis_after_header', 'genesis_child_featured_banner', 10, 1 );
}

function frontpage_header() {
	?>
	<section id="menu-button-section" class="pull-right">
		<button id="menu-button" onclick="document.querySelector('.nav-primary').classList.add('shown')"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>
	</section>
	<?php
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
	?>
	<div class="featured-1 content-row">
		<div class="wrap">
			<div class="row featured-1__description">
				<?php
				if (is_active_sidebar( 'sidebar-1' )) {
					genesis_widget_area( 'sidebar-1' );
				}else{
					?>
					<div class="col-md-12">
						<h4 class="widgettitle">Home Widget 1</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
					</div><?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="featured-2-3 no-padding">
		<div class="wrap">
			<div class="row featured-2-3__doctors">
				<div class="col-md-5 col-md-offset-1">
					<?php
					if (is_active_sidebar( 'sidebar-2' )) {
						genesis_widget_area( 'sidebar-2' );
					}else{
						?><h4 class="widgettitle">Home Widget 2</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p><?php
					}
					?>
				</div>
				<div class="col-md-5">
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
		?>
		<div class="featured-4 content-row">
			<div class="wrap">
				<div class="row featured-4__description">
					<?php
					if (is_active_sidebar( 'sidebar-4' )) {
						genesis_widget_area( 'sidebar-4' );
					}else{
						?>
						<div class="col-md-12">
							<h4 class="widgettitle">Home Widget 1</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						</div><?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="sub-menus">
			<div class="row no-padding relative-row">
				<div class="col-md-3 col-sm-6">
					<img src="<?php echo get_stylesheet_directory_uri('template_url') ?>/assets/img/procdure-face-1.jpg" alt="" class="img-responsive">
					<h5>FACE</h5>
				</div>
				<div class="col-md-3 col-sm-6">
					<img src="<?php echo get_stylesheet_directory_uri('template_url') ?>/assets/img/procedure-nose-1.jpg" alt="" class="img-responsive">
					<h5>NON INVASIVE</h5>
				</div>
				<div class="col-md-3 col-sm-6">
					<img src="<?php echo get_stylesheet_directory_uri('template_url') ?>/assets/img/procedure-breasts-1.jpg" alt="" class="img-responsive">
					<h5>BREAST</h5>
				</div>
				<div class="col-md-3 col-sm-6">
					<img src="<?php echo get_stylesheet_directory_uri('template_url') ?>/assets/img/procedure-body-1.jpg" alt="" class="img-responsive">
					<h5>BODY</h5>
				</div>
			</div>
		</div>
		<div class="featured-5 content-row">
			<div class="wrap">
				<div class="row featured-4__description">
					<?php
					if (is_active_sidebar( 'sidebar-5' )) {
						genesis_widget_area( 'sidebar-5' );
					} else {
						?>
						<div class="col-md-6">
							<h4 class="widgettitle">Home Widget 5</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit consectetur tellus. Quisque vitae consequat lectus. Nullam a nibh gravida, cursus justo vitae, varius justo.</p>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="gallery-wrap">
			<div class="row no-padding relative-row">
				<div class="col-md-12">
					<div class="gallery-bg-container" style="background-image: url('/wp-content/themes/sa-theme/assets/img/bg-gallery-1.jpg')">
						<h3 id="explore-gallery">Explore Gallery</h3>
						<img src="<?php echo get_stylesheet_directory_uri('template_url') ?>/assets/img/model-miami.png" alt="" class="img-responsive" id="explore-gallery__model">
						<button id="explore-gallery__button">Explore Now</button>
					</div>
				</div>
			</div>
		</div>
		<div class="featured-6 content-row">
			<div class="wrap">
				<div class="row featured-4__description">
					<?php
					if (is_active_sidebar( 'footer-1' )) {
						genesis_widget_area( 'footer-1' );
					} else {
						?>
						<div class="col-md-6">
							<h4 class="widgettitle">Footer 1</h4>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="testimonials-wrap">
			<div class="row no-padding relative-row">
				<div class="col-md-12">
					<div class="testimonials-bg-container" style="background-image: url('/wp-content/themes/sa-theme/assets/img/bg-reviews.jpg')">
						<div id="testimonial__content">
							<h4 id="testimonials__title">SEE WHAT OUR PATIENTS SAY ABOUT US</h4>
							<blockquote>
								<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque dolores delectus quisquam, voluptatum praesentium culpa aliquid eligendi deserunt, accusamus deleniti hic ut eaque, obcaecati cum? Asperiores dolores quos tempora perspiciatis!</div>
								<div>Expedita consequuntur vitae quia, cum blanditiis quaerat sit reprehenderit veritatis nemo cupiditate officia ea magnam, hic voluptas libero illum facere tempora similique, enim. Nobis sed voluptatibus cupiditate accusamus porro expedita.</div>
								<a href="#">more</a>
							</blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	genesis();
