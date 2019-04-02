<?php
	require_once("action/DAO/Connection.php");

	class UserDAO {

		public static function authenticate($username, $password) {
			$connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM users WHERE username = ?");
            $statement->bind_param("s", $username);
			$statement->execute();
			$result = $statement->get_result();
			
			$username = null;
			
			if ( $result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ($password === $row["pwd"]) {
						$name = $row["firstname"];
					}
				}
			}

			return $name;
		}

		public static function verifyUsernameUnicity($username){
			$connection = Connection::getConnection();

			$statement = $connection->prepare("SELECT * FROM users WHERE username = ?");
            $statement->bind_param("s", $username);
			$statement->execute();
			$result = $statement->get_result();

			$validUsername = true;
			
			if ( $result->num_rows > 0) {
				$validUsername = false;
			}

			$statement->close();

			return $validUsername;
		}

		public static function insertNewUser($username, $firstname, $lastname, $email, $password) {
			$connection = Connection::getConnection();

			$statement = $connection->prepare("INSERT INTO users (username, firstname, lastname, email, pwd) VALUES (?, ?, ?, ?, ?)");
			$statement->bind_param("sssss", $username, $firstname, $lastname, $email, $password);
			$statement->execute();
			$result = $statement->get_result();
			echo $result;

			$statement->close();
			return $result;
		}
	}