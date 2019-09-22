<?php
	require '../credentials.php';
	require '../php/utils.php';
	$user = get_users($_POST['id']);

	echo json_encode($user);
?>
