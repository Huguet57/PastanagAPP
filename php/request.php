<?php
	require '../credentials.php';
	require 'utils.php';

	// Do the query
	$queries = [""];
	$victimid = "ANY (SELECT quimata FROM (SELECT * FROM users) AS victims WHERE id=".(int)$_POST['user_id'].")";

	if ($_POST['msg'] == "REQ KILL") $queries = ["UPDATE users SET requested=1 WHERE id=".$victimid]; 						// request kill
	if ($_POST['msg'] == "REQ DEAD") $queries = ["UPDATE users SET requested=2 WHERE quimata=".(int)$_POST['user_id']]; 	// request dead
	if ($_POST['msg'] == "DENY REQ") $queries = ["UPDATE users SET requested=0 WHERE id=".(int)$_POST['user_id']]; 			// deny request
	if ($_POST['msg'] == "CONF DEAD") {
		$queries = ["INSERT INTO morts (id, quimatava, assassi, curs, grau) (SELECT id, quimata, (SELECT id FROM users WHERE quimata=".(int)$_POST['user_id']."), curs, grau FROM users WHERE id=".(int)$_POST['user_id'].")", 	// add to 'morts'
					"UPDATE users SET requested=0, quimata=".(int)$_POST['user_quimata']." WHERE quimata=".(int)$_POST['user_id'], 	// assign new victim to killer
					"UPDATE users SET quimata=0, mort=1 WHERE id=".(int)$_POST['user_id']]; 										// confirm victim dead/killed
	}
	// Fetch the information of the user
	foreach ($queries as $query) {
		if ($query != "" and $result = query($query)) echo $query;
		else die("Query failed: " . $query);
	}
?>
