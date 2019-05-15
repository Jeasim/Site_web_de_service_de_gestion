<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class InsertNewListAction extends CommonAction {

    public $response;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        UserDAO::insertNewList($_SESSION["user_id"], $_POST["title"]);
        
        foreach ($_POST["elements"] as $element) {
            UserDAO::insertNewListElement($_POST["title"], $element, $_SESSION["user_id"]);
        }
        
    }

}
	