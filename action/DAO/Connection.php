<?php

	class Connection {

		private static $connection;

		public static function getConnection() {
			if (Connection::$connection == null) {
                Connection::$connection = new mysqli(DB_SERVER_NAME, DB_USER, DB_PASS);
                if (Connection::$connection->connect_error) {
                    die("Connection failed: " . Connection::$connection->connect_error);
                } 
            }

            $sql = "CREATE DATABASE IF NOT EXISTS couplingdb";
            if (Connection::$connection->query($sql) === TRUE) {
                // echo "Database created successfully";
            } else {
                echo "Error creating database: " . Connection::$connection->error;
            }

            Connection::$connection->select_db(DB_NAME);
            

           

			return Connection::$connection;
		}

	}