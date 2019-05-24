<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class ListsPageAction extends CommonAction {

		public $listTitles;

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Listes");
		}

		protected function executeAction() {
			$this->listTitles =  UserDAO::getListTitles($_SESSION["user_id"], $_SESSION["partner_id"]);
		}
	}