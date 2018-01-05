<?php
ini_set('display_errors', 1);
session_start();

include '../../php/config.php';
include 'database.php';

if(!(empty($_POST['submit']))) {
  $_id = mysql_real_escape_string($_POST['id']);

  $_sql = "DELETE FROM users WHERE id='" . $_id . "'";
  $_res = mysql_query($_sql, $link);
  if ($_res > 0) {
    mysql_close($link);
    $_SESSION['create_user'] = "Der Benutzer wurde erfogreich gelöscht!";
    header("Location: " . $network_path . "/Interface/settings.php");
  } else {
    $_SESSION['create_user'] = "Fehler Keinen Benutzer mit der ID gefunden";
    header("Location: " . $network_path . "/Interface/settings.php");
  }
} else {
  echo "Fehler";
}

mysql_close($link);
?>
