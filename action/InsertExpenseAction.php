<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class InsertExpenseAction extends CommonAction {

    public $response;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {
        UserDAO::insertNewExpense($_POST["description"], $_POST["place"], $_POST["price"], $_POST["owner"]);
    }

}
	