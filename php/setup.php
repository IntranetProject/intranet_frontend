<?php
include 'config.php';

$db_host = $__database_host;
$db_db = $__database;
$db_user = $__database_user;
$db_passwd = $__database_password;

$link = mysql_connect($db_host, $db_user, $db_passwd);
if (!$link) {
  die("Can't connect to Database: " . mysql_error());
}

$datenbank = mysql_select_db($db_db, $link);
if (!$datenbank) {
  echo "Can't use the Database: " . mysql_error();
  mysql_close($link);
  exit;
}
if(!(empty($_POST['submit']))) {
  $_name = mysql_real_escape_string($_POST['name']);
  $_loginname = mysql_real_escape_string($_POST['loginname']);
  $_password = md5(mysql_real_escape_string($_POST['password']));
} else {
	header('Location: ' . $network_path);
}
$_sql = "CREATE TABLE IF NOT EXISTS `users` (
 `id` int(100) NOT NULL AUTO_INCREMENT,
 `login` varchar(50) NOT NULL,
 `password` varchar(100) NOT NULL,
 `name` varchar(50) NOT NULL,
 `img_url` varchar(50) NOT NULL,
 `rank` varchar(5) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1";
$_res = mysql_query($_sql, $link);

$sql = "INSERT INTO `users` (`login`, `password`, `name`, `ìmg_url`, `rank`) VALUES (`" . $_loginname . "`, `" . $_password . "`, `" . $_name . "`, `img/" . $_loginname . ".png`, `admin`);"

$res = mysql_query($sql, $link);

header('Location: ' . $network_path);
?>