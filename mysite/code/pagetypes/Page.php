<?php
class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();

		if (!Member::currentUserID()) {
			$this->redirect('Security/login');
		}

		Requirements::CSS('http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript('http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js');
	}
}