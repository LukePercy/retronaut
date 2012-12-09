<?php

class TagsAdmin extends ModelAdmin {
	public static $managed_models = array('Category', 'Tag');
	static $url_segment = 'tags';
	static $menu_title = 'Tags and Categories';
//	static $menu_icon = 'mysite/images/teams.png'; 
}