<head>

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<link rel="stylesheet" href="../css/basic.css" />
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="./xat.css" />
                
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
		die("<script>window.location.href = '../'</script>");
	} else if (isset($_COOKIE['password'])) {
		$query_password = "SELECT password FROM $usersdb WHERE id=$user";
		if (query($query_password)->fetch_row()[0] != $password) {
			// Unset variables
			setcookie('user', '', -1, "/");
			setcookie('password', '', -1, "/");
			
			die("<script>window.location.href = '../?passwordchanged=1'</script>");
		}
	}
?>


<?php
        $user = get_users($user);
        $victim = get_users($user->quimata);
        if ($user->mort) die("<script>window.location.href = '../dead.php'</script>");
?>

<?php
        // Create connection
        $credentials = new Credentials();
        $conn = new mysqli($credentials->servername, $credentials->username, $credentials->password, $credentials->dbname);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $conn->set_charset("utf8mb4");
                                            
        $query_quielmata = "SELECT id FROM `$credentials->usersdb` WHERE quimata = " . $user->id;
        $quielmata = $conn->query($query_quielmata)->fetch_row()[0];
        
        // Execute query and save result
        $query_msgs = "SELECT * FROM `missatges` WHERE (`sender_id` = ".$user->id." AND `receiver_id` = ".$quielmata .
                ") OR (`sender_id` = ".$quielmata." AND `receiver_id` = ".$user->id . ")";
        $result = $conn->query($query_msgs);
?>


		<meta charset="UTF-8">
		<title>PastanagAPP</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="manifest" href="https://api.myjson.com/bins/u6r41">

		<!-- Apple web app -->
		<link rel="apple-touch-icon" href="../bin/images/icons/icon-72x72.png">
		<meta name="apple-mobile-web-app-title" content="PastanagAPP">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="green">
</head>
<body>
        <div id="outter-container">
                <div id="inner-container">
                        <div><a href="../main.php">Tornar a la pàgina principal</a></div>
                        
                        <hr />
                        
                        <div id="message-board">
                        <div id="victim-messages">
                                <div class="messages-sent" id="xat">
                                        <?php
                                                while($res = $result->fetch_row()) {
                                                    $ismine = $res[1] == $user->id;
                                                    
                                                    echo ($ismine) ? "<div class='msg from-me'>" : "<div class='msg to-me'>";
                                                    echo "<div class='msg-content'>$res[4]</div>";
                                                    echo "<div class='meta-data'><span class='timestamp'>$res[3]</span>";
                                                    echo ($ismine) ? "<span class='seen'>".($res[5] == 0 ? 'Enviat' : 'Vist')."</span>" : "<span class='seen'>".($res[5] == 0 ? 'Nou!' : '')."</span>";
                                                    echo "</div></div>";
                                                }
                                        ?>
                                </div>
                                <form action="../php/send_thread.php" method="POST">
                                        <input type="text" name="msg-content" placeholder="" />
                                        <input type="hidden" name="killer-id" value="<?=(int)$user->id?>">
                                        <input type="hidden" name="victim-id" value="<?=$quielmata?>">
                                        <input type="hidden" name="origin" value="killer">
                                        <input type="submit" value="&#10145;&#65039;" />
                                </form>
                        </div>
                        
                        </div>

                </div>
        </div>
        
        <?php
                // Update 'seen' messages
                $query_seen = "UPDATE missatges SET `seen` = 1 WHERE `receiver_id` = " . $user->id . " AND `sender_id` != " . $user->quimata;
                $conn->query($query_seen);
                
                // Close the connection 
                $conn->close();
        ?>
        
        <script>
            document.getElementById('xat').scrollTop = document.getElementById('xat').scrollHeight;
        </script>
</body>