<?php
ini_set('display_errors', 1);

session_start();

include 'database.php';
include '../../php/config.php';

if(!(empty($_POST['submit']))) {
  if (isset($_POST['loginname']) && isset($_POST['name']) && isset($_POST['password'])) {
    $_loginname = (mysql_real_escape_string($_POST['loginname']));
    $_name = (mysql_real_escape_string($_POST['name']));
    $_password = (mysql_real_escape_string($_POST['password']));

    echo $_loginname . ";" . $_name . ";" . $_password;
    
    $_sql = "UPDATE users SET login ='" . $_loginname . "', password ='" . md5($_password) . "', name ='" . $_name . "', img_url='img/" . $_loginname . ".png' WHERE login = '" . $_SESSION['loginname'] . "';";
    $_res = mysql_query($_sql, $link);

    if ($_res === TRUE) {
      echo "Success!";
      rename("../img/" . ($_SESSION['loginname']) . ".png", "../img/" . ($_loginname) . ".png");
      $_SESSION['img_url'] = "img/" . $_loginname . ".png";
      $_SESSION['loginname'] = $_loginname;
      $_SESSION['name'] = $_name;
      $_SESSION['change_profile'] = "Dein Profil wurde geupdated!";
      header('Location: ' . $network_path . '/Interface/settings.php');
    } else {
      echo "Failed!";
      $_SESSION['change_profile'] = "Es gibt einen Fehler. Bitte übprüfe deine Angaben!";
    }
  }
} else {
  echo "Empty post";
}
mysql_close($link);
?>
