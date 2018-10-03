<?php 
/*
 *	Made by Nexious
 *  https://nexious.net
 *  NamelessMC version 2.0.0-pr5
 *
 *  License: MIT
 *
 *  Nextyle for NamelessMC
 */

// Custom language
$nextyle_language = new Language(ROOT_PATH . '/modules/Nextyle/language', LANGUAGE);

// Add link to admin sidebar - temp
if(!isset($admin_sidebar)) $admin_sidebar = array();
$admin_sidebar['nextyle'] = array(
	'title' => $nextyle_language->get('language', 'nextyle_title'),
	'url' => URL::build('/admin/nextyle')
);

require_once(ROOT_PATH . '/modules/Nextyle/module.php');
$module = new Nextyle_Module($pages, $language, $nextyle_language);