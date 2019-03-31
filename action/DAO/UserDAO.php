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

		public static function getProfile($username) {
			$connection = Connection::getConnection();

			$info = "";

			if ($username == "john") {
				$info = "info@john.com";
			}

			return $info;
		}
	}