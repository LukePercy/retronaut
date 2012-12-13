<?php

class RetroController extends SecureController {

	public static $allowed_actions = array(
		'index',
		'trends',
		'discuss',
		'actions'
	);

	public function init() {
		parent::init();

		Requirements::themedCSS('jquery.mobile-1.2.0.min');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::javascript($this->ThemeDir() . '/js/jquery-1.8.2.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.resize.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.mobile-1.2.0.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/diary.js');
		Requirements::javascript($this->ThemeDir() . '/js/taglist.js');
	}

	public function trends() {
		return $this->renderWith(array('RetroController_trends', 'RetroController', 'Controller'));
	}

	public function discuss() {
		return $this->renderWith(array('RetroController_discuss', 'RetroController', 'Controller'));
	}

	public function actions() {
		return $this->renderWith(array('RetroController_actions', 'RetroController', 'Controller'));
	}

	public function getTitle() {
		return 'Retrospective';
	}

	public function getTeam() {
		$member = Member::currentUser();
		if ($member) {
			return $member->obj('Team');
		}
	}

	public function getSprint() {
		$team = $this->getTeam();
		if ($team) {
			return $team->getCurrentSprint();
		}
	}
}