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
}