<?php

class Category extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)'
	);

	static $has_many = array(
		'Tags' => 'Tag'
	);

	public function getNumVotes() {
		$member = Member::currentUser();
		if (!$member) {
			return false;
		}

		return $member->getNumVotes($this->ID);
	}
}