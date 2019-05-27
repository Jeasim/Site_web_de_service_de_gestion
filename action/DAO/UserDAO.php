<?php
	require_once("action/DAO/Connection.php");
	
	class UserDAO {
		
		private static function select($table, $field, $constraint){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT * FROM $table WHERE $field = ?");
            $statement->bind_param("s", $constraint);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();
			
			return $result;
		}

		private static function selectWith2Constraints($table, $field1, $constraint1, $field2, $constraint2){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT * FROM $table WHERE $field1 = ? AND $field2 = ?");
            $statement->bind_param("ss", $constraint1, $constraint2);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();
			
			return $result;
		}

		private static function selectFor2Users($table, $userID, $partnerID){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT DISTINCT * FROM $table WHERE id_owner = ? OR id_owner = ?");
            $statement->bind_param("ii", $userID, $partnerID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();
			
			return $result;
		}

		public static function insertNewUser($username, $firstname, $lastname, $email, $password) {
			$connection = Connection::getConnection();

			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$statement = $connection->prepare("INSERT INTO users (username, firstname, lastname, email, pwd) VALUES (?, ?, ?, ?, ?)");
			// $statement->bind_param("sssss", $username, $firstname, $lastname, $email, $hashedPassword);
			$statement->bind_param("sssss", $username, $firstname, $lastname, $email, $password);

			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return $result;
		}


		public static function insertNewList($userID, $title) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("INSERT INTO lists (id_owner, title) VALUES (?, ?)");
			$statement->bind_param("is", $userID, $title);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return $result;
		}

		public static function insertNewListElement($listTitle, $element, $userID) {
			$connection = Connection::getConnection();

			$listIDResult = self::select("lists", "title", $listTitle);
			$listID = self::fetchData($listIDResult, "id");

			$statement = $connection->prepare("INSERT INTO list_elements (id_owner, element, id_list) VALUES (?, ?, ?)");
			$statement->bind_param("isi", $userID, $element, $listID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return $result;
		}

		public static function insertNewExpense($description, $place, $price, $ownerID, $date, $typeID) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("INSERT INTO expenses (id_owner, description, price, place, date_of_purchase, id_type) VALUES (?, ?, ?, ?, ?, ?)");
			$statement->bind_param("isdssi", $ownerID, $description, $price, $place, $date, $typeID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return $result;
		}

		public static function deleteExpense($expenseID){
			$connection = Connection::getConnection();

			$statement = $connection->prepare("DELETE FROM expenses WHERE id = ?");
			$statement->bind_param("i", $expenseID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return $result;
		}

		public static function fetchUsersLists($userID, $partnerID) {
			$result = self::selectFor2Users("lists", $userID, $partnerID);
			$listNames = self::fetchMultipleData($result, "title");

			return $listNames;
		}


		private static function fetchData($result, $field){
			if($row = $result->fetch_assoc()) {
				$data = $row[$field];
			}
		
			return $data;
		}

		private static function fetchMultipleData($result, $field){
			$data = [];

			while($row = $result->fetch_assoc()) {
				$data[] = $row[$field];
			}
		
			return $data;
		}

		private static function fetchAllData($result){
			$data = [];
			
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
		
			return $data;
		}

		private static function checkValidity($result){
			return ( $result->num_rows > 0) ? true : false;
		}

		public static function verifyUsername($username) {
			$result = self::select("users", "username", $username);
			return self::checkValidity($result);
		}

		public static function verifyListTitle($listTitle){
			$result = self::selectWith2Constraints("lists", "title", $listTitle, "id_owner", $_SESSION["user_id"]);
			return self::checkValidity($result);
		}

		public static function verifyPassword($username, $password) {
			$result = self::select("users", "username", $username);
			$hashedPassword = self::fetchData($result, "pwd");
			
			return true;
			// return password_verify($password, $hashedPassword);
		}

		public static function verifyEmail($email) {
			$result = self::select("users", "email", $email);
			return self::checkValidity($result);
		}

		public static function getFirstname($username) {
			$selectResult = self::select("users", "username", $username);
			return self::fetchData($selectResult, "firstname");
		}

		public static function getFirstnameFromID($userID) {
			$selectResult = self::select("users", "id", $userID);
			return self::fetchData($selectResult, "firstname");
		}

		public static function getUserId($username) {
			$selectResult = self::select("users", "username", $username);
			return self::fetchData($selectResult, "id");
		}

		public static function getUserPartnerId($userID){
			$selectResult = self::select("users", "id", $userID);
			return self::fetchData($selectResult, "id_partner");
		}

		public static function getListTitles($userID, $partnerID){
			$selectResult = self::selectFor2Users("lists", "id_owner", $userID, $partnerID);
			return self::fetchMultipleData($selectResult, "title");			
		}

		public static function getListElementsByTitle($title){
			$listID = self::getListID($title);

			$selectResult = self::select("list_elements", "id_list", $listID);
			return self::fetchMultipleData($selectResult, "element");
		}

		public static function getListID($listTitle){
			$selectResult = self::select("lists", "title", $listTitle);
			return self::fetchData($selectResult, "id");
		}

		public static function getAllListsTitles($userID, $partnerID){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT DISTINCT * FROM lists WHERE id_owner = ? OR id_owner = ?");
            $statement->bind_param("ii", $userID, $partnerID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return self::fetchMultipleData($result, "title");
		}

		public static function getExpenses($userID, $partnerID){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT DISTINCT id, FORMAT(price, 2), description, place, id_owner, date_of_purchase, creation_date, id_type FROM expenses WHERE id_owner = ? OR id_owner = ?");
            $statement->bind_param("ii", $userID, $partnerID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			$data = [];
			
			while($row = $result->fetch_assoc()) {
				$row["type"] = self::getTypeFromID($row["id_type"]);	
				$row["price"] = $row["FORMAT(price, 2)"];
				$row["firstname"] =  self::getFirstnameFromID($row['id_owner']);
				$data[] = $row;
			}

			return $data;
		}

		public static function getExpensesSum($userID){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT FORMAT(SUM(price), 2) FROM expenses WHERE id_owner = ?");
            $statement->bind_param("i", $userID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			return self::fetchData($result, "FORMAT(SUM(price), 2)");
		}

		public static function verifyUserExistence($username){
			$result = self::select("users", "username", $username);
			return self::checkValidity($result);
		}

		public static function verifyUserAlreadyPartnered($searchedUserID){
			$result = self::select("users", "id", $searchedUserID);
			$partnerID = self::fetchData($result, "id_partner");
			return ($partnerID == 0) ? false : true;
		}

		public static function bindPartners($userID, $partnerID){
			self::updatePartenerID($partnerID, $userID);
			self::updatePartenerID($userID, $partnerID);
		}

		public static function unbindPartners($userID, $partnerID){
			self::updatePartenerID($partnerID, 0);
			self::updatePartenerID($userID, 0);
		}

		public static function updatePartenerID($userID, $updatedPartnerID){
			$connection = Connection::getConnection();
			
			$statement = $connection->prepare("UPDATE users SET id_partner = ? WHERE id = ?");
            $statement->bind_param("ii", $updatedPartnerID, $userID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();
		}

		public static function getTypeID($type){
			$result = self::select("expense_types", "type", $type);
			return self::fetchData($result, "id");
		}

		public static function getTypeFromID($typeID){
			$result = self::select("expense_types", "id", $typeID);
			return self::fetchData($result, "type");
		}

		public static function getExpenseTypes(){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT * FROM expense_types");
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();

			$data = [];

			while($row = $result->fetch_assoc()) {
				$data[] = $row["type"];
			}
		
			return $data;
		}

		public static function getExpensesByType($type){
			$typeID = self::getTypeID($type);
			$result = self::select("expenses", "id_type", $typeID);
			return self::fetchAllData($result);
		}

		public static function getExpense($expenseID){
			$result = self::select("expenses", "id", $expenseID);
			return self::fetchAllData($result);
		}

		public static function updateExpence($expenseID, $description, $place, $price, $owner, $date, $typeID){
			$connection = Connection::getConnection();
			
			$statement = $connection->prepare("UPDATE expenses SET id_owner = ?, description = ?, price = ?, place = ?, date_of_purchase = ?, id_type = ? WHERE id = ?");
            $statement->bind_param("isdssii", $owner, $description, $price, $place, $date, $typeID, $expenseID);
			$statement->execute();
			$result = $statement->get_result();
			$statement->close();
		}
}