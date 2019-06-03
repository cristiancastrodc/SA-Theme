<?php 

// Init CMB2 framework
add_action( 'init', 'genesis_child_init_cmb2', 10, 1 );
function genesis_child_init_cmb2() {
	if ( file_exists( get_stylesheet_directory() . '/includes/lib/cmb2/init.php' ) ) {
		require_once get_stylesheet_directory() . '/includes/lib/cmb2/init.php';
	}
}

// Add custom metaboxes for banner section
add_action( 'cmb2_init', 'add_featured_banner_metabox' );
function add_featured_banner_metabox() {

	$prefix = '_gcfb_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'featured-banner',
		'title'        => __( 'Featured Banner', 'cmb2' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable Banner', 'cmb2' ),
		'id' => $prefix . 'enable',
		'type' => 'checkbox',
	) );

	$cmb->add_field( array(
		'name'	=> 	__('Image', 'cmb2'),
		'desc'	=>	'Upload an image',
		'id'	=>	$prefix.'image',
		'type'	=>	'file',
		'text'	=>	array(
			'add_upload_file_text'	=>	'Add Image'
		),
		'query_args'	=>	array(
			'type'	=> array(
				'image/gif',
				'image/jpeg',
				'image/png'
			),
		),
		'preview_size'	=>	'small',
	));

	$cmb->add_field( array(
		'name' => __( 'Featured banner description', 'cmb2' ),
		'id' => $prefix . 'description',
		'type' => 'textarea',
	) );

	$cmb->add_field( array(
		'name' => __( 'Call to action text', 'cmb2' ),
		'id' => $prefix . 'ctcT',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Call to action URL', 'cmb2' ),
		'id' => $prefix . 'ctc',
		'type' => 'text_url',
	) );
}

?>