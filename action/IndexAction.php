<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class IndexAction extends CommonAction {

		public $wrongUsername;
		public $wrongPassword;

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Login");
		}

		protected function executeAction() {
			$this->wrongUsername = false;
			$this->wrongPassword = false;

			if(!empty($_POST["username"]) && !empty($_POST["password"])){

				
				if (UserDAO::verifyUsername($_POST["username"])) {

					if(UserDAO::verifyPassword($_POST["username"], $_POST["password"])){
						$this->login();
					}
					else{
						$this->wrongPassword = true;
					}
				}
				else {
					$this->wrongUsername = true;
				}
			}
		}


		protected function login(){
			$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
			$_SESSION["firstname"] = UserDAO::getFirstname($_POST["username"]);
			header("location:home.php");
			exit;
		}
	}