<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($restapi == true) {
        if (isset($_GET['id'])) {
            $result = getByID((int) $_GET['id']);
        }
        if (isset($_GET['name'])) {
            $result = getByName($_GET['name']);
        }
        if (isset($_GET['all'])) {
            $result = getAll();
        }
    } else {
        $result = "REST API is deactivated by the Admin.";
    }
} else {
    echo "No get.";
}

header('HTTP/1.0 200 OK');
header('Content-Type: application/json');
echo json_encode($result);

function getByID($id) {
    require '../config.php';
    $link = new mysqli($__database_host, $__database_user, $__database_password, $__database);
    $sql = "SELECT * FROM users WHERE id='$id'";
    $res = $link->query($sql);
    $amount = $res->num_rows;
    if ($amount > 0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            return $row;    
        }
        mysqli_close($link);
        return "mysql error";
    } else {
        return "Error 404. User with id ". $id . " not found!";
    }
}
function getByName($name) {
    require '../config.php';
    $link = new mysqli($__database_host, $__database_user, $__database_password, $__database);
    $sql = "SELECT * FROM users WHERE login='$name'";
    $res = $link->query($sql);
    $amount = $res->num_rows;
    if ($amount > 0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            return $row;    
        }
        mysqli_close($link);
        return "mysql error";
    } else {
        return "Error 404. User with name ". $name . " not found!";
    }
}
function getAll() {
    require '../config.php';
    $link = new mysqli($__database_host, $__database_user, $__database_password, $__database);
    $sql = "SELECT * FROM users";
    $res = $link->query($sql);
    $amount = $res->num_rows;
    $resu = Array();
    if ($amount > 0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            array_push($resu, $row);
        }
        mysqli_close($link);
        return $resu;
    } else {
        return "Error 404. No users found!";
    }
}
?>
