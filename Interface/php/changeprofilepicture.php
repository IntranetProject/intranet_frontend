<?php
include '../../php/config.php';
session_start();

$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";

        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if($imageFileType == ".png") {
    echo "Sorry, only PNG files are allowed.";
    $uploadOk = 0;
}
echo "<br>" . $target_file . "<br>";
if ($uploadOk == 0) {
    $_SESSION['change_profile'] = "Es gibt einen Fehler. Überprüfe deine Angaben!";
    header('Location: ' . $network_path . 'Intranet/Interface/settings.php');
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. <br>";
        rename($target_file, $target_dir . ($_SESSION['loginname']) . ".png");
        $_SESSION['img_url'] = "img/" . $_SESSION['loginname'] . ".png";
        $_SESSION['change_profile'] = "Dein Profilbild wurde geupdated!";
        header('Location: ' . $network_path . 'Intranet/Interface/settings.php');
    } else {
        $_SESSION['change_profile'] = "Es gibt einen Fehler. Überprüfe deine Angaben!";
        header('Location: ' . $network_path . 'Intranet/Interface/settings.php');
    }
}

 ?>
