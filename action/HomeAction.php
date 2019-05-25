<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class HomeAction extends CommonAction {

		public $partnerID = null;
		public $message = "";

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER, "Home");
		}

		protected function executeAction() {

			if(!empty($_GET["partner-username-search"])){

				if(!UserDAO::verifyUserAlreadyPartnered($_SESSION["user_id"])){
				$searchedUsername = $_GET["partner-username-search"];

					if(UserDAO::verifyUserExistence($searchedUsername)){
						$searchedUserID = UserDAO::getUserId($searchedUsername);

						if(!UserDAO::verifyUserAlreadyPartnered($searchedUserID)){
							$this->message = "libre";
							UserDAO::bindPartners($_SESSION["user_id"], $searchedUserID);
							self::reaasignPartnerValues();
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
				self::reaasignPartnerValues();
			}
		}

		private function reaasignPartnerValues(){
			$_SESSION["partner_id"] = UserDAO::getUserPartnerId($_SESSION["user_id"]);
		}
	}