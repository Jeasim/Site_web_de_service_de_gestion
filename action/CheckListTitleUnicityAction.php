<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class CheckListTitleUnicityAction extends CommonAction {

    public $validity;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        if (isset($_POST["listTitle"])) {
            if(!UserDAO::verifyListTitle($_POST["listTitle"])){
                $this->validity = "valid";
            }
            else{
                $this->validity = "Cette liste existe déjà";
            }
        }
    }

}
	