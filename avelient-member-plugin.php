<?php

/**
 * Plugin Name: WP Member Plugin
 * Plugin URI: http://avelient.co
 * Description: Plugin for displaying and saving information about multiple members on the site.
 * Version: 1.0
 * Author: Art Armstrong
 * Author URI: http://artarmstrong.com
 * Text Domain: wp-member-plugin
 * License: GPL2
 */

 /*  Copyright 2013  Art Armstrong  (email : me@artarmstrong.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*-------------------------------------------
	Global Variables
---------------------------------------------*/
global
  $amp_db_version,
  $amp_cpt_slug,
  $amp_cpt_name,
  $amp_cpt_name_plur,
  $amp_cpt_name_slug,
  $amp_cpt_tax,
  $amp_tax_custom,
  $amp_tax_name,
  $amp_tax_plur,
  $amp_tax_slug,
  $amp_cpt_tag;

$amp_db_version = "1.0";
$amp_cpt_slug   = "friday-harbor";   // Slug for custom post type url structure
$amp_cpt_name   = "Directory";    // Singular name for custom post type
$amp_cpt_plur   = "Directories";   // Plural name for custom post type
$amp_tax        = false;      // Use default categories
$amp_tax_custom = true;       // Use custom taxonomy
$amp_tax_name   = "Category";
$amp_tax_plur   = "Categories";
$amp_tax_slug   = "business";
$amp_tag        = false;      // Use default tags


/*-------------------------------------------
	Includes
---------------------------------------------*/
include( plugin_dir_path( __FILE__ ) . '_inc/activate_deactivate.php');
include( plugin_dir_path( __FILE__ ) . '_inc/scripts_styles.php');
include( plugin_dir_path( __FILE__ ) . '_inc/custom-post-type.php');
include( plugin_dir_path( __FILE__ ) . '_inc/meta-box.php');
include( plugin_dir_path( __FILE__ ) . '_inc/taxonomies.php');
include( plugin_dir_path( __FILE__ ) . '_inc/shortcodes.php');
