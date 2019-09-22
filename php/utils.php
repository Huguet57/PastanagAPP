<?php
	class User{
		public $id;
		public $nomcomplet;
		public $curs;
		public $grau;
		public $quimata;

		public function nom() {
			$noms = explode(" ", $this->nomcomplet);
			return $noms[0];
		}
	}

	function query($query) {
		// Create connection
		$credentials = new Credentials();
		$conn = new mysqli($credentials->servername, $credentials->username, $credentials->password, $credentials->dbname);
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		$conn->set_charset("utf8");

		// Execute query and save result
		if (!$result = $conn->query($query)) echo $conn->error;

		// Close the connection
		$conn->close();

		// Return result of query
		return $result;
	}

	function get_users($id = 0) {
		$users = [];

		// Prepare the query
		$query = "SELECT * FROM users";
		if ($id > 0) $query .= " WHERE id=".$id;

		// Fetch the information of the user
		if ($result = query($query)) {
			while ($row = $result->fetch_row()) {
				$user = new User();

				$user->id = $row[0];
				$user->nomcomplet = $row[1];
				$user->curs = $row[2];
				$user->grau = $row[3];
				$user->quimata = $row[4];
				$user->requested = $row[5];
				$user->mort = $row[6];
				$user->md5password = $row[7];

				array_push($users, $user);
			}
			$result->close();
		} else {
			die("Query failed: " . $query);
		}

		if ($id > 0) return $users[0];
		else return $users;
	}
?>
