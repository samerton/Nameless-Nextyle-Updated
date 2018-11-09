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
		$module_version = '1.1.1';
		$nameless_version = '2.0.0-pr5';

		parent::__construct($this, $name, $author, $module_version, $nameless_version);

		// Pages
		$pages->add('Nextyle', '/panel/nextyle', 'pages/panel.php');
	}

	public function onInstall(){
		// Copy panel template
		if(!is_dir(ROOT_PATH . '/custom/panel_templates/' . PANEL_TEMPLATE . '/nextyle')){
			try {
				mkdir(ROOT_PATH . '/custom/panel_templates/' . PANEL_TEMPLATE . '/nextyle');
				copy(ROOT_PATH . '/custom/panel_templates/Default/nextyle/index.tpl', ROOT_PATH . '/custom/panel_templates/' . PANEL_TEMPLATE . '/nextyle/index.tpl');
			} catch(Exception $e){
				// Unable to copy
			}
		}
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

		} else {
			if($user->data()->group_id == 2 || $user->hasPermission('admincp.nextyle')){
				$cache->setCache('panel_sidebar');
				if(!$cache->isCached('nextyle_order')){
					$order = 35;
					$cache->store('nextyle_order', 35);
				} else {
					$order = $cache->retrieve('nextyle_order');
				}

				if(!$cache->isCached('nextyle_icon')){
					$icon = '<i class="nav-icon fas fa-paint-brush"></i>';
					$cache->store('nextyle_icon', $icon);
				} else
					$icon = $cache->retrieve('nextyle_icon');

				$navs[2]->add('nextyle_divider', mb_strtoupper($this->_nextyle_language->get('language', 'nextyle_title')), 'divider', 'top', null, $order, '');
				$navs[2]->add('nextyle', $this->_nextyle_language->get('language', 'nextyle_title'), URL::build('/panel/nextyle'), 'top', null, ($order + 0.1), $icon);
			}
		}
	}
}