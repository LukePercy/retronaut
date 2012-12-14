<?php

class VoteController extends SecureController {

	public static $allowed_actions = array(
		'set',
		'clear',
		'commit',
		'AllVotesCommitted'
	);

	public function init() {
		parent::init();
	}

	public function set() {
		$categoryID = $this->request->postVar('category');
		$sprintID = $this->request->postVar('sprint');
		$numVotes = $this->request->postVar('votes');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->setVotes($categoryID, $sprintID, $numVotes)) {
			return 'success';
		}

		return 'failure';
	}

	public function clear() {
		$sprintID = $this->request->postVar('sprint');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->clearVotes($sprintID)) {
			return 'success';
		}

		return 'failure';
	}

	public function commit() {
		$sprintID = $this->request->postVar('sprint');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->commitVotes($sprintID)) {
			return 'success';
		}

		return 'failure';
	}

	public function AllVotesCommitted() {
		$sprintID = $this->request->postVar('sprint');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		$team = $member->Team();
		if (!$team) {
			return 'Team not found';
		}

		return $team->AllVotesCommitted($sprintID);
	}
}