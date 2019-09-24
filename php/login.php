<?php
	require '../credentials.php';
	require 'utils.php';

	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;

	// Set the 'user' POST and COOKIE variable
	$user = '';
	if (isset($_POST['user'])) $user = $_POST['user'];
	else if (isset($_COOKIE['user'])) $user = $_COOKIE['user'];
	else {
		die("<script>window.location.href = '../index.php'</script>");
	}
	
	// Check if password is correct
	$query_password = "SELECT password FROM $usersdb WHERE id=".$user;
	$real_password = query($query_password)->fetch_row()[0];
	
	// Prioritize input rather than memory
	$password = '';
	if (isset($_POST['password'])) $password = $_POST['password'];
	else if (isset($_COOKIE['password'])) $password = $_COOKIE['password'];
	
	// Redirect if wrong
	if ($real_password != "" && $real_password != md5($password)) {
		// Forget cookies
		setcookie('user', '', -1, "/");
		setcookie('password', '', -1, "/");
		
		die("<script>window.location.href = '../index.php?wrongpassword=1'</script>");
	}
	
	// Save variables as cookies
	setcookie('user', $user, time() + (86400 * 10), "/");
	if ($real_password != "") setcookie('password', md5($password), time() + (86400 * 10), "/");
	else setcookie('password', '', -1, "/");
	
	// Success, proceed to main page
	die("<script>window.location.href = '../main.php';</script>");
?>
