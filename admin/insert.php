<?php
	require '../credentials.php';
	require '../php/utils.php';

	$csvname = $_FILES['csvname']['tmp_name'];
	$dbname = $_POST['dbname'];

	// Read from CSV
	$inscrits = array_map('str_getcsv', file($csvname));
	array_shift($inscrits); // remove header

	$used = [];
	$permutation = [];
	$numinscrits = count($inscrits);
	$start = true;
	$i = 0;
	$to = 1;
	while ($to !== 1 || $start) {
		$start = false;
		$from = $to;
		if ($i == $numinscrits - 1) {
			$to = 1;
		}
		else {
			do {
				$to = random_int(2, $numinscrits);
			} while (in_array($to, $used));
		}

		$used[] = $to;
		$permutation[$from] = $to;
		$i++;
	}

	foreach ($inscrits as $i => $user) {
		$template = "INSERT INTO `".$dbname."` (`nom`, `curs`, `grau`, `quimata`, `requested`, `mort`, `password`)" .
					" VALUES ('".$user[0]."', ".(int)$user[1].", ".(int)$user[2].", ".(int)$permutation[$i+1].", 0, 0, '')";

		if (!query($template)) die("An error ocurred.");
	}

	header("Location: ./index.php");
?>
