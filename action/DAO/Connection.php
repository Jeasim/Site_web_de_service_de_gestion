<?php

	class Connection {

		private static $connection;

		public static function getConnection() {
			if (Connection::$connection == null) {
                $dsn = "mysql:host=localhost:1999;dbname:couplingdb";

				Connection::$connection = new PDO("oci:dbname=" . DB_NAME, DB_USER, DB_PASS);
				Connection::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				Connection::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            
            $query = "CREATE TABLE ALLO";
            $sql = "SHOW databases";
            $result = Connection::$connection->query($query);
            
            echo $result->num_rows;

			return Connection::$connection;
		}

		/*
		public static function closeConnection() {
			Connection::$connection = null;
		}*/
	}