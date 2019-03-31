<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class IndexAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC, "Login");
		}

		protected function executeAction() {
			$this->wrongLogin = false;

			if (isset($_POST["username"])) {
				$userInfo = UserDAO::authenticate($_POST["username"], $_POST["password"]);

				if (!empty($userInfo)) {

					$_SESSION["name"] = $userInfo;
					$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;

					header("location:home.php");
					exit;
				}
				else {
					$this->wrongLogin = true;
				}
			}
		}
	}