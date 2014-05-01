<?php

/*-------------------------------------------
	Custom Post Type
---------------------------------------------*/

function amp_create_post_type() {

  // Globals
  global $amp_cpt_slug, $amp_cpt_name, $amp_cpt_plur, $amp_tax, $amp_tag;

  // Labels
  $labels = array(
    "name"               => $amp_cpt_plur,
    "singular_name"      => $amp_cpt_name,
    "add_new"            => "Add New",
    "add_new_item"       => "Add New $amp_cpt_name",
    "edit_item"          => "Edit $amp_cpt_name",
    "new_item"           => "New $amp_cpt_name",
    "all_items"          => "View All",
    "view_item"          => "View $amp_cpt_name",
    "search_items"       => "Search ".$amp_cpt_plur,
    "not_found"          => "No $amp_cpt_slug found",
    "not_found_in_trash" => "No $amp_cpt_slug found in Trash",
    "parent_item_colon"  => "",
    "menu_name"          => $amp_cpt_name
  );

  // Args
  $args = array(
    "labels"             => $labels,
    "public"             => true,
    "publicly_queryable" => true,
    "show_ui"            => true,
    "show_in_menu"       => true,
    "query_var"          => true,
    "rewrite"            => array( "slug" => "$amp_cpt_slug" ),
    "capability_type"    => "post",
    "has_archive"        => true,
    "hierarchical"       => false,
    "menu_position"      => null,
    "supports"           => array( "title", "editor", "thumbnail", "excerpt" ),
  );

  // Add taxonomies/tags if set to true
  $amp_tax_tag_array = array();
  if($amp_tax)
    $amp_tax_tag_array[] = 'category';
  if($amp_tag)
    $amp_tax_tag_array[] = 'post_tag';
  $args["taxonomies"] = $amp_tax_tag_array;

  // Register
  register_post_type( "$amp_cpt_slug", $args );

}
add_action( 'init', 'amp_create_post_type' );