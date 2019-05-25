<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class FetchSelectedTypeExpensesAction extends CommonAction {

    public $result;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        $this->result = UserDAO::getExpensesByType($_POST["type"]);
        
    }

}
	