<?php	
	require '../credentials.php';
	require '../php/utils.php';
	
	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;
	
	date_default_timezone_set("Europe/Berlin");
	
	$user = $_COOKIE['user']; // (int)$_POST['user'];
	$password = $_COOKIE['password']; // isset($_POST['password']) ? md5($_POST['password']) : '';

	if (!isset($_COOKIE['user']) or $_COOKIE['user'] == '') {
		die("<script>window.location.href = '../main.php'</script>");
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
    <meta name="viewport" content="width=device-width">
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="./jquery.signaturepad.min.js"></script> 
	<script src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
	<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

	<script src="utils.js"></script>
	<script src="../js/utils.js"></script>
	<script src="../js/animations.js"></script>

	<?php
		$user = get_users($user);
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
		
		console.log(user);
	</script>
    
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<link rel="stylesheet" href="./sign.css" />
</head>

<body>

<div id="outter-container">
	<div id="inner-container">
		<header>
			<div id="leftlinks"></div>
			<div id="rightlinks"><a href="../main.php">Tornar a la p&agrave;gina principal</a></div>
		</header>
		
		<div id="table-container">
		    <div id="explanationArea">
		        <h2>Dibuixa la teva firma</h2>
		        <p>Aquesta firma aparaixer&agrave; en el cementiri al costat de cada v&iacute;ctima que matis.</p>
		    </div>
		    
		    <div id="oldsignatureArea">
		        <div class="hasoldsignature" style="<? if (!file_exists("../bin/images/signatures/" . md5($user->id) . ".png")) echo "display: none;"; ?>">
		            <div class="imgcontainer">
		                <img id="oldsign" src="../bin/images/signatures/<?=md5($user->id)?>.png?<?=time()?>" />
		            </div>
		            <p>Aquesta &eacute;s la teva firma. Si la vols canviar dibuixa'n una de nova:</p>
		        </div>
		    </div>
		    
			<div id="signArea" >
    			
    			<div class="sig sigWrapper" style="height:auto;">
    				<div class="typed"></div>
    				<canvas class="sign-pad" id="sign-pad" width="200px" height="125px"></canvas>
    			</div>
    			
    			<div class="flexbreak"></div>
    			
    			<div class="button-container">
        			<button id="btnSaveSign">Guarda</button>
        			<button id="clearCanvas">Cancel&middot;la</button>
    			</div>
    		</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function() {
        
		var pad = $('#signArea').signaturePad({
			drawOnly:true,
			penWidth : 5,
			lineColour : '#fff',
			penColour : '#ff1a1a',
			onDrawEnd: function () {
			    console.log('Draw ended.');
			}
		});
		
		$("#clearCanvas").click(function() {
        	pad.clearCanvas();
        });
        
        $("#btnSaveSign").click(function(e){
        	html2canvas([document.getElementById('sign-pad')], {
        		onrendered: function (canvas) {
					// Save
					let img = pad.getSignatureImage();
            		save2Image(img, user["id"]);
                    
					// Clear
					$("#clearCanvas").click();
					
					// Change signature
					$('#oldsign').fadeOut('slow', function() {
					    $('.hasoldsignature')[0].style.display = 'block';
					    document.getElementById('oldsign').src = img;
					    $('#oldsign').fadeIn();
					});
					
					// Inform
					read_message("Firma guardada", "success");
        		}
        	});
        });
	});
</script>

</body>
</html>
