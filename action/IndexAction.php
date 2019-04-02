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
				if ($pwd = UserDAO::verifyUsername($_POST["username"])) {
					if(password_verify($_POST["password"], $pwd)){

						$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
	
						header("location:home.php");
						exit;
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
	}