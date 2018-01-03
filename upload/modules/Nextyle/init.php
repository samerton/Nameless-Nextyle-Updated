<?php 
/*
 *	Made by Nexious
 *  https://nexious.net
 *  NamelessMC version 2.0.0-pr3
 *
 *  License: MIT
 *
 *  Nextyle for NamelessMC
 */

// Custom language
$nextyle_language = new Language(ROOT_PATH . '/modules/Nextyle/language');

// Define URLs which belong to this module
$pages->add('Nextyle', '/admin/nextyle', 'pages/nextyle.php');

// Add link to admin sidebar
if(!isset($admin_sidebar)) $admin_sidebar = array();
$admin_sidebar['nextyle'] = array(
	'title' => $nextyle_language->get('language', 'nextyle_title'),
	'url' => URL::build('/admin/nextyle')
);

// Get Nextyle theme settings
require(ROOT_PATH . '/modules/Nextyle/pages/getvariables.php');

$smarty->assign(array(
	'NEXTYLE_COLOR' => $nextyle_color,
	'NEXTYLE_LOGO' => $nextyle_logo
));