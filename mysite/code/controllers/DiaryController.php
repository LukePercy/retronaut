<?php

class DiaryController extends Controller {
	public function init() {
		parent::init();

		if (!Member::currentUserID()) {
			$this->redirect('Security/login?BackURL=/diary');
		}

		Requirements::CSS('http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::themedCSS('diary');
		Requirements::javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.resize.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript('http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/diary.js');
	}

	public function getTitle() {
		return 'Diary';
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

	public function getPreviousLink() {
		$sprint = $this->getSprint();
		if ($sprint) {
			$date = $sprint->getPreviousDate();
			if ($date) {
				return 'diary?date=' . $date->Format('d/m/Y');
			}
		}
	}

	public function getNextLink() {
		$sprint = $this->getSprint();
		if ($sprint) {
			$date = $sprint->getNextDate();
			if ($date) {
				return 'diary?date=' . $date->Format('d/m/Y');
			}
		}
	}
}