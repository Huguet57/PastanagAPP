<?php
	require '../credentials.php';
	require '../php/utils.php';
	
	$dbname = $_GET['dbname'];
	$mortsname = $dbname . "_morts"; 
	
	$queries = ["CREATE TABLE `$dbname` (
	  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	  `curs` tinyint(1) NOT NULL,
	  `grau` tinyint(1) NOT NULL,
	  `quimata` int(11) NOT NULL,
	  `requested` tinyint(1) NOT NULL DEFAULT 0,
	  `mort` tinyint(1) NOT NULL DEFAULT 0,
	  `password` varchar(100) NOT NULL DEFAULT '',
	  `bits` int(3) NOT NULL
	)",
	"CREATE TABLE `$mortsname` (
	  `id` int(11) NOT NULL,
	  `quimatava` int(11) NOT NULL,
	  `assassi` int(11) NOT NULL,
	  `curs` tinyint(1) NOT NULL,
	  `grau` tinyint(1) NOT NULL,
	  `data` timestamp NOT NULL DEFAULT current_timestamp()
	)"];
	
	foreach ($queries as $query) if (!query($query)) die('An error ocurred. ' . $query);
	die("<script>window.location.href = './?dbname=$dbname'</script>");
?>
