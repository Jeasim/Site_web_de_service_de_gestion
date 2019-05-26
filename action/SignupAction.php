<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class SignupAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "S'inscrire");
		}

		protected function executeAction() {

			if($_SESSION["visibility"] > CommonAction::$VISIBILITY_PUBLIC){
				header("location:home");
			}

			if($this->allFieldsFilled() && $this->matchingPasswords() && $this->usernameUnicity() && $this->emailUnicity()){
				UserDAO::insertNewUser($_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"]);
				$this->login();
			}
		}

		private function allFieldsFilled(){
			return !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["password"]) && !empty($_POST["password-confirm"]);
		}

		private function matchingPasswords(){
			return $_POST["password"] === $_POST["password-confirm"];
		}

		private function usernameUnicity(){
			return !UserDAO::verifyUsername($_POST["username"]);
		}

		private function emailUnicity(){
			return !UserDAO::verifyEMail($_POST["email"]);
		}

		private function login(){
			$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
			$_SESSION["user_firstname"] = UserDAO::getFirstname($_POST["username"]);
			$_SESSION["user_id"] = UserDAO::getUserId($_POST["username"]);
			$_SESSION["partner_id"] = UserDAO::getUserPartnerId($_SESSION["user_id"]);
			header("location:home");
			exit;
		}

	}