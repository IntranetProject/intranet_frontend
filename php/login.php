<?php

session_start();

include 'config.php';

$db_host = $__database_host;
$db_db = $__database;
$db_user = $__database_user;
$db_passwd = $__database_password;

$link = new mysqli($db_host, $db_user, $db_passwd, $db_db);

if ($link->connect_errno > 0) {
    die("Can't connect to Database! Check login credentials!" . $link->connect_errno);
}

if(!(empty($_POST['submit']))) {
  echo "Post is not empty!";
  $_username = $link->real_escape_string($_POST['login_name']);
  $_passwort = $link->real_escape_string(md5($_POST['password']));

  $_sql = "SELECT * FROM users WHERE login='" . $_username . "' AND password='" . $_passwort . "' LIMIT 1";
  $_res = $link->query($_sql);
  $_amount = $_res->num_rows;
  
  if ($_amount > 0) {
    $_SESSION['login'] = 1; 
    while ($row = $_res->fetch_assoc()) {
      $_SESSION['rank'] = $row['rank'];
      $_SESSION['loginname'] = $row['login'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['img_url'] = $row['img_url'];
    }
    mysqli_close($link);
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
  mysqli_close($link);
  exit;
}

mysqli_close($link);
?>
