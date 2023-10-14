<?php

	function nomcurs($curs) {
		if ($curs == 1) return "1r";
		if ($curs == 2) return "2n";
		if ($curs == 3) return "3r";
		if ($curs == 4) return "4t";
		if ($curs == 5) return "5è";
		if ($curs == 6) return "6è";
		if ($curs == 7) return "7è";
		if ($curs == 8) return "8è";	
	}
	
	function nomgrau($grau) {
		if ($grau == 0) return "MAT";
		if ($grau == 1) return "EST";
		if ($grau == 2) return "MÀST";
		if ($grau == 3) return "DAD";
	}

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
		
		public function nomcurs() {
			return nomcurs($this->curs);
		}
		
		public function nomgrau() {
			return nomgrau($this->grau);
		}
	}
	
	function query($query) {
		// Create connection
		$credentials = new Credentials();
		$conn = new mysqli($credentials->servername, $credentials->username, $credentials->password, $credentials->dbname);
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		$conn->set_charset("utf8mb4");
		
		// Execute query and save result
		$result = $conn->query($query);
		
		// Close the connection 
		$conn->close();
		
		// Return result of query
		return $result;
	}
	
	function get_users($id = 0, $getAsObjects = true) {
		$users = [];
		
		$credentials = new Credentials();
		$usersdb = $credentials->usersdb;
		$mortsdb = $credentials->mortsdb;
		
		// Prepare the query
		$query = "SELECT * FROM $usersdb";
		if ($id > 0) $query .= " WHERE id=".$id;

		// Fetch the information of the user
		if ($result = query($query)) {
			while ($row = $result->fetch_row()) {
				if ($getAsObjects) {
					$user = new User();
					$user->id = (int)$row[0];
					$user->nomcomplet = $row[1];
					$user->curs = (int)$row[2];
					$user->grau = (int)$row[3];
					$user->quimata = (int)$row[4];
					$user->requested = (int)$row[5];
					$user->mort = (int)$row[6];
					$user->md5password = $row[7];
					$user->bits = $row[8];
				} else {
					$user = [];
					$user["id"] = (int)$row[0];
					$user["nomcomplet"] = $row[1];
					$user["curs"] = (int)$row[2];
					$user["grau"] = (int)$row[3];
					$user["quimata"] = (int)$row[4];
					$user["requested"] = (int)$row[5];
					$user["mort"] = (int)$row[6];
					$user["md5password"] = $row[7];
					$user["bits"] = $row[8];
				}
				
				array_push($users, $user);
			}
			$result->close();
		} else {
			die("Query failed: " . $query);
		}
		
		if ($id > 0) return $users[0];
		else return $users;
	}
	
	// Number n to XXXXXXXXX with X = {0,1} binary format
	function dec2bits($code) {
		$bits = decbin($code);
		while (strlen($bits) < 9) $bits = '0' . $bits;
		return $bits;
	}
?>
