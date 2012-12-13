<?php

class DiaryController extends SecureController {

	public static $allowed_actions = array(
		'index',
		'glads',
		'sads',
		'summary'
	);

	public function init() {
		parent::init();

		Requirements::themedCSS('jquery.mobile-1.2.0.min');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::themedCSS('graph');
		Requirements::javascript($this->ThemeDir() . '/js/jquery-1.8.2.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.flot.resize.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.mobile-1.2.0.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/graph.js');
		Requirements::javascript($this->ThemeDir() . '/js/taglist.js');
	}

	public function glads() {
		return $this->renderWith(array('DiaryController_glads', 'DiaryController', 'Controller'));
	}

	public function sads() {
		return $this->renderWith(array('DiaryController_sads', 'DiaryController', 'Controller'));
	}

/*
	TODO: Add the ability to add custom tags.
	public function addtag() {
		return $this->renderWith(array('DiaryController_addtag', 'Controller'));
	}
*/

	public function summary() {
		// This shows the current sprint's mood graph to date, perhaps with the day that you've just filled in as a
		// different colour.
		// The right bottom option is:
		//  - If it's the last day of the sprint, a link to RETRO TIME.
		//  - If it's the current day, a link back to the main menu.
		//  - Otherwise a link to the next day in the sprint.
		return $this->renderWith(array('DiaryController_summary', 'DiaryController', 'Controller'));
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

	public function getLink($action = null, $day = 0) {
		$actionSegment = '';
		if ($action) {
			if ($action != 'index') {
				$actionSegment = "/$action";
			}
		} else {
			$actionSegment = $this->getActionSegment();
		}

		$sprint = $this->getSprint();
		$date = $sprint->getDate();
		$daySegment = '';
		if ($day != 0) {
			if ($day < 0) {
				$date = $sprint->getPreviousDate();
			} else {
				$date = $sprint->getNextDate();
			}
		}
		if (!$date->IsToday())
		{
			$daySegment = '?date=' . $date->Format('d/m/Y');
		}

		return 'diary' . $actionSegment . $daySegment;
	}

	public function getPreviousDate() {
		$sprint = $this->getSprint();
		if ($sprint) {
			return $sprint->getPreviousDate();
		}
	}

	public function getNextLink() {
		$sprint = $this->getSprint();
		if ($sprint) {
			$date = $sprint->getNextDate();
			if ($date) {
				return 'diary' . $this->getActionSegment() . '?date=' . $date->Format('d/m/Y');
			}
		}
	}

	public function getActionSegment() {
		if ($this->action != 'index') {
			return '/' . $this->action;
		}
	}

	public function Categories($type = null) {
		$categories = Category::get();

		if (!$type) {
			return $categories;
		}

		$filteredCategories = array();
		foreach ($categories as $category) {
			foreach ($category->Tags() as $tag) {
				if ($tag->Type == $type) {
					$filteredCategories[] = $category;
					continue 2;
				}
			}
		}

		return new ArrayList($filteredCategories);
	}
}