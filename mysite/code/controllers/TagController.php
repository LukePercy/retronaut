<?php

class TagController extends SecureController {

	public static $allowed_actions = array(
		'add',
		'remove'
	);

	public function init() {
		parent::init();
	}

	public function add() {
		$tagID = $this->request->postVar('tag');
		$memberID = $this->request->postVar('member');
		$sprintID = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->addTag($tagID, $sprintID, $day)) {
			return 'success';
		}

		return 'failure';
	}

	public function remove() {
		$tagID = $this->request->postVar('tag');
		$memberID = $this->request->postVar('member');
		$sprintID = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->removeTag($tagID, $sprintID, $day)) {
			return 'success';
		}

		return 'failure';
	}
}