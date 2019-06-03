<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'genesis_404' );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

function genesis_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

		printf( '<h1>%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'This page is no longer available', 'genesis' ) ) );
		echo '<div class="entry-content">';

			if ( genesis_html5() ) :
				echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );
				get_search_form();

			else :
	?>
			<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), trailingslashit( home_url() ) ); ?></p>

	<?php
			endif; ?>


<?php
			echo '</div>';

		echo genesis_html5() ? '</article>' : '</div>';
}

remove_action( 'genesis_footer', 'mobilenesis_footer', 10 );
genesis();
