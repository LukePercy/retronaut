<?php

class DiaryController extends Controller {

	public static $allowed_actions = array(
		'index',
		'glads',
		'sads',
		'addtag'
	);

	public function init() {
		parent::init();

		BasicAuth::requireLogin('Retronaut');

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

	public function glads() {
		return $this->renderWith(array('DiaryController_glads', 'Controller'));
	}

	public function sads() {
		return $this->renderWith(array('DiaryController_sads', 'Controller'));
	}

	public function addtag() {
		return $this->renderWith(array('DiaryController_addtag', 'Controller'));
	}

	public function summary() {
		// This shows the current sprint's mood graph to date, perhaps with the day that you've just filled in as a
		// different colour.
		// The right bottom option is:
		//  - If it's the last day of the sprint, a link to RETRO TIME.
		//  - If it's the current day, a link back to the main menu.
		//  - Otherwise a link to the next day in the sprint.
		return $this->renderWith(array('DiaryController_summary', 'Controller'));
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