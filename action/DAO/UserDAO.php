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
		
		private static function fetchData($result, $field){
			while($row = $result->fetch_assoc()) {
				$data = $row[$field];
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
	}