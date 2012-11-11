<?php

class ScrumTeam extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)'
	);

	static $has_many = array(
		'Members' => 'Member'
	);
}