<?php

class ScrumTeam extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)'
	);

	static $has_many = array(
		'Members' => 'Member',
		'Sprints' => 'Sprint'
	);

	function getCurrentSprint() {
		$now = SS_Datetime::now()->URLDate();
		$currentSprints = $this->Sprints("StartDate <= '$now' && EndDate >= '$now'");
		if ($currentSprints) {
			return $currentSprints->first();
		}
	}

	function AllVotesCommitted($sprintID = null) {
		if (is_null($sprintID)) {
			$sprintID = $this->getCurrentSprint()->ID;
		}

		foreach ($this->Members() as $member) {
			if (!$member->VotesCommitted($sprintID)) {
				return false;
			}
		}

		return true;
	}
}