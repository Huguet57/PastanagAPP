<?php
	date_default_timezone_set("Europe/Berlin");

	// Forget cookies
	setcookie('user', '', -1, "/");
	setcookie('password', '', -1, "/");
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>PastanagAPP - Mort/a</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="./css/basic.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
		
		<script src="./js/utils.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h1>Estàs mort/a!</h1>
				<p>Torna a la pàgina principal.</p>
				<a href="./">Go back</a>
				<a href="./ranking.php">Anar al rànquing</a>
			</div>
		</div>
	</body>
</html>

