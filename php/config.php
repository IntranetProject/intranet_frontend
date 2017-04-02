<?php
$version = "v0.0.6";

$network_path = "//server/";

// currently available: de = German; en = English;
$language = "de";

$__database_host = "localhost";
$__database_user = "root";
$__database_password = "root";
$__database = "Intranet";


// Expert Options only! :)

// for debugging:
ini_set('display_errors', 0);

// including language files for the modules (if some installed)
$link = mysql_connect($__database_host, $__database_user, $__database_password);
if (!$link) {
  die("Keine Datenbankverbindung möglich: " . mysql_error());
}

$datenbank = mysql_select_db($__database, $link);
if (!$datenbank) {
  echo "Kann die Datenbank nicht nutzten: " . mysql_error();
  mysql_close($link);
  exit;
}


$sql = "SELECT * FROM `system_vars_" . $language . "`";
$res = mysql_query($sql, $link);
$amount = @mysql_num_rows($res);
  
if ($amount > 0) {
  while ($row = mysql_fetch_assoc($res)) {
    $_SESSION[$row['var']] = utf8_encode($row['value']);
  }
}

?>