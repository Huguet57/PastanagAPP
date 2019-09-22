<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de benvinguda</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/login.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h1>Introdueix el teu nom</h1>
				<p>Per entrar al joc de la Pastanaga Assessina</p>
				<form action="./php/login.php" method="POST">
					<input type="hidden" name="user" id="user">

					<!-- MD Search Box -->
			    <div class="md-google-search__metacontainer">
			      <div class="md-google-search__container">
			        <div class="md-google-search">
			          <span class="md-google-search__search-btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
			          </span>
			          <div class="md-google-search__field-container">
			            <input id="search-input" class="md-google-search__field" autocomplete="off" placeholder="Usuari" value="" name="search" type="text" spellcheck="false" style="outline: none;">
			          </div>
			          <span class="md-google-search__empty-btn" style="display: none;">
			            <svg focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
			          </span>
			        </div>
			      </div>

						<div class="autocomplete-container" style="display: none;">
				      <div id="autocomplete-list" class="autocomplete-items"></div>
				    </div>
			    </div>

					<input disabled required placeholder="Clau d'accés..." id="password" type="password" name="password"/>
					<input type="submit" value="Entrar" />
				</form>
			</div>
		</div>

		<script src="./js/autocomplete.js"></script>
		<script>
			fetch("./ajax/getusers.php").then(result => result.json()).then(users => {
				console.log(users);
				autocomplete(document.getElementById("search-input"), users, "search");

				userid = <?=isset($_COOKIE['user']) ? $_COOKIE['user'] : -1 ?>;
				username = $('option[value=' + userid + ']').text();

				if (userid > 0) {
					redir = confirm("Has entrat com a usuari " + username + " anteriorment, vols tornar-ho a fer?");
					if (redir) window.location.href = 'main.php';
				}
			}).catch(error => {
				console.error(error);
			});

			$(document).ready(function() {
				// Notify of messages
				if (getUrlParameter("passwordchanged")) read_message("La teva clau d'accés ha canviat", "error");
				if (getUrlParameter("wrongpassword")) read_message("La clau d'accés no és correcta", "error");
			});
		</script>
	</body>
</html>
