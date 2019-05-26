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

			if($this->fieldsAllFilled()){
				if ($this->existingUsername()) {
					if($this->rightPassword()){
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

		private function fieldsAllFilled(){
			return !empty($_POST["username"]) && !empty($_POST["password"]);
		}

		private function existingUsername(){
			return UserDAO::verifyUsername($_POST["username"]);
		}

		private function rightPassword(){
			return UserDAO::verifyPassword($_POST["username"], $_POST["password"]);
		}


		private function login(){
			$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
			$_SESSION["user_firstname"] = UserDAO::getFirstname($_POST["username"]);
			header("location:home");
			exit;
		}
	}