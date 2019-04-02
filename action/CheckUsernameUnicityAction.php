<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

class CheckUsernameUnicityAction extends CommonAction {

    public $validity;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        if (!empty($_POST["username"])) {
            if(UserDAO::verifyUsernameUnicity($_POST["username"])){
                $this->validity = "valide";
            }
            else{
                $this->validity = "deja pris";
            }
        }
    }

}
	