<?php

/*-------------------------------------------
	Scripts / Styles
---------------------------------------------*/

add_action('admin_init','amp_load_scripts_styles');
function amp_load_scripts_styles() {

  // Globals
  global $pagenow, $typenow, $amp_cpt_slug;

  // Check if we have typenow and post
  if (empty($typenow) && !empty($_GET['post'])) {
    $post = get_post($_GET['post']);
    $typenow = $post->post_type;
  }

  // Check pagenow and custom post type
  if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php') && $typenow==$amp_cpt_slug) {
    wp_enqueue_script('jquery');
    wp_enqueue_script('amp_custom_js_selectize', plugins_url( '/_js/selectize.js', dirname(__FILE__) ), array('jquery'));
    wp_enqueue_script('amp_custom_js_docready', plugins_url( '/_js/jquery.docready.js', dirname(__FILE__) ), array('jquery'));
    wp_enqueue_style('amp_custom_css_selectize', plugins_url( '/_css/selectize.css', dirname(__FILE__) ));
    wp_enqueue_style('amp_custom_css', plugins_url( '/_css/custom.css', dirname(__FILE__) ));
  }

}