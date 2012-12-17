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
			$this->redirect('Security/login?BackURL=' . $this->getRequest()->getVar('url'));
		}

		Requirements::themedCSS('jquery.mobile-1.2.0.min');
		Requirements::themedCSS('jquery-mobile-local');
		Requirements::themedCSS('retronaut');
		Requirements::javascript($this->ThemeDir() . '/js/jquery-1.8.2.min.js');
		Requirements::javascript($this->ThemeDir() . '/js/page.js');
		Requirements::javascript($this->ThemeDir() . '/js/jquery.mobile-1.2.0.min.js');
	}
}