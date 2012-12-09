<?php

class TagController extends Controller {

	public static $allowed_actions = array(
		'save'
	);

	public function init() {
		parent::init();

		BasicAuth::requireLogin('Retronaut');
	}

	public function save() {
		$tagId = $this->request->getVar('tag');
		$MemberId = $this->request->getVar('member');
		$sprintId = $this->request->getVar('sprint');
		$day = $this->request->getVar('day');

		// Add this to the many-many relationship.

		return 'success';
	}
}