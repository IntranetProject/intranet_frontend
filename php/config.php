<?php
$version = "v0.0.4";

$network_path = "//server/";
$language_files = "DE";

$__database_host = "localhost";
$__database_user = "root";
$__database_password = "root";
$__database = "Intranet";


// Expert Options only! :)

// for debugging:
ini_set('display_errors', 0);

// including the systems language variables
include_once 'language/' . $language_files . '.php';

// including language files for the modules (if some installed)
$dir = "../../Interface/modules/language/*";
foreach (glob($dir) as $file) {
  if (!is_dir($file)) {
    if (substr(basename($file),0,strlen($language_files)) === $language_files) {
      include_once $file;
    }
  }
}
?>