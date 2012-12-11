<?php

class Tag extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)',
		'Type' => "Enum('Glad, Sad', 'Glad')"
	);

	static $has_one = array(
		'Category' => 'Category'
	);

	// Custom relation to Member, see TagMemberRelation for more information.
}