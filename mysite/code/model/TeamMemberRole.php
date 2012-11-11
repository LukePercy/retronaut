<?php

class TeamMemberRole extends DataExtension {
	/**
	 * Modify the field set to be displayed in the CMS detail pop-up
	 */
	public function updateCMSFields(FieldList $currentFields) {
		// Only show the additional fields on an appropriate kind of use 
		if(Permission::checkMember($this->owner->ID, 'VIEW_FORUM')) {
			// Edit the FieldList passed, adding or removing fields as necessary
		}
	}

	// define additional properties
	static $db = array();
	static $has_one = array(
		'Team' => 'ScrumTeam'
	);
	static $has_many = array();
	static $many_many = array();
	static $belongs_many_many = array();

	public function somethingElse() {
		// You can add any other methods you like, which you can call directly on the member object.
	}
}