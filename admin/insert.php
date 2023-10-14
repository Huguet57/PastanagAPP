<?php
	require '../credentials.php';
	require '../php/utils.php';
	
	$csvname = $_FILES['csvname']['tmp_name'];
	$dbname = $_POST['dbname'];

	// Read from CSV
	$inscrits = array_map('str_getcsv', file($csvname));
	// array_shift($inscrits); // remove header
	// shuffle($inscrits); // shuffle randomly
	
	$start = 1;
	$i = $start;
	foreach ($inscrits as $user) {
		$i = ($i + 1) % ($start + count($inscrits));
		if ($i == 0) $i = $i + 1;
		// Input values into SQL values
		$template = "INSERT INTO `$dbname` (`id`, `nom`, `curs`, `grau`, `quimata`, `requested`, `mort`, `password`, `bits`)" .
					" VALUES (NULL, '$user[0]', '$user[1]', '$user[2]', $i, 0, 0, '', ".(int)rand(1,512).")";

		if (!query($template)) die("An error ocurred." . $template);
	}
	
	die("<script>window.location.href = './?successinserting'</script>");
?>
