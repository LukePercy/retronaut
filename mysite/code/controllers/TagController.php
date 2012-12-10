<?php

class TagController extends Controller {

	public static $allowed_actions = array(
		'add',
		'remove'
	);

	public function init() {
		parent::init();

		BasicAuth::requireLogin('Retronaut');
	}

	public function add() {
		$tagId = $this->request->postVar('tag');
		$memberId = $this->request->postVar('member');
		$sprintId = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		// Add this to the many-many relationship.

		return "add: $tagId, $memberId, $sprintId, $day";
	}

	public function remove() {
		$tagId = $this->request->postVar('tag');
		$memberId = $this->request->postVar('member');
		$sprintId = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		// Remove this from the many-many relationship.

		return "remove: $tagId, $memberId, $sprintId, $day";
	}
}