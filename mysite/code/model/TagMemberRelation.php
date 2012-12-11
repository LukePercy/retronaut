<?php

class TagMemberRelation extends DataObject {

	static $db = array(
		'TagID' => 'Int',
		'MemberID' => 'Int',
		'SprintID' => 'Int',
		'Day' => 'Int'
	);
}