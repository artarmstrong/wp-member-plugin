<?php

/*-------------------------------------------
	Custom Meta Box
---------------------------------------------*/
add_action( 'add_meta_boxes', 'amp_custom_meta_box_add' );
add_action( 'save_post', 'amp_custom_meta_box_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function amp_custom_meta_box_add() {

  // Globals
  global $amp_cpt_slug;

  add_meta_box(
    "amp_general_information",
    __( "General Information", "wp-member-plugin" ),
    "amp_custom_meta_general_information",
    "$amp_cpt_slug",
    "normal",
    "high"
  );

  add_meta_box(
    "amp_social_media",
    __( "Social Media", "wp-member-plugin" ),
    "amp_custom_meta_social_media",
    "$amp_cpt_slug",
    "normal",
    "high"
  );

}

/* When the post is saved, saves our custom data */
function amp_custom_meta_box_save( $post_id ) {

	// Check if its an autosave, if so, do nothing
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// Verify this came from the our screen and with proper authorization,
	if ( isset($_POST['amp_noncename']) && !wp_verify_nonce( $_POST['amp_noncename'], basename( __FILE__ ) ) )
	  return;

	// Check permissions
	if ( !current_user_can( 'edit_post', $post_id ) )
    return;

	// General Information
	$amp_latitude  = (isset($_POST['amp_latitude']) ? $_POST['amp_latitude'] : "");
	$amp_longitude = (isset($_POST['amp_longitude']) ? $_POST['amp_longitude'] : "");
	$amp_address   = (isset($_POST['amp_address']) ? $_POST['amp_address'] : "");
	$amp_city      = (isset($_POST['amp_city']) ? $_POST['amp_city'] : "");
	$amp_state     = (isset($_POST['amp_state']) ? $_POST['amp_state'] : "");
	$amp_zip       = (isset($_POST['amp_zip']) ? $_POST['amp_zip'] : "");
	$amp_phone     = (isset($_POST['amp_phone']) ? $_POST['amp_phone'] : "");
	$amp_fax       = (isset($_POST['amp_fax']) ? $_POST['amp_fax'] : "");
	$amp_email     = (isset($_POST['amp_email']) ? $_POST['amp_email'] : "");
	$amp_website   = (isset($_POST['amp_website']) ? $_POST['amp_website'] : "");
	$amp_license   = (isset($_POST['amp_license']) ? $_POST['amp_license'] : "");
	$amp_languages = (isset($_POST['amp_languages']) ? $_POST['amp_languages'] : "");
	$amp_services  = (isset($_POST['amp_services']) ? $_POST['amp_services'] : "");
	$amp_hours     = (isset($_POST['amp_hours']) ? $_POST['amp_hours'] : "");
	update_post_meta($post_id, 'amp_latitude',   $amp_latitude);
	update_post_meta($post_id, 'amp_longitude',  $amp_longitude);
	update_post_meta($post_id, 'amp_address',    $amp_address);
	update_post_meta($post_id, 'amp_city',       $amp_city);
	update_post_meta($post_id, 'amp_state',      $amp_state);
	update_post_meta($post_id, 'amp_zip',        $amp_zip);
	update_post_meta($post_id, 'amp_phone',      $amp_phone);
	update_post_meta($post_id, 'amp_fax',        $amp_fax);
	update_post_meta($post_id, 'amp_email',      $amp_email);
	update_post_meta($post_id, 'amp_website',    $amp_website);
	update_post_meta($post_id, 'amp_license',    $amp_license);
	update_post_meta($post_id, 'amp_languages',  $amp_languages);
	update_post_meta($post_id, 'amp_services',   $amp_services);
	update_post_meta($post_id, 'amp_hours',      $amp_hours);

	// Social Media
	$amp_facebook   = (isset($_POST['amp_facebook']) ? $_POST['amp_facebook'] : "");
	$amp_twitter    = (isset($_POST['amp_twitter']) ? $_POST['amp_twitter'] : "");
	$amp_googleplus = (isset($_POST['amp_googleplus']) ? $_POST['amp_googleplus'] : "");
	update_post_meta($post_id, 'amp_facebook',   $amp_facebook);
	update_post_meta($post_id, 'amp_twitter',    $amp_twitter);
	update_post_meta($post_id, 'amp_googleplus', $amp_googleplus);

  // Return
	return;

}

