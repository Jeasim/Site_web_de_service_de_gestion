<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class BudgetPageAction extends CommonAction {


		public $expenses = [];
		public $firstname;
		public $partnerName;
		public $userExpensesSum;
		public $partnerExpensesSum;
		public $userExpensesBalance;
		public $partnerExpensesBalance;
		public $expenseTypes;



		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Budget");
		}

		protected function executeAction() {
			$this->expenses = UserDAO::getExpenses($_SESSION["user_id"], $_SESSION["partner_id"]);
			$this->expenseTypes = UserDAO::getExpenseTypes();
			$this->userExpensesSum = UserDAO::getExpensesSum($_SESSION["user_id"]);
			$this->partnerExpensesSum = UserDAO::getExpensesSum($_SESSION["partner_id"]);
			$this->userExpensesBalance = $this->userExpensesSum - $this->partnerExpensesSum;
			$this->partnerExpensesBalance = $this->partnerExpensesSum - $this->userExpensesSum;
		}
	}