<?php

session_start();

include_once '../../php/config.php';
if (($_SESSION['login'])) {

} else {
  header("Location: " . $network_path);
}

?>
