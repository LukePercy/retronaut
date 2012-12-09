<?php

class TeamMemberRole extends DataExtension {
	static $has_one = array(
		'Team' => 'ScrumTeam'
	);

	static $many_many = array(
		'Tags' => 'Tag'
	);

	static $many_many_extraFields = array(
		'Tags' => array(
			'SprintID' => 'Int',
			'Day' => 'Int'
		)
	);
}