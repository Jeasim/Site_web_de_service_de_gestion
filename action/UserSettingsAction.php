<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class UserSettingsAction extends CommonAction {

		public $partnerID = null;
		public $message = "";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Réglages");
		}

		protected function executeAction() {

			if(!empty($_GET["partner-username-search"])){

				if(!UserDAO::verifyUserAlreadyPartnered($_SESSION["user_id"])){
				$searchedUsername = $_GET["partner-username-search"];

					if(UserDAO::verifyUserExistence($searchedUsername)){
						$searchedUserID = UserDAO::getUserId($searchedUsername);

						if(!UserDAO::verifyUserAlreadyPartnered($searchedUserID)){
							UserDAO::bindPartners($_SESSION["user_id"], $searchedUserID);
							$_SESSION["partner_id"] = UserDAO::getUserPartnerId($_SESSION["user_id"]);
							$_SESSION["partner_firstname"] = UserDAO::getFirstnameFromID($_SESSION["partner_id"]);
							
							$this->message = "Changement de partenaire effectué avec succès";
						}
						else{
							$this->message = "Cet utilisatuer déjà un partenaire";
						}
					}
					else{
						$this->message = "Cet utilisatuer n'existe pas";
					}
				}
				else{
					$this->message = "Vous avez déjà un partenaire";
				}
			}

			if(isset($_GET["forgetPartner"])){
				UserDAO::unbindPartners($_SESSION["user_id"], $_SESSION["partner_id"]);
				$_SESSION["partner_id"] = UserDAO::getUserPartnerId($_SESSION["user_id"]);
			}
		}
	}