<?php

class VoteMemberRelation extends DataObject {

	static $db = array(
		'MemberID' => 'Int',
		'CategoryID' => 'Int',
		'SprintID' => 'Int',
		'Votes' => 'Int',
		'Committed' => 'Boolean'
	);
}