<?php
    require_once("action/CommonAction.php");

class CheckMatchingPasswordsAction extends CommonAction {

    public $validity;

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Ajax");
    }

    protected function executeAction() {

        if(!empty($_POST["password1"]) && !empty($_POST["password2"])) {
            if($_POST["password1"] === $_POST["password2"]){
                $this->validity = "valid";
            }
            else{
                $this->validity = "Les mots de passe doivent être identiques";
            }
        }
    }

}
	