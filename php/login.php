<?php

session_start();

include 'config.php';

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

if(!(empty($_POST['submit']))) {
  echo "Post is not empty!";
  $_username = mysql_real_escape_string($_POST['login_name']);
  $_passwort = mysql_real_escape_string(md5($_POST['password']));

  $_sql = "SELECT * FROM users WHERE login='" . $_username . "' AND password='" . $_passwort . "' LIMIT 1";
  $_res = mysql_query($_sql, $link);
  $_anzahl = @mysql_num_rows($_res);
  
  if ($_anzahl > 0) {
    $_SESSION['login'] = 1; 
    while ($row = mysql_fetch_assoc($_res)) {
      $_SESSION['rank'] = $row['rank'];
      $_SESSION['loginname'] = $row['login'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['img_url'] = $row['img_url'];
    }
    mysql_close($link);
    header("Location: " . $network_path . "Intranet/Interface/index.php");
  } else {
    $_SESSION['login_error_message'] = "Fehler beim einloggern. Bitte überprüfe deine Daten.";
    header("Location: " . $network_path . "Intranet");
  }
} else {
  echo "Post is empty!";
}


if ($_SESSION['login'] == 1) {
  header("Location: " . $network_path . "Intranet/Interface/index.php");
  mysql_close($link);
  exit;
}

mysql_close($link);
?>
