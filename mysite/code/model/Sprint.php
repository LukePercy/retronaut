<?php

class Sprint extends DataObject {

	static $db = array(
		'StartDate' => 'Date',
		'EndDate' => 'Date'
	);

	static $has_one = array(
		'Team' => 'ScrumTeam'
	);

	static $summary_fields = array(
		'StartDate',
		'EndDate'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->fieldByName('Root.Main.StartDate')->setConfig('showcalendar', true);
		$fields->fieldByName('Root.Main.EndDate')->setConfig('showcalendar', true);

		return $fields;
	}

	public function getNumber() {
		$sprints = Sprint::get('Sprint', "TeamID = $this->TeamID AND StartDate <= '$this->StartDate'", array('StartDate', 'ASC'));
		return $sprints->count();
	}

	public function getDay() {
		return $this->getDate()->Day();
	}

	public function getWeek() {
		return floor($this->getDayIndex() / 5) + 1;
	}

	public function getNumDays() {
		return $this->getDayIndex($this->Obj('EndDate')) + 1;
	}

	// Returns the index of the day into the sprint - Tuesday of Week 2 = 7
	// TODO: remove weekends from calculations
	public function getDayIndex($date = null) {
		$date = $date ? $date : $this->getDate();
		$startDate = $this->obj('StartDate');

		$days_between = $date->days_between(
			$startDate->format('Y'),
			$startDate->format('n'),
			$startDate->format('j'),
			$date->format('Y'),
			$date->format('n'),
			$date->format('j'));

		// Remove the weekends from the equation;
		$day_index = ($startDate->format('N') - 1) + $days_between;
		return $days_between - floor($day_index / 7) * 2;
	}

	public function getDate() {
		$request = Controller::curr()->request;
		$requestedDate = $request->getVar('date');
		if ($requestedDate) {
			$date = new SS_DateTime('RequestedDate');
			$date->setValue($requestedDate);
			return $date;
		}

		$date = SS_Datetime::now();
		$daysIntoWeekend = $date->format('N') - 5;
		while ($daysIntoWeekend > 0) {
			$date->setValue($date->day_before($date->format('Y'), $date->format('n'), $date->format('j')));
			$daysIntoWeekend--;
		}

		return $date;
	}

	public function getPreviousDate() {
		$date = $this->getDate();
		$startDate = $this->obj('StartDate');
		if ($date->format('Y') < $startDate->format('Y') ||
			$date->format('n') < $startDate->format('n') ||
			$date->format('j') <= $startDate->format('j')) {
			return;
		}

		$previousDate = new SS_DateTime('PreviousDate');
		$previousDate->setValue($date->getValue());
		do {
			$previousDate->setValue($previousDate->day_before($previousDate->format('Y'), $previousDate->format('n'), $previousDate->format('j')));
		} while ($previousDate->format('N') >= 6); // Skip past weekends.

		// If, after we skipped the weekend, we've shot past the start of sprint, then return.
		if ($previousDate->format('Y') < $startDate->format('Y') ||
			$previousDate->format('n') < $startDate->format('n') ||
			$previousDate->format('j') < $startDate->format('j')) {
			return;
		}

		return $previousDate;
	}

	public function getNextDate() {
		$date = $this->getDate();
		if ($date->isToday()) {
			return;
		}
		
		$endDate = $this->obj('EndDate');
		if ($date->format('Y') > $endDate->format('Y') ||
			$date->format('n') > $endDate->format('n') ||
			$date->format('j') >= $endDate->format('j')) {
			return;
		}

		$nextDate = new SS_DateTime('NextDate');
		$nextDate->setValue($date->getValue());
		do {
			$nextDate->setValue($nextDate->next_day($nextDate->format('Y'), $nextDate->format('n'), $nextDate->format('j')));
		} while ($nextDate->format('N') >= 6); // Skip past weekends.

		// If, after we skipped the weekend, we've shot past the current day or the end of sprint,
		// then return.
		if ($nextDate->inFuture()) {
			return;
		}
		if ($nextDate->format('Y') > $endDate->format('Y') ||
			$nextDate->format('n') > $endDate->format('n') ||
			$nextDate->format('j') > $endDate->format('j')) {
			return;
		}

		return $nextDate;
	}

	public function IsRetroDay() {
		// Only the current day can be retrospective day.
		if (!$this->getDate()->isToday())
		{
			return false;
		}

		// Only on the last day of the sprint.
		return $this->getDayIndex() == ($this->getNumDays() - 1);
	}

	/*
	 * Returns a list of categories that have had sad tags belonging to it mentioned in the diary
	 * entries this sprint.
	**/
	public function getTrendingCategories() {
		$categoryVotes = array();
		$tagVotes = array();

		foreach ($this->Team()->Members() as $member) {
			$memberCategories = array();
			for ($day = 0;$day < $this->getNumDays(); $day++) {
				foreach ($member->getTags('Sad', $this->ID, $day) as $tag) {
					// Record the number of times this tag has been mentioned.
					if (!array_key_exists($tag->ID, $tagVotes)) {
						$tagVotes[$tag->ID] = 0;
					}
					$tagVotes[$tag->ID]++;

					// Record the effect on the category ranking.
					$categoryID = $tag->Category()->ID;
					if (!array_key_exists($categoryID, $memberCategories)) {
						$memberCategories[$categoryID] = array(
							'tags' => array(),
							'days' => array()
						);
					}

					$memberCategories[$categoryID]['tags'][$tag->ID] = 1;
					$memberCategories[$categoryID]['days'][$day] = 1;
				}
			}

			// Assemble the number of votes for this category.
			foreach ($memberCategories as $id => $memberCategory) {
				$votes =
					max(3, count($memberCategory['tags'])) +
					max(2, count($memberCategory['days']));

				if (!array_key_exists($id, $categoryVotes)) {
					$categoryVotes[$id] = 0;
				}
				$categoryVotes[$id] += $votes;
			}
		}

		// Rank the categories and tags by votes.
		arsort($categoryVotes);
		arsort($tagVotes);

		// Build the return structure for categories.
		$categories = array();
		foreach ($categoryVotes as $categoryID => $votes) {
			$category = Category::get_by_id('Category', $categoryID);
			$category->TrendingTags = new ArrayList(array());
			$categories[] = $category;
		}

		// Add the tags
		foreach ($tagVotes as $tagID => $votes) {
			$tag = Tag::get_by_id('Tag', $tagID);
			foreach ($categories as $category) {
				if ($category->ID == $tag->CategoryID) {
					$category->TrendingTags->add($tag);
					break;
				}
			}
		}

		return new ArrayList($categories);
	}

	/*
	 * Returns a list of categories that been voted as the most important during this sprint.
	**/
	public function getVotedCategories() {
		
	}
}