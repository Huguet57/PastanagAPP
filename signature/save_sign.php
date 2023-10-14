<?php
	$img_data = $_POST['img_data'];
	$id = $_POST['id'];
		
    $filename = '../bin/images/signatures/' . md5($id) . '.png';
    file_put_contents($filename, base64_decode($img_data));
?>
