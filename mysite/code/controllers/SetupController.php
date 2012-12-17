<?php

class SetupController extends SecureController {

	public static $allowed_actions = array(
		'index',
		'sprints',
		'members'
	);

	public function init() {
		parent::init();

		Requirements::themedCSS('jquery.mobile-1.2.0.min');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::themedCSS('retronaut');
		Requirements::javascript($this->ThemeDir() . '/js/jquery-1.8.2.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.resize.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.mobile-1.2.0.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/taglist.js');
	}

	public function sprints() {
		return $this->renderWith(array('SetupController_sprints', 'SetupController', 'Controller'));
	}

	public function members() {
		return $this->renderWith(array('SetupController_members', 'SetupController', 'Controller'));
	}

	public function getTitle() {
		return 'Team';
	}

	public function getTeam() {
		$member = Member::currentUser();
		if ($member) {
			return $member->obj('Team');
		}
	}
}