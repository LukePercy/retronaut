<?php

class VertexMemberRelation extends DataObject {

	static $db = array(
		'MemberID' => 'Int',
		'SprintID' => 'Int',
		'Day' => 'Int',
		'X' => 'Float',
		'Y' => 'Float'
	);

	public function InverseY() {
		return 1 - $this->Y;
	}
}