<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/
 *  NamelessMC version 2.0.0-pr5
 *
 *  License: MIT
 *
 *  Panel Nextyle page
 */

// Can the user view the panel?
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		// No
		Redirect::to(URL::build('/'));
		die();
	}
	if(!$user->isAdmLoggedIn()){
		// Needs to authenticate
		Redirect::to(URL::build('/panel/auth'));
		die();
	} else {
		if($user->data()->group_id != 2 && !$user->hasPermission('admincp.nextyle')){
			require_once(ROOT_PATH . '/404.php');
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}

define('PAGE', 'panel');
define('PARENT_PAGE', 'nextyle');
define('PANEL_PAGE', 'nextyle');
$page_title = $nextyle_language->get('language', 'nextyle_title');
require_once(ROOT_PATH . '/core/templates/backend_init.php');

if(isset($_POST['view'])){
	if(Token::check(Input::get('token'))){
		$view = $_POST['view']; $getTheme = $_POST['theme']; $getBG = $_POST['bg']; $getLOGO = $_POST['logo'];
	} else
		$errors = array($language->get('general', 'invalid_token'));
} else
	$view = null;

if($view == "update"){
	$f = fopen(ROOT_PATH . "/modules/Nextyle/pages/settings.php","w");
	require ROOT_PATH . '/modules/Nextyle/pages/settings.default.php';

	if(fwrite($f, $settings_inf) > 0){
		fclose($f);

		Session::flash('nextyle_success', $nextyle_language->get('language', 'successfully_updated'));

		Redirect::to(URL::build('/panel/nextyle'));
		die();

	} else
		$errors = array($nextyle_language->get('language', 'unable_to_write_to_settings'));

}

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets);

if(Session::exists('nextyle_success'))
	$success = Session::flash('nextyle_success');

if(isset($success))
	$smarty->assign(array(
		'SUCCESS' => $success,
		'SUCCESS_TITLE' => $language->get('general', 'success')
	));

if(isset($errors) && count($errors))
	$smarty->assign(array(
		'ERRORS' => $errors,
		'ERRORS_TITLE' => $language->get('general', 'error')
	));

require ROOT_PATH . '/modules/Nextyle/pages/settings.php';
$getNavbarTheme = NEXTYLE_THEME;
$getNavbarBg = NEXTYLE_BG;
$getNavbarLogo = NEXTYLE_LOGO;

$smarty->assign(array(
	'PARENT_PAGE' => PARENT_PAGE,
	'DASHBOARD' => $language->get('admin', 'dashboard'),
	'NEXTYLE' => $nextyle_language->get('language', 'nextyle_title'),
	'PAGE' => PANEL_PAGE,
	'TOKEN' => Token::get(),
	'SUBMIT' => $language->get('general', 'submit'),
	'NAV_THEME_VALUE' => $getNavbarTheme,
	'HEADER_BG_VALUE' => $getNavbarBg,
	'LOGO_VALUE' => $getNavbarLogo,
	'NAV_THEME' => $nextyle_language->get('language', 'theme'),
	'HEADER_BG' => $nextyle_language->get('language', 'header_background'),
	'LOGO' => $nextyle_language->get('language', 'logo'),
	'RED' => $nextyle_language->get('language', 'red'),
	'BLUE' => $nextyle_language->get('language', 'blue'),
	'GOLD' => $nextyle_language->get('language', 'gold')
));

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

// Display template
$template->displayTemplate('nextyle/index.tpl', $smarty);