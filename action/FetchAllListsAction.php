<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class FetchAllListsAction extends CommonAction {

    public $result;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        $this->result = UserDAO::fetchUsersLists($_SESSION["user_id"], $_SESSION["partner_id"]);
        
    }

}
	