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

		$typeWhere = null;
		if ($type) {
			$typeWhere = '"Type"=\'' . $type ."'";
		}

		$tagObjects = array();
		foreach ($tags as $tag) {
			$tagObject = DataObject::get_by_id('Tag', $tag->TagID, $typeWhere);
			if ($tagObject) {
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
}