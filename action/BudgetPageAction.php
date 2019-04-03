<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class BudgetPageAction extends CommonAction {


		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Budget");
		}

		protected function executeAction() {

			
			
		}
	}