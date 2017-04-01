<?php
include '../php/config.php';

$db_host = $__database_host;
$db_db = $__database;
$db_user = $__database_user;
$db_passwd = $__database_password;

$link = mysql_connect($db_host, $db_user, $db_passwd);
if (!$link) {
  die("Keine Datenbankverbindung möglich: " . mysql_error());
}

$datenbank = mysql_select_db($db_db, $link);
if (!$datenbank) {
  echo "Kann die Datenbank nicht nutzten: " . mysql_error();
  mysql_close($link);
  exit;
}
?>
