<?php
  require '../credentials.php';
  require 'utils.php';

  $credentials = new Credentials();

  $victimid = $_POST["victim-id"];
  $killerid = $_POST["killer-id"];
  $msgcontent = $_POST["msg-content"];
  
  $template = "INSERT INTO messages VALUES (NULL, $killerid, $victimid, NULL, '$msgcontent')";
  if (!query($template)) die("An error ocurred." . $template);
  
  header("Location: http://pastanagapp2020.mygamesonline.org/main.php");
?>
