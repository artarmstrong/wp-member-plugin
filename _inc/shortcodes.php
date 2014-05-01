<?php

/*-------------------------------------------
	Shortcodes
---------------------------------------------*/

// [amp-single id="12"]
function amp_single_func( $atts ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

	return "foo = {$foo}";
}
add_shortcode( 'amp-single', 'amp_single_func' );

// [amp-category name="Lodging"]
function amp_category_func( $atts ) {
	extract( shortcode_atts( array(
		'name' => ''
	), $atts ) );

	return "foo = {$foo}";
}
add_shortcode( 'amp-category', 'amp_category_func' );

// [amp-bestof]
function amp_bestof_func( $atts ) {
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts ) );

	return "foo = {$foo}";
}
add_shortcode( 'amp-bestof', 'amp_bestof_func' );