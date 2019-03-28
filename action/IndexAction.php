<?php
	require_once("action/CommonAction.php");

	class indexAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Login");
		}

		protected function executeAction() {
			Connection::getConnection();
		}
	}