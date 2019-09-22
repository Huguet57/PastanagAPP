<?php
	require './credentials.php';
	require './php/utils.php';

	if (!isset($_COOKIE['user'])) {
		header("Location: ./index.php");
		die();
	} else if (isset($_COOKIE['password'])) {
		$query_password = "SELECT password FROM users WHERE id=" . (int)$_COOKIE['user'];
		if (query($query_password)->fetch_row()[0] != $_COOKIE['password']) {
			// Unset variables
			setcookie('user', '', -1, "/");
			setcookie('password', '', -1, "/");

			header("Location: ./index.php?passwordchanged=1");
			die();
		}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de l'usuari</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/main.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>

		<?php
			$user = get_users($_COOKIE['user']);
			$victim = get_users($user->quimata);
			if ($user->mort) header("Location: ./dead.php");
		?>

		<script>
			let user = {
				'id': <?=(int)$user->id?>,
				'quimata': <?=(int)$user->quimata?>,
				'requested': <?=(int)$user->requested?>,
				'mort': <?=(int)$user->mort?>,
				'nom': "<?=sanitize_html($user->nomcomplet)?>",
				'curs': <?=(int)$user->curs?>,
				'grau': <?=(int)$user->grau?>
			};
		</script>

	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h2>Hola <name id="user_name"><?=sanitize_html($user->nom())?></name>,</h2>

				<div class="formulari_contrasenya" style="display: none;">
					<p>Sembla que no tens clau d'accés, la gent podrà entrar a la teva compta...</p>
					<form action="./php/change_password.php" method="POST">
						<input type="hidden" value="<?=(int)$_COOKIE['user']?>" name="userid">
						<input type="password" placeholder="Nova clau d'accés..." name="password" /><br />
						<input type="password" placeholder="Repeteix la clau d'accés" name="confirmation"/><br />
						<input type="submit">
					</form>
				</div>

				<p>La teva víctima és:</p>

        <div class="victima">
          <table id="victim_info">
            <tr>
              <td><img id="victim_img" src="https://picsum.photos/id/<?=(int)$victim->id?>/200/200" /></td>
              <td>
                <div id="victim_name"><?=sanitize_html($victim->nomcomplet)?></div>
                <div id="victim_curs_i_grau">
                  <span id="victim_curs"><?=(int)$victim->curs?></span>
                  -
                  <span id="victim_grau"><?=(int)$victim->grau?></span>
                </div>
                <div id="butons" class="options">
                  <button id="win" onclick="js: send_request(user, 'REQ KILL');">L'he matat</button>
                </div>
              </td>
            </tr>
          </table>
				</div>
    
			</div>
		</div>

		<script>
			$(document).ready(function() {
				// Set interval of checking
				let checking = setInterval(function() { update_info(user); }, 1500);
				// Set to hidden or not the password prompt
				if (<?=$user->md5password == "" ? 1 : 0?>) {
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
