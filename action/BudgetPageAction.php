<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class BudgetPageAction extends CommonAction {


		public $expenses = [];
		public $firstname;
		public $partnerName;

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Budget");
		}

		protected function executeAction() {
			$this->expenses = UserDAO::getExpenses($_SESSION["user_id"], $_SESSION["partner_id"]);
		
			if(isset($_POST["new-expense-description"]) && isset($_POST["new-expense-place"]) && isset($_POST["new-expense-price"]) && isset($_POST["new-expense-owner"])){
				UserDAO::insertNewExpense($_POST["new-expense-description"], $_POST["new-expense-place"], $_POST["new-expense-price"], $_POST["new-expense-owner"]);
			}
		}
	}