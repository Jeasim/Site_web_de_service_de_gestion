<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class SignupAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Signup");
		}

		protected function executeAction() {

			if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["password"]) && !empty($_POST["password-confirm"])){
				if($_POST["password"] === $_POST["password-confirm"]){
					if(!UserDAO::verifyUsername($_POST["username"])){
						if(!UserDAO::verifyEMail($_POST["email"])){
							UserDAO::insertNewUser($_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"]);
							$_SESSION["firstname"] = UserDAO::getFirstname($_POST["username"]);
							$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
							header("location:home.php");
							exit;
						}
					}
				}
			}
		}

	}