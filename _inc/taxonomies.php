<?php

/*-------------------------------------------
	Taxonomies (if enabled)
---------------------------------------------*/

function amp_create_taxonomies() {

  // Globals
  global $amp_cpt_slug, $amp_tax, $amp_tax_name, $amp_tax_plur, $amp_tax_slug;

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		"name"              => _x( $amp_tax_plur ),
		"singular_name"     => _x( $amp_tax_name ),
		"search_items"      => __( "Search $amp_tax_plur" ),
		"all_items"         => __( "All $amp_tax_plur" ),
		"parent_item"       => __( "Parent $amp_tax_name" ),
		"parent_item_colon" => __( "Parent $amp_tax_name:" ),
		"edit_item"         => __( "Edit $amp_tax_name" ),
		"update_item"       => __( "Update $amp_tax_name" ),
		"add_new_item"      => __( "Add New $amp_tax_name" ),
		"new_item_name"     => __( "New $amp_tax_name Name" ),
		"menu_name"         => __( "$amp_tax_plur" ),
	);

	$args = array(
		"hierarchical"      => true,
		"labels"            => $labels,
		"show_ui"           => true,
		"show_admin_column" => true,
		"query_var"         => true,
		"rewrite"           => array( "slug" => "$amp_tax_slug" ),
	);

	register_taxonomy( "$amp_tax_slug", "$amp_cpt_slug", $args );
}
if($amp_tax_custom){
  add_action( "init", "amp_create_taxonomies", 0 );
}