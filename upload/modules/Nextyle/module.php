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

class Nextyle_Module extends Module {
	private $_language, $_nextyle_language;

	public function __construct($pages, $language, $nextyle_language){
		$this->_language = $language;
		$this->_nextyle_language = $nextyle_language;

		$name = 'Nextyle';
		$author = '<a href="https://www.spigotmc.org/members/nexious.331758/" target="_blank" rel="nofollow noopener">Nexious</a> + <a href="https://samerton.me" target="_blank" rel="nofollow noopener">Samerton</a>';
		$module_version = '1.1.0';
		$nameless_version = '2.0.0-pr5';

		parent::__construct($this, $name, $author, $module_version, $nameless_version);

		// Pages
		$pages->add('Nextyle', '/admin/nextyle', 'pages/nextyle.php');
		$pages->add('Nextyle', '/panel/nextyle', 'pages/panel.php');
	}

	public function onInstall(){
		// Not necessary
	}

	public function onUninstall(){
		// Not necessary
	}

	public function onEnable(){
		// Not necessary
	}

	public function onDisable(){
		// Not necessary
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template){
		// Permissions
		PermissionHandler::registerPermissions('Nextyle', array(
			'admincp.nextyle' => $this->_language->get('moderator', 'staff_cp') . ' &raquo; Nextyle'
		));

		if(defined('FRONT_END')){
			// Get Nextyle theme settings
			require(ROOT_PATH . '/modules/Nextyle/pages/getvariables.php');

			$smarty->assign(array(
				'NEXTYLE_COLOR' => $nextyle_color,
				'NEXTYLE_LOGO' => $nextyle_logo
			));
		}
	}
}