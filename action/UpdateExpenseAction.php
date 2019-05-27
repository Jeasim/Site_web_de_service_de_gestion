<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class UpdateExpenseAction extends CommonAction {

    public $result;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        $typeID = UserDAO::getTypeID($_POST["type"]);
        $this->result = UserDAO::updateExpence($_POST["expenseID"], $_POST["description"], $_POST["place"], $_POST["price"], $_POST["owner"], $_POST["date"], $typeID);
        
    }

}
	