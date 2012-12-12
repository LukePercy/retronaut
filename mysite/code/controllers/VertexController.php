<?php

class VertexController extends SecureController {

	public static $allowed_actions = array(
		'add',
		'remove'
	);

	public function init() {
		parent::init();
	}

	public function add() {
		$vertexData = $this->request->postVar('vertices');
		$memberID = $this->request->postVar('member');
		$sprintID = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		$vertices = explode("\n", $vertexData);
		foreach ($vertices as $vertex) {
			$points = explode(',', $vertex);
			$member->addVertex($points[0], $points[1], $sprintID, $day);
		}

		return 'success';
	}

	public function remove() {
		$memberID = $this->request->postVar('member');
		$sprintID = $this->request->postVar('sprint');
		$day = $this->request->postVar('day');

		$member = Member::currentUser();
		if (!$member) {
			return 'Member not found';
		}

		if ($member->removeVertices($sprintID, $day)) {
			return 'success';
		}

		return 'failure';
	}
}