/* Prints the box content */
function amp_custom_meta_general_information( $post ) {

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'amp_noncename' );

	// Fields
	?>
	<div style="float:left;" class="amp_form">

		<table>
			<tr>
				<td width="120" style="padding: 5px 15px" valign="middle">
					<label>Lat / Long</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_latitude" name="amp_latitude" style="width:100px;" value="<?= get_post_meta($post->ID, 'amp_latitude', true); ?>" /> / <input type="text" id="amp_longitude" name="amp_longitude" style="width:100px;" value="<?= get_post_meta($post->ID, 'amp_longitude', true); ?>" /> (<a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Lat/Long Finder</a>)
				</td>
			</tr>
			<tr>
				<td style="padding: 5px 15px" valign="middle">
					<label>Street Address *</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_address" name="amp_address" style="width:354px;" value="<?= get_post_meta($post->ID, 'amp_address', true); ?>" />
				</td>
			</tr>
			<tr>
				<td style="padding:5px 15px" valign="middle">
					<label>City, State, Zip *</label>
				</td>
				<td>
				  <input type="text" id="amp_city" name="amp_city" style="width:200px;" value="<?= get_post_meta($post->ID, 'amp_city', true); ?>" />
				</td>
				<td>
				  <select name="amp_state" id="amp_state" style="width:55px;">
            <option value="AK" <?= (get_post_meta($post->ID, 'amp_state', true) == "AK" ? "selected" : ""); ?>>AK</option>
            <option value="AL" <?= (get_post_meta($post->ID, 'amp_state', true) == "AL" ? "selected" : ""); ?>>AL</option>
            <option value="AR" <?= (get_post_meta($post->ID, 'amp_state', true) == "AR" ? "selected" : ""); ?>>AR</option>
            <option value="AZ" <?= (get_post_meta($post->ID, 'amp_state', true) == "AZ" ? "selected" : ""); ?>>AZ</option>
            <option value="CA" <?= (get_post_meta($post->ID, 'amp_state', true) == "CA" ? "selected" : ""); ?>>CA</option>
            <option value="CO" <?= (get_post_meta($post->ID, 'amp_state', true) == "CO" ? "selected" : ""); ?>>CO</option>
            <option value="CT" <?= (get_post_meta($post->ID, 'amp_state', true) == "CT" ? "selected" : ""); ?>>CT</option>
            <option value="DC" <?= (get_post_meta($post->ID, 'amp_state', true) == "DC" ? "selected" : ""); ?>>DC</option>
            <option value="DE" <?= (get_post_meta($post->ID, 'amp_state', true) == "DE" ? "selected" : ""); ?>>DE</option>
            <option value="FL" <?= (get_post_meta($post->ID, 'amp_state', true) == "FL" ? "selected" : ""); ?>>FL</option>
            <option value="GA" <?= (get_post_meta($post->ID, 'amp_state', true) == "GA" ? "selected" : ""); ?>>GA</option>
            <option value="HI" <?= (get_post_meta($post->ID, 'amp_state', true) == "HI" ? "selected" : ""); ?>>HI</option>
            <option value="IA" <?= (get_post_meta($post->ID, 'amp_state', true) == "IA" ? "selected" : ""); ?>>IA</option>
            <option value="ID" <?= (get_post_meta($post->ID, 'amp_state', true) == "ID" ? "selected" : ""); ?>>ID</option>
            <option value="IL" <?= (get_post_meta($post->ID, 'amp_state', true) == "IL" ? "selected" : ""); ?>>IL</option>
            <option value="IN" <?= (get_post_meta($post->ID, 'amp_state', true) == "IN" ? "selected" : ""); ?>>IN</option>
            <option value="KS" <?= (get_post_meta($post->ID, 'amp_state', true) == "KS" ? "selected" : ""); ?>>KS</option>
            <option value="KY" <?= (get_post_meta($post->ID, 'amp_state', true) == "KY" ? "selected" : ""); ?>>KY</option>
            <option value="LA" <?= (get_post_meta($post->ID, 'amp_state', true) == "LA" ? "selected" : ""); ?>>LA</option>
            <option value="MA" <?= (get_post_meta($post->ID, 'amp_state', true) == "MA" ? "selected" : ""); ?>>MA</option>
            <option value="MD" <?= (get_post_meta($post->ID, 'amp_state', true) == "MD" ? "selected" : ""); ?>>MD</option>
            <option value="ME" <?= (get_post_meta($post->ID, 'amp_state', true) == "ME" ? "selected" : ""); ?>>ME</option>
            <option value="MI" <?= (get_post_meta($post->ID, 'amp_state', true) == "MI" ? "selected" : ""); ?>>MI</option>
            <option value="MN" <?= (get_post_meta($post->ID, 'amp_state', true) == "MN" ? "selected" : ""); ?>>MN</option>
            <option value="MO" <?= (get_post_meta($post->ID, 'amp_state', true) == "MO" ? "selected" : ""); ?>>MO</option>
            <option value="MS" <?= (get_post_meta($post->ID, 'amp_state', true) == "MS" ? "selected" : ""); ?>>MS</option>
            <option value="MT" <?= (get_post_meta($post->ID, 'amp_state', true) == "MT" ? "selected" : ""); ?>>MT</option>
            <option value="NC" <?= (get_post_meta($post->ID, 'amp_state', true) == "NC" ? "selected" : ""); ?>>NC</option>
            <option value="ND" <?= (get_post_meta($post->ID, 'amp_state', true) == "ND" ? "selected" : ""); ?>>ND</option>
            <option value="NE" <?= (get_post_meta($post->ID, 'amp_state', true) == "NE" ? "selected" : ""); ?>>NE</option>
            <option value="NH" <?= (get_post_meta($post->ID, 'amp_state', true) == "NH" ? "selected" : ""); ?>>NH</option>
            <option value="NJ" <?= (get_post_meta($post->ID, 'amp_state', true) == "NJ" ? "selected" : ""); ?>>NJ</option>
            <option value="NM" <?= (get_post_meta($post->ID, 'amp_state', true) == "NM" ? "selected" : ""); ?>>NM</option>
            <option value="NV" <?= (get_post_meta($post->ID, 'amp_state', true) == "NV" ? "selected" : ""); ?>>NV</option>
            <option value="NY" <?= (get_post_meta($post->ID, 'amp_state', true) == "NY" ? "selected" : ""); ?>>NY</option>
            <option value="OH" <?= (get_post_meta($post->ID, 'amp_state', true) == "OH" ? "selected" : ""); ?>>OH</option>
            <option value="OK" <?= (get_post_meta($post->ID, 'amp_state', true) == "OK" ? "selected" : ""); ?>>OK</option>
            <option value="OR" <?= (get_post_meta($post->ID, 'amp_state', true) == "OR" ? "selected" : ""); ?>>OR</option>
            <option value="PA" <?= (get_post_meta($post->ID, 'amp_state', true) == "PA" ? "selected" : ""); ?>>PA</option>
            <option value="RI" <?= (get_post_meta($post->ID, 'amp_state', true) == "RI" ? "selected" : ""); ?>>RI</option>
            <option value="SC" <?= (get_post_meta($post->ID, 'amp_state', true) == "SC" ? "selected" : ""); ?>>SC</option>
            <option value="SD" <?= (get_post_meta($post->ID, 'amp_state', true) == "SD" ? "selected" : ""); ?>>SD</option>
            <option value="TN" <?= (get_post_meta($post->ID, 'amp_state', true) == "TN" ? "selected" : ""); ?>>TN</option>
            <option value="TX" <?= (get_post_meta($post->ID, 'amp_state', true) == "TX" ? "selected" : ""); ?>>TX</option>
            <option value="UT" <?= (get_post_meta($post->ID, 'amp_state', true) == "UT" ? "selected" : ""); ?>>UT</option>
            <option value="VA" <?= (get_post_meta($post->ID, 'amp_state', true) == "VA" ? "selected" : ""); ?>>VA</option>
            <option value="VT" <?= (get_post_meta($post->ID, 'amp_state', true) == "VT" ? "selected" : ""); ?>>VT</option>
            <option value="WA" <?= (get_post_meta($post->ID, 'amp_state', true) == "WA" ? "selected" : ""); ?>>WA</option>
            <option value="WI" <?= (get_post_meta($post->ID, 'amp_state', true) == "WI" ? "selected" : ""); ?>>WI</option>
            <option value="WV" <?= (get_post_meta($post->ID, 'amp_state', true) == "WV" ? "selected" : ""); ?>>WV</option>
            <option value="WY" <?= (get_post_meta($post->ID, 'amp_state', true) == "WY" ? "selected" : ""); ?>>WY</option>
          </select>
				</td>
				<td>
				  <input type="text" id="amp_zip" name="amp_zip" style="width:90px;" value="<?= get_post_meta($post->ID, 'amp_zip', true); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Phone *</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_phone" name="amp_phone" style="width:150px;" value="<?= get_post_meta($post->ID, 'amp_phone', true); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Fax</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_fax" name="amp_fax" style="width:150px;" value="<?= get_post_meta($post->ID, 'amp_fax', true); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Email *</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_email" name="amp_email" style="width:250px;" value="<?= get_post_meta($post->ID, 'amp_email', true); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Website / Profile</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_website" name="amp_website" style="width:300px;" value="<?= get_post_meta($post->ID, 'amp_website', true); ?>" placeholder="http://" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Business License</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_license" name="amp_license" style="width:300px;" value="<?= get_post_meta($post->ID, 'amp_license', true); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Language</label>
				</td>
				<td colspan="3">
				  <?php
				  // Languages field
				  $amp_languages_array = get_post_meta($post->ID, 'amp_languages', true);
				  ?>
					<select id="amp_languages" name="amp_languages[]" multiple placeholder="Select languages..." style="width:300px;" class="selectize">
            <option value="Afrikaans" <?= (in_array("Afrikaans", $amp_languages_array) ? "selected" : ""); ?>>Afrikaans</option>
            <option value="Albanian" <?= (in_array("Albanian", $amp_languages_array) ? "selected" : ""); ?>>Albanian</option>
            <option value="Arabic" <?= (in_array("Arabic", $amp_languages_array) ? "selected" : ""); ?>>Arabic</option>
            <option value="Armenian" <?= (in_array("Armenian", $amp_languages_array) ? "selected" : ""); ?>>Armenian</option>
            <option value="Basque" <?= (in_array("Basque", $amp_languages_array) ? "selected" : ""); ?>>Basque</option>
            <option value="Bengali" <?= (in_array("Bengali", $amp_languages_array) ? "selected" : ""); ?>>Bengali</option>
            <option value="Bulgarian" <?= (in_array("Bulgarian", $amp_languages_array) ? "selected" : ""); ?>>Bulgarian</option>
            <option value="Catalan" <?= (in_array("Catalan", $amp_languages_array) ? "selected" : ""); ?>>Catalan</option>
            <option value="Cambodian" <?= (in_array("Cambodian", $amp_languages_array) ? "selected" : ""); ?>>Cambodian</option>
            <option value="Chinese (Mandarin)" <?= (in_array("Chinese (Mandarin)", $amp_languages_array) ? "selected" : ""); ?>>Chinese (Mandarin)</option>
            <option value="Croatian" <?= (in_array("Croatian", $amp_languages_array) ? "selected" : ""); ?>>Croatian</option>
            <option value="Czech" <?= (in_array("Czech", $amp_languages_array) ? "selected" : ""); ?>>Czech</option>
            <option value="Danish" <?= (in_array("Danish", $amp_languages_array) ? "selected" : ""); ?>>Danish</option>
            <option value="Dutch" <?= (in_array("Dutch", $amp_languages_array) ? "selected" : ""); ?>>Dutch</option>
            <option value="English" <?= (in_array("English", $amp_languages_array) ? "selected" : ""); ?>>English</option>
            <option value="Estonian" <?= (in_array("Estonian", $amp_languages_array) ? "selected" : ""); ?>>Estonian</option>
            <option value="Fiji" <?= (in_array("Fiji", $amp_languages_array) ? "selected" : ""); ?>>Fiji</option>
            <option value="Finnish" <?= (in_array("Finnish", $amp_languages_array) ? "selected" : ""); ?>>Finnish</option>
            <option value="French" <?= (in_array("French", $amp_languages_array) ? "selected" : ""); ?>>French</option>
            <option value="Georgian" <?= (in_array("Georgian", $amp_languages_array) ? "selected" : ""); ?>>Georgian</option>
            <option value="German" <?= (in_array("German", $amp_languages_array) ? "selected" : ""); ?>>German</option>
            <option value="Greek" <?= (in_array("Greek", $amp_languages_array) ? "selected" : ""); ?>>Greek</option>
            <option value="Gujarati" <?= (in_array("Gujarati", $amp_languages_array) ? "selected" : ""); ?>>Gujarati</option>
            <option value="Hebrew" <?= (in_array("Hebrew", $amp_languages_array) ? "selected" : ""); ?>>Hebrew</option>
            <option value="Hindi" <?= (in_array("Hindi", $amp_languages_array) ? "selected" : ""); ?>>Hindi</option>
            <option value="Hungarian" <?= (in_array("Hungarian", $amp_languages_array) ? "selected" : ""); ?>>Hungarian</option>
            <option value="Icelandic" <?= (in_array("Icelandic", $amp_languages_array) ? "selected" : ""); ?>>Icelandic</option>
            <option value="Indonesian" <?= (in_array("Indonesian", $amp_languages_array) ? "selected" : ""); ?>>Indonesian</option>
            <option value="Irish" <?= (in_array("Irish", $amp_languages_array) ? "selected" : ""); ?>>Irish</option>
            <option value="Italian" <?= (in_array("Italian", $amp_languages_array) ? "selected" : ""); ?>>Italian</option>
            <option value="Japanese" <?= (in_array("Japanese", $amp_languages_array) ? "selected" : ""); ?>>Japanese</option>
            <option value="Javanese" <?= (in_array("Javanese", $amp_languages_array) ? "selected" : ""); ?>>Javanese</option>
            <option value="Korean" <?= (in_array("Korean", $amp_languages_array) ? "selected" : ""); ?>>Korean</option>
            <option value="Latin" <?= (in_array("Latin", $amp_languages_array) ? "selected" : ""); ?>>Latin</option>
            <option value="Latvian" <?= (in_array("Latvian", $amp_languages_array) ? "selected" : ""); ?>>Latvian</option>
            <option value="Lithuanian" <?= (in_array("Lithuanian", $amp_languages_array) ? "selected" : ""); ?>>Lithuanian</option>
            <option value="Macedonian" <?= (in_array("Macedonian", $amp_languages_array) ? "selected" : ""); ?>>Macedonian</option>
            <option value="Malay" <?= (in_array("Malay", $amp_languages_array) ? "selected" : ""); ?>>Malay</option>
            <option value="Malayalam" <?= (in_array("Malayalam", $amp_languages_array) ? "selected" : ""); ?>>Malayalam</option>
            <option value="Maltese" <?= (in_array("Maltese", $amp_languages_array) ? "selected" : ""); ?>>Maltese</option>
            <option value="Maori" <?= (in_array("Maori", $amp_languages_array) ? "selected" : ""); ?>>Maori</option>
            <option value="Marathi" <?= (in_array("Marathi", $amp_languages_array) ? "selected" : ""); ?>>Marathi</option>
            <option value="Mongolian" <?= (in_array("Mongolian", $amp_languages_array) ? "selected" : ""); ?>>Mongolian</option>
            <option value="Nepali" <?= (in_array("Nepali", $amp_languages_array) ? "selected" : ""); ?>>Nepali</option>
            <option value="Norwegian" <?= (in_array("Norwegian", $amp_languages_array) ? "selected" : ""); ?>>Norwegian</option>
            <option value="Persian" <?= (in_array("Persian", $amp_languages_array) ? "selected" : ""); ?>>Persian</option>
            <option value="Polish" <?= (in_array("Polish", $amp_languages_array) ? "selected" : ""); ?>>Polish</option>
            <option value="Portuguese" <?= (in_array("Portuguese", $amp_languages_array) ? "selected" : ""); ?>>Portuguese</option>
            <option value="Punjabi" <?= (in_array("Punjabi", $amp_languages_array) ? "selected" : ""); ?>>Punjabi</option>
            <option value="Quechua" <?= (in_array("Quechua", $amp_languages_array) ? "selected" : ""); ?>>Quechua</option>
            <option value="Romanian" <?= (in_array("Romanian", $amp_languages_array) ? "selected" : ""); ?>>Romanian</option>
            <option value="Russian" <?= (in_array("Russian", $amp_languages_array) ? "selected" : ""); ?>>Russian</option>
            <option value="Samoan" <?= (in_array("Samoan", $amp_languages_array) ? "selected" : ""); ?>>Samoan</option>
            <option value="Serbian" <?= (in_array("Serbian", $amp_languages_array) ? "selected" : ""); ?>>Serbian</option>
            <option value="Slovak" <?= (in_array("Slovak", $amp_languages_array) ? "selected" : ""); ?>>Slovak</option>
            <option value="Slovenian" <?= (in_array("Slovenian", $amp_languages_array) ? "selected" : ""); ?>>Slovenian</option>
            <option value="Spanish" <?= (in_array("Spanish", $amp_languages_array) ? "selected" : ""); ?>>Spanish</option>
            <option value="Swahili" <?= (in_array("Swahili", $amp_languages_array) ? "selected" : ""); ?>>Swahili</option>
            <option value="Swedish " <?= (in_array("Swedish ", $amp_languages_array) ? "selected" : ""); ?>>Swedish </option>
            <option value="Tamil" <?= (in_array("Tamil", $amp_languages_array) ? "selected" : ""); ?>>Tamil</option>
            <option value="Tatar" <?= (in_array("Tatar", $amp_languages_array) ? "selected" : ""); ?>>Tatar</option>
            <option value="Telugu" <?= (in_array("Telugu", $amp_languages_array) ? "selected" : ""); ?>>Telugu</option>
            <option value="Thai" <?= (in_array("Thai", $amp_languages_array) ? "selected" : ""); ?>>Thai</option>
            <option value="Tibetan" <?= (in_array("Tibetan", $amp_languages_array) ? "selected" : ""); ?>>Tibetan</option>
            <option value="Tonga" <?= (in_array("Tonga", $amp_languages_array) ? "selected" : ""); ?>>Tonga</option>
            <option value="Turkish" <?= (in_array("Turkish", $amp_languages_array) ? "selected" : ""); ?>>Turkish</option>
            <option value="Ukrainian" <?= (in_array("Ukrainian", $amp_languages_array) ? "selected" : ""); ?>>Ukrainian</option>
            <option value="Urdu" <?= (in_array("Urdu", $amp_languages_array) ? "selected" : ""); ?>>Urdu</option>
            <option value="Uzbek" <?= (in_array("Uzbek", $amp_languages_array) ? "selected" : ""); ?>>Uzbek</option>
            <option value="Vietnamese" <?= (in_array("Vietnamese", $amp_languages_array) ? "selected" : ""); ?>>Vietnamese</option>
            <option value="Welsh" <?= (in_array("Welsh", $amp_languages_array) ? "selected" : ""); ?>>Welsh</option>
            <option value="Xhosa" <?= (in_array("Xhosa", $amp_languages_array) ? "selected" : ""); ?>>Xhosa</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Insurance Services</label>
				</td>
				<td colspan="3">
				  <?php
				  // Services field
				  $amp_services_array = get_post_meta($post->ID, 'amp_services', true);
				  ?>
					<select id="amp_services" name="amp_services[]" multiple placeholder="Select services..." style="width:300px;" class="selectize">
            <option value="Auto / Vehicle / ATV" <?= (in_array("Auto / Vehicle / ATV", $amp_services_array) ? "selected" : ""); ?>>Auto / Vehicle / ATV</option>
            <option value="Home" <?= (in_array("Home", $amp_services_array) ? "selected" : ""); ?>>Home</option>
            <option value="Rentors" <?= (in_array("Rentors", $amp_services_array) ? "selected" : ""); ?>>Rentors</option>
            <option value="Health" <?= (in_array("Health", $amp_services_array) ? "selected" : ""); ?>>Health</option>
            <option value="Life" <?= (in_array("Life", $amp_services_array) ? "selected" : ""); ?>>Life</option>
            <option value="Business" <?= (in_array("Business", $amp_services_array) ? "selected" : ""); ?>>Business</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="top">
					<label>Hours</label>
					<br />
					<small>Put each new hour set on a new line.</small>
				</td>
				<td colspan="3">
					<textarea id="amp_hours" name="amp_hours" style="width:300px;height:100px;" placeholder="Mon-Fri: 9am-5pm"><?= get_post_meta($post->ID, 'amp_hours', true); ?></textarea>
				</td>
			</tr>
		</table>

	</div>
	<div style="clear:both;"></div>
	<?php
}

/* Prints the social media box content */
function amp_custom_meta_social_media( $post ) {

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'amp_noncename' );

	// Fields
	?>
	<div style="float:left;" class="amp_form">

		<table>
			<tr>
				<td width="120" style="padding: 5px 15px" valign="middle">
					<label>Facebook</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_facebook" name="amp_facebook" style="width:350px;" value="<?= get_post_meta($post->ID, 'amp_facebook', true); ?>" placeholder="http://" />
				</td>
			</tr>
			<tr>
				<td style="padding: 5px 15px" valign="middle">
					<label>Twitter</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_twitter" name="amp_twitter" style="width:350px;" value="<?= get_post_meta($post->ID, 'amp_twitter', true); ?>" placeholder="http://" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Google+</label>
				</td>
				<td colspan="3">
					<input type="text" id="amp_googleplus" name="amp_googleplus" style="width:350px;" value="<?= get_post_meta($post->ID, 'amp_googleplus', true); ?>" placeholder="http://" />
				</td>
			</tr>
		</table>

	</div>
	<div style="clear:both;"></div>
	<?php
}