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
		$date = $this->getDate();

		$startDate = $this->obj('StartDate');
		$daysSinceSprintBegan = $date->days_between(
			$startDate->format('Y'),
			$startDate->format('n'),
			$startDate->format('j'),
			$date->format('Y'),
			$date->format('n'),
			$date->format('j'));

		return floor($daysSinceSprintBegan / 7) + 1;
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
		$previousDate->setValue($date->day_before($date->format('Y'), $date->format('n'), $date->format('j')));
		return $previousDate;
	}

	public function getNextDate() {
		$date = $this->getDate();
		$endDate = $this->obj('EndDate');
		if ($date->format('Y') > $endDate->format('Y') ||
			$date->format('n') > $endDate->format('n') ||
			$date->format('j') >= $endDate->format('j')) {
			return;
		}

		$nextDate = new SS_DateTime('NextDate');
		$nextDate->setValue($date->next_day($date->format('Y'), $date->format('n'), $date->format('j')));
		return $nextDate;
	}

	protected function getDate() {
		$request = Controller::curr()->request;
		$requestedDate = $request->getVar('date');
		if ($requestedDate) {
			$date = new SS_DateTime('RequestedDate');
			$date->setValue($requestedDate);
			return $date;
		} else {
			return SS_Datetime::now();
		}
	}
}