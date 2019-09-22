<?php
	require '../credentials.php';
	require '../php/utils.php';
	$user = get_users($_POST['id']);
	
	$text_columns = ["nomcomplet", "md5password"];
	
	echo '{ ';
	$first = true;
	foreach ($user as $prop => $value) {
		if (!$first) echo ', ';
		else $first = false;
		if (in_array($prop, $text_columns)) echo '"'.$prop.'": "'.$value.'"';
		else echo '"'.$prop.'": '.$value;
	}
	echo ' }';
?>
