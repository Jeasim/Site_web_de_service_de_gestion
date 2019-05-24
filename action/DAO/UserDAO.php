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
			$statement->bind_param("sssss", $username, $firstname, $lastname, $email, $hashedPassword);
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

		public static function insertNewExpense($description, $place, $price, $ownerID) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("INSERT INTO expenses (id_owner, description, price, place) VALUES (?, ?, ?, ?)");
			$statement->bind_param("isds", $ownerID, $description, $price, $place);
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
			
			return password_verify($password, $hashedPassword);
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
			$selectResult =  self::selectFor2Users("lists", "id_owner", $userID, $partnerID);
			return self::fetchMultipleData($selectResult, "title");
		}

		public static function getExpenses($userID, $partnerID){
			$selectResult =  self::selectFor2Users("expenses", "id_owner", $userID, $partnerID);

			$data = [];
			
			while($row = $selectResult->fetch_assoc()) {
				$row["firstname"] =  self::getFirstnameFromID($row['id_owner']);
				$data[] = $row;
			}

			return $data;
		}
	}