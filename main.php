<?php	
	require './credentials.php';
	require './php/utils.php';
	
	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;
	
	date_default_timezone_set("Europe/Berlin");
	
	$user = $_COOKIE['user']; // (int)$_POST['user'];
	$password = $_COOKIE['password']; // isset($_POST['password']) ? md5($_POST['password']) : '';

	if (!isset($_COOKIE['user']) or $_COOKIE['user'] == '') {
		die("<script>window.location.href = './'</script>");
	} else if (isset($_COOKIE['password'])) {
		$query_password = "SELECT password FROM $usersdb WHERE id=$user";
		if (query($query_password)->fetch_row()[0] != $password) {
			// Unset variables
			setcookie('user', '', -1, "/");
			setcookie('password', '', -1, "/");
			
			die("<script>window.location.href = './?passwordchanged=1'</script>");
		}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PastanagAPP</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="https://api.myjson.com/bins/u6r41">

		<!-- Apple web app -->
		<link rel="apple-touch-icon" href="./bin/images/icons/icon-72x72.png">
		<meta name="apple-mobile-web-app-title" content="PastanagAPP">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="green">


		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/main.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>

		<?php
			$user = get_users($user);
			$victim = get_users($user->quimata);
			if ($user->mort) die("<script>window.location.href = './dead.php'</script>");
			
			$bits = dec2bits($user->bits);	
			$bit_counter = 0;
		?>

		<script>
			let user = {
				'id': <?=(int)$user->id?>,
				'quimata': <?=(int)$user->quimata?>,
				'requested': <?=(int)$user->requested?>,
				'mort': <?=(int)$user->mort?>,

				'nom': "<?=$user->nomcomplet?>",
				'curs': <?=(int)$user->curs?>,
				'grau': <?=(int)$user->grau?>
			};
		</script>

	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<a href="./" class="goback">Canvi d'usuari</a><br />
				<h2>Hola <name id="user_name"><?=$user->nom()?></name>,</h2>

				<div class="formulari_contrasenya">
					<p>Sembla que no tens clau d'accés, la gent podrà entrar al teu compte...</p>
					<form action="./php/change_password.php" method="POST">
						<input type="hidden" value="<?=$user->id?>" name="userid">
						<input type="password" placeholder="Nova clau d'accés..." name="password" /><br />
						<input type="password" placeholder="Repeteix la clau d'accés" name="confirmation"/><br />
						<input type="submit" value="Posar clau d'accés">
					</form>
				</div>

				<p>La teva víctima és:</p>

				<div class="victima">
					<table>
						<tr>
							<td class="table_img">
								<div id="victim_img">
									<div class="grid-container">
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>  
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>  
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
										  <div class="grid-item <?=(int)$bits[$bit_counter++] ? 'black' : ''?>"></div>
									</div>
								</div>
							</td>
							<td class="table_text">
								<div id="victim_name"><?=$victim->nomcomplet?></div>
								<div id="victim_curs_i_grau">
									<span id="victim_curs"><?=$victim->nomcurs()?></span>
									-
									<span id="victim_grau"><?=$victim->nomgrau()?></span>
								</div>
								<div id="butons" class="options">
									<button id="win" onclick="js: send_request(user, 'REQ KILL');">L'he matat</button>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="message-board">
					<form action="./php/send_thread.php">
						<input type="text" placeholder="Que es cagui de por" />
						<input type="submit" value="Enviar amenaça" />
					</form>
				</div>
				
				<div>
					<p>Podeu posar aquesta pàgina com a icona apretant el botó de "Add to Home Screen" del vostre navegador.</p>
					<a href="./ranking.php">Anar al rànquing</a>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function() {
				// Set interval of checking
				let checking = setInterval(function() { update_info(user); }, 1500);
				// Set to hidden or not the password prompt
				if (<?=$user->md5password=="" ? 1 : 0?>) {
					$.notify("No tens clau d'accés", "info");
					$(".formulari_contrasenya").show();
				}
				// Notify of messages
				if (getUrlParameter("wrongconfirmation")) read_message("Les contrasenyes no coincideixen", "error");
				if (getUrlParameter("errordb")) read_message("Hi ha hagut un problema a la base de dades, torna-ho a intentar", "error");
				if (getUrlParameter("successpassword")) read_message("La teva clau d'accés s'ha guardat", "success");
			});
		</script>
	</body>
</html>
