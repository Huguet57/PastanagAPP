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
		<link rel="stylesheet" href="./css/login.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
		
		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<header>
					<h2>Pastanaga Assassina</h2>
					<h3>Facultat de Matemàtiques i Estadística - Tardor 2023</h3>
				</header>
				<form action="./php/login.php" method="POST">
					<input type="hidden" name="user" id="user">

					<!-- MD Search Box -->
					<div class="md-google-search__metacontainer">
					  <div class="md-google-search__container">
						<div class="md-google-search">
						  <span class="md-google-search__search-btn">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="-5px" width="34px" height="34px" viewBox="0 0 37.334 37.334" style="enable-background:new 0 0 37.334 37.334;" xml:space="preserve">
								<path d="M14.747735023498535,19.041818022727966 H4.063735008239746 c0,-2.1760001182556152 1.4279999732971191,-4.031000137329102 3.436000108718872,-4.767000198364258 c-0.4309999942779541,-0.43799999356269836 -0.7440000176429749,-1.1039999723434448 -0.9010000228881836,-2.1089999675750732 c-0.2070000022649765,0.041999999433755875 -0.527999997138977,-0.19499999284744263 -0.6230000257492065,-0.5559999942779541 c-0.09700000286102295,-0.367000013589859 -0.1599999964237213,-0.9599999785423279 0.04899999871850014,-1.0169999599456787 c0.06199999898672104,-0.017000000923871994 0.12700000405311584,-0.004999999888241291 0.1899999976158142,0.02800000086426735 V9.600818037986755 c0,-1.6059999465942383 -0.3779999911785126,-2.549999952316284 2.246999979019165,-2.819000005722046 l-0.023000000044703484,-0.006000000052154064 c0,0 2.069000005722046,-0.19900000095367432 2.614000082015991,-0.6890000104904175 c0,0 0.014999999664723873,0.414000004529953 0.23499999940395355,0.8679999709129333 c1.2109999656677246,0.46399998664855957 1.3630000352859497,1.5369999408721924 1.3279999494552612,2.6470000743865967 v1.0210000276565552 c0.06400000303983688,-0.032999999821186066 0.1289999932050705,-0.04500000178813934 0.19099999964237213,-0.02800000086426735 c0.20900000631809235,0.05700000002980232 0.09799999743700027,0.671999990940094 0.0020000000949949026,1.0410000085830688 c-0.09399999678134918,0.3569999933242798 -0.36500000953674316,0.5699999928474426 -0.5699999928474426,0.5320000052452087 c-0.15299999713897705,0.9570000171661377 -0.48899999260902405,1.6440000534057617 -0.9549999833106995,2.1010000705718994 C13.306735038757324,14.995816588401794 14.747735023498535,16.85381829738617 14.747735023498535,19.041818022727966 zM37.17073059082031,0.5408166646957397 v24.33300018310547 H-0.16326531767845154 V0.5408166646957397 H37.17073059082031 zM35.17073059082031,2.5408166646957397 H1.836734652519226 v20.33300018310547 h33.33399963378906 V2.5408166646957397 zM32.50373077392578,6.5408161878585815 H17.670734405517578 v2 h14.833000183105469 V6.5408161878585815 zM32.50373077392578,11.707816481590271 H17.670734405517578 v2 h14.833000183105469 V11.707816481590271 zM32.50373077392578,16.87581765651703 H17.670734405517578 v2 h14.833000183105469 V16.87581765651703 z" id="svg_3"/>
							</svg>
						  </span>
						  <div class="md-google-search__field-container">
							<input id="search-input" class="md-google-search__field" required autocomplete="off" placeholder="Introdueix el teu nom..." value="" name="search" type="text" spellcheck="false" style="outline: none;">
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
					<input type="submit" value="Entrar" id="submit" />
				</form>
				
				<p>La primera persona que entri al teu compte tindrà l'oportunitat de canviar la contrasenya.</p>
				<a href="./ranking.php">Anar al rànquing</a><br />
				<a href="./cementery.php">Anar al cementiri</a>
			</div>
		</div>

		<script src="./js/autocomplete.js"></script>
		<script>
			fetch("./ajax/getusers.php").then(result => result.json()).then(users => {
				autocomplete(document.getElementById("search-input"), users, "search");
				console.log(users);
				
				userid = <?=isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : -1 ?>;
				username = get_user_name(users, userid);
				if (userid > 0) $("#search-input").prop("placeholder", username);
			});
			
			$(document).ready(function() {
				// Notify of messages
				if (getUrlParameter("passwordchanged")) read_message("La teva clau d'accés ha canviat", "error");
				if (getUrlParameter("wrongpassword")) read_message("La clau d'accés no és correcta", "error");
				if (getUrlParameter("wronguser")) read_message("El nom ha estat mal introduït", "error");
			});
		</script>
	</body>
</html>
