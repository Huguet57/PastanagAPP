<?php
	require '../credentials.php';
	require '../php/utils.php';
	
	$user = get_users($_GET['userid']);
	if ($user->mort) die();
	$victim = get_users($user->quimata);
	
	$bits = dec2bits($user->bits);
	$bit_counter = 0;
?>

<table id="victim_info">
	<tr>
		<td class="table_img">
			<div id="victim_img">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_01_01.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h0v0" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_01_02.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h1v0" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_01_03.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h2v0" /></td>
					</tr>
					<tr>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_02_01.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h0v1" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_02_02.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h1v1" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_02_03.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h2v1" /></td>
					</tr>
					<tr>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_03_01.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h0v2" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_03_02.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h1v2" /></td>
						<td><img src="./bin/images/imgs/<?=$victim->id?>/slice_03_03.png" width="33" class="<?=(int)$bits[$bit_counter++] ? 'black' : ''?> h2v2" /></td>
					</tr>
				</table>
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
