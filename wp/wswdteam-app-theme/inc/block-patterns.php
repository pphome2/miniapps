<?php

/**
 * wswdteam app theme blokkok
 */

function wswdtam_app_register_block_patterns() {
	$block_pattern_categories = array(
		'featured'              => array( 'label' => __( 'Featured', 'wswdtam_app' ) ),
		'footer'                => array( 'label' => __( 'Footers', 'wswdtam_app' ) ),
		'header'                => array( 'label' => __( 'Headers', 'wswdtam_app' ) ),
		'query'                 => array( 'label' => __( 'Query', 'wswdtam_app' ) ),
		'wswdtam_app_pages' => array( 'label' => __( 'Pages', 'wswdtam_app' ) ),
	);

	
	$block_pattern_categories = apply_filters( 'wswdtam_app_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'footer-default',
		'header-default',
		'hidden-404',
		'query-default',
	);


	$block_patterns = apply_filters( 'wswdtam_app_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );

		register_block_pattern(
			'wswdtam_app/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'wswdtam_app_register_block_patterns', 9 );
