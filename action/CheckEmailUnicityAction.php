<?php
    require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

class CheckEmailUnicityAction extends CommonAction {

    public $validity;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        if(isset($_POST["email"])) {
            if(!UserDAO::verifyEmail($_POST["email"])){
                $this->validity = "valide";
            }
            else{
                $this->validity = "Adresse courriel est déjà utilisé";
            }
        }
    }

}
	