<?php

class SecureController extends Controller {

	public function init() {
		parent::init();

		if (!Member::currentUserID()) {
			$this->redirect('Security/login?BackURL=' . $this->getRequest()->getVar('url'));
		}
	}
}