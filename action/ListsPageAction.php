<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class ListsPageAction extends CommonAction {


		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Listes");
		}

		protected function executeAction() {
			
			
			
		}
	}