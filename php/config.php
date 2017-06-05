<?php
$version = "v0.0.21";

$network_path = "//server/IntraDev";
$modules_path = "../Interface/modules";

// currently available: de = German; en = English;
$language = "en";

$__database_host = "localhost";
$__database_user = "root";
$__database_password = "root";
$__database = "Intranet2";

$restapi = true;
// Expert Options only! :)

// for debugging:
ini_set('display_errors', 0);

// including language files for the modules (if some installed)
$link = new mysqli($__database_host, $__database_user, $__database_password, $__database);

if ($link->connect_errno > 0) {
    die("Can't connect to Database! Check login credentials!" . $link->connect_errno);
}

$sql = "SELECT * FROM `system_vars_" . $language . "`";

$result = $link->query($sql);
if ($result == true) {
    $amount = $result->num_rows;
    if ($amount > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION[$row['var']] = utf8_encode($row['value']);
    }
        mysqli_close($link);
    }
} else {
    $initial_setup = true;
}
