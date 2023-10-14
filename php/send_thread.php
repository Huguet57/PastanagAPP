<?php
  require '../credentials.php';
  require 'utils.php';

  $credentials = new Credentials();

  $victimid = $_POST["victim-id"];
  $killerid = $_POST["killer-id"];
  $msgcontent = $_POST["msg-content"];
  
  $template = "INSERT INTO `missatges` (`id`, `sender_id`, `receiver_id`, `timestamp`, `content`) VALUES (NULL, $killerid, $victimid, CURRENT_TIMESTAMP, '$msgcontent')";
  if (!query($template)) die("An error ocurred." . $template);
  
  // header("Location: ../main.php");
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
?>
