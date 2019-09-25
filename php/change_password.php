<?php
	require '../credentials.php';
	require 'utils.php';

	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;

	date_default_timezone_set("Europe/Berlin");

	// Check if confirmation is the same
	if ($_POST['password'] != $_POST['confirmation']) {
		die("<script>window.location.href = '../main.php?wrongconfirmation=1'</script>");
	} else {
		// Execute query to change password
		$update_password = "UPDATE $usersdb SET password=\"".md5($_POST['password'])."\" WHERE id=".$_POST['userid'];
		if(!$result = query($update_password)) die("<script>window.location.href = '../main.php?errordb=1'</script>");
		
		// Save 'password' to cookies
		setcookie('password', md5($_POST['password']), time() + (86400 * 10), "/");
		
		// Go back to main page
		die("<script>window.location.href = '../main.php?successpassword=1'</script>");
	}
?>
