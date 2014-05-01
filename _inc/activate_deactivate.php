<?php

/*-------------------------------------------
	Activate / Deactivate
---------------------------------------------*/

function amp_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'amp_activate' );

function amp_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'amp_deactivate' );