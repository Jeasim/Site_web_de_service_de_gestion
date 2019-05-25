<?php
	session_start();

	require_once("DAO/Connection.php");
	require_once("action/DAO/constants.php");

	abstract class CommonAction {
		public static $VISIBILITY_PUBLIC = 0;
		public static $VISIBILITY_MEMBER = 1;
		public static $VISIBILITY_ADMINISTRATOR = 2;

		private $pageVisibility;
		private $pageTitle;

		public function __construct($pageVisibility, $pageTitle) {
			$this->pageVisibility = $pageVisibility;
			$this->pageTitle = $pageTitle;
		}

		public function execute() {
			if (!empty($_GET["logout"])) {
				session_unset();
				session_destroy();
				session_start();
			}

			if (empty($_SESSION["visibility"])) {
				$_SESSION["visibility"] = CommonAction::$VISIBILITY_PUBLIC;
			}

			if ($_SESSION["visibility"] < $this->pageVisibility) {
				header("location:index.php");
				exit;
			}

			$this->executeAction();
		}

		protected abstract function executeAction();


		public function getFirstname() {
			return empty($_SESSION["user_firstname"]) ? "Invité" : $_SESSION["user_firstname"];
		}

		// public function getUserId() {
		// 	return $_SESSION["user_id"];
		// }

		public function isLoggedIn() {
			return $_SESSION["visibility"] > CommonAction::$VISIBILITY_PUBLIC;
		}

		public function getPageTitle() {
			return $this->pageTitle;
		}
	}