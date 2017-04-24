<?php
ini_set('display_errors', 1);
session_start();

include '../../php/config.php';
include 'database.php';

if(!(empty($_POST['submit']))) {
  $_name = mysql_real_escape_string($_POST['name']);
  $_loginname = mysql_real_escape_string($_POST['loginname']);
  $_password = md5(mysql_real_escape_string($_POST['password']));
  $_rank = mysql_real_escape_string($_POST['rank']);
  if ($_rank === "Benutzer") {
    $_rank = "user";
  } else {
    $_rank = "admin";
  }
  
  $_sql = "INSERT INTO users (login, password, name, img_url, rank) VALUES ('" . $_loginname . "', '" . $_password . "', '" . $_name . "', '" . "img/" . $_loginname . ".png" . "', '" . $_rank . "')";
  $_res = mysql_query($_sql, $link);
  if ($_res === TRUE) {
    mysql_close($link);
    $_SESSION['create_user'] = "Der Benutzer wurde erfogreich erstellt!";
    header("Location: " . $network_path . "/Interface/settings.php");
  } else {
    $_SESSION['create_user'] = "Fehler beim erstellen des Benutzeraccounts!";
    header("Location: " . $network_path . "/Interface/settings.php");
  }
  echo $_SESSION['create_user'];
  echo $_name;
  echo $_loginname;
  echo $_password;
  echo $_rank;
} else {
  echo "Fehler";
}

mysql_close($link);
?>
