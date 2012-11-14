<?php

class TeamMemberRole extends DataExtension {
	static $has_one = array(
		'Team' => 'ScrumTeam'
	);
}