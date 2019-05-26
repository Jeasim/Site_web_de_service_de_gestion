<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class HomeAction extends CommonAction {


		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Home");
		}

		protected function executeAction() {
			
		}
	}