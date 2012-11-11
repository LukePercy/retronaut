<?php

class ScrumTeamAdmin extends ModelAdmin {
	public static $managed_models = array('ScrumTeam');
	static $url_segment = 'teams';
	static $menu_title = 'Scrum Teams';
	static $menu_icon = 'mysite/images/teams.png'; 
}