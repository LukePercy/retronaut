<?php

class TeamMemberRole extends DataExtension {
	static $has_one = array(
		'Team' => 'ScrumTeam'
	);

	// Custom relation to Member, see TagMemberRelation for more information.
	public function getTags($type = null, $sprintID = null, $day = null) {
		$memberID = $this->owner->ID;
		$sprintID = $sprintID ? $sprintID : $this->owner->Team()->getCurrentSprint()->ID;
		$day = $day ? $day : $this->owner->Team()->getCurrentSprint()->getDayIndex();

		$tags = DataObject::get('TagMemberRelation',
			'"MemberID" = ' . $memberID . ' AND ' .
			'"SprintID" = ' . $sprintID . ' AND ' .
			'"Day" = ' . $day);

		$tagObjects = array();
		foreach ($tags as $tag) {
			$tagObject = DataObject::get_by_id('Tag', $tag->TagID);
			if ($tagObject && (!$type || $tagObject->Type == $type)) {
				$tagObjects[] = $tagObject;
			}
		}

		return new ArrayList($tagObjects);
	}

	public function addTag($tagID, $sprintID, $day) {
		$memberID = $this->owner->ID;
		$tag = DataObject::get_one('TagMemberRelation',
			'"TagID"=' . $tagID . ' AND ' .
			'"MemberID"=' . $memberID . ' AND ' .
			'"SprintID"=' . $sprintID . ' AND ' .
			'"Day"=' . $day);

		if ($tag) {
			return false;
		}

		$tag = new TagMemberRelation();
		$tag->TagID = $tagID;
		$tag->MemberID = $memberID;
		$tag->SprintID = $sprintID;
		$tag->Day = $day;
		$tag->write();

		return true;
	}

	public function removeTag($tagID, $sprintID, $day) {
		$memberID = $this->owner->ID;
		$tag = DataObject::get_one('TagMemberRelation',
			'"TagID"=' . $tagID . ' AND ' .
			'"MemberID"=' . $memberID . ' AND ' .
			'"SprintID"=' . $sprintID . ' AND ' .
			'"Day"=' . $day);

		if ($tag) {
			$tag->delete();
			return true;
		}

		return false;
	}

	// Custom relation to Member, see VertexMemberRelation for more information.
	public function getGraphDataForDay($sprintID = null, $day = null) {
		$memberID = $this->owner->ID;
		$sprintID = $sprintID ? $sprintID : $this->owner->Team()->getCurrentSprint()->ID;
		$day = $day ? $day : $this->owner->Team()->getCurrentSprint()->getDayIndex();

		return DataObject::get('VertexMemberRelation',
			'"MemberID" = ' . $memberID . ' AND ' .
			'"SprintID" = ' . $sprintID . ' AND ' .
			'"Day" = ' . $day,
			'X ASC');
	}

	// Custom relation to Member, see VertexMemberRelation for more information.
	public function getGraphDataForSprint($sprintID = null) {
		$memberID = $this->owner->ID;
		$sprintID = $sprintID ? $sprintID : $this->owner->Team()->getCurrentSprint()->ID;
		$sprint = Sprint::get_by_id('Sprint', $sprintID);

		if (!$sprint) {
			return false;
		}

		$vertices = array();
		$numDaysInSprint = $sprint->getNumDays();
		for ($day = 0; $day < $numDaysInSprint; $day++) {

			$dayVertices = DataObject::get('VertexMemberRelation',
				'"MemberID" = ' . $memberID . ' AND ' .
				'"SprintID" = ' . $sprintID . ' AND ' .
				'"Day" = ' . $day,
				'X ASC');

			$XOffset = (1 / $numDaysInSprint) * $day;

			foreach ($dayVertices as $vertex) {
				$vertices[] = new ArrayData(array(
					'X' => $XOffset + ($vertex->X / $numDaysInSprint),
					'Y' => 1 - $vertex->Y
				));
			}
		}

		return new ArrayList($vertices);
	}

	// Custom relation to Member, see VertexMemberRelation for more information.
	public function getVertices($sprintID = null, $day = null) {
		$memberID = $this->owner->ID;
		$sprintID = $sprintID ? $sprintID : $this->owner->Team()->getCurrentSprint()->ID;
		$day = $day ? $day : $this->owner->Team()->getCurrentSprint()->getDayIndex();

		return DataObject::get('VertexMemberRelation',
			'"MemberID" = ' . $memberID . ' AND ' .
			'"SprintID" = ' . $sprintID . ' AND ' .
			'"Day" = ' . $day,
			'X ASC');
	}
	
	public function addVertex($vertexX, $vertexY, $sprintID, $day) {
		$memberID = $this->owner->ID;

		$vertex = new VertexMemberRelation();
		$vertex->X = $vertexX;
		$vertex->Y = $vertexY;
		$vertex->MemberID = $memberID;
		$vertex->SprintID = $sprintID;
		$vertex->Day = $day;
		$vertex->write();

		return true;
	}

	public function removeVertices($sprintID, $day) {
		$memberID = $this->owner->ID;
		$vertices = DataObject::get('VertexMemberRelation',
			'"MemberID"=' . $memberID . ' AND ' .
			'"SprintID"=' . $sprintID . ' AND ' .
			'"Day"=' . $day);

		if ($vertices) {
			foreach ($vertices as $vertex) {
				$vertex->delete();
			}
		}

		return true;
	}
}