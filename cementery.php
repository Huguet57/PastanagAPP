<html>
<head>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<link rel="stylesheet" href="./css/cementery.css?v=1.1" />
</head>

<body>

<?php
	require './credentials.php';
	require './php/utils.php';
	
	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;
    
	$getcementery = "SELECT $mortsdb.id AS id, $usersdb.nom AS nom, $usersdb.grau AS grau, $usersdb.curs AS curs, $mortsdb.data AS timestamp, $mortsdb.assassi AS assassi
	                FROM $mortsdb INNER JOIN $usersdb ON $mortsdb.id = $usersdb.id
	                ORDER BY timestamp DESC";
	
	$results = query($getcementery);
?>

<div id="outter-container">
	<div id="inner-container">
		<header>
			<div id="leftlinks"></div>
			<div id="rightlinks"><a href="./main.php">Tornar a la pàgina principal</a></div>
		</header>
		
		<div id="table-container">
			<table id="cementery" cellspacing="0" cellpadding="0">
				<?php
					$id = 0;
					$i = 1;
					
					while ($row = $results->fetch_object()) {
						echo "<tr id='$row->id'>";
						
						$unix = strtotime($row->timestamp);
						$day = date('j', $unix);
						$weekdaynum = date('N', $unix);
						$weekday = "";
						if ($weekdaynum == 1) $weekday = "Dilluns";
						if ($weekdaynum == 2) $weekday = "Dimarts";
						if ($weekdaynum == 3) $weekday = "Dimecres";
						if ($weekdaynum == 4) $weekday = "Dijous";
						if ($weekdaynum == 5) $weekday = "Divendres";
						if ($weekdaynum == 6) $weekday = "Dissabte";
						if ($weekdaynum == 7) $weekday = "Diumenge";
						$monthnum = date('m', $unix);
						$month = "";
						if ($monthnum == 9) $month = "de Setembre";
						if ($monthnum == 10) $month = "d'Octubre";
						$year2num = date('y', $unix);
						$hour = date('H', $unix);
						$min = date('i', $unix);
						
						echo "<td class='name'><div class='tombstone'>
						            <div class='photo'>
						                <img src='./bin/images/users/" . $row->id . ".jpg' style='-webkit-filter: grayscale(100%); filter: grayscale(100%);' />
						            </div>
						            <div class='usergeneralinfo'>
									    <div class='username'>$row->nom</div>
									    <div class='userinfo'>".nomcurs($row->curs)." - ".nomgrau($row->grau)."</div>
    									<div class='timestamp'>
    									    <span class='day'>$day</span>/<span class='month'>$monthnum</span>/<span class='year'>$year2num</span>
    									    <span class='hour'>$hour</span>:<span class='min'>$min</span>
    									</div>
									</div>
									<div class='firma'>
									    <img src='./bin/images/signatures/" . md5($row->assassi) . ".png' />
									</div>
								</div></td>";
						echo "</tr>";
						
						$i = $i + 1;
					}
				?>
			</table>
		</div>
	</div>
</div>

<script>
</script>

</body>
</html>
