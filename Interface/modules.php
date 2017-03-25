<?php
session_start();
if (($_SESSION['login'])) {

} else {
  header("Location: //server");
}
?>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:Bold">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:500">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:lighter">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="expires" content="0">
    <script src="https://use.fontawesome.com/859b637378.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Intranet - Module</title>
</head>
<body>
  <div id="action-leiste">
      <div class="action-button" id="logout-button"><a style="text-decoration: none; color: white;"href="php/logout.php">Ausloggen</a></div>
  </div>
  <nav id="nav">
    <ul rel="navigation">
        <li id="nav-mobile-button">Navigation</li>
        <img src="<?php echo $_SESSION['img_url'] ?>" class="profile-img" alt="Profilbild">
        <div id="profile-name"><?php echo $_SESSION['name'] ?></div>
        <li class="nav-li"><i class="fa fa-dashboard"></i><a style="color: white; text-decoration: none;" href="index.php">&nbsp;&nbsp;Startseite</a></li>
        <li class="nav-li"><i class="fa fa-sliders"></i><a style="color: white; text-decoration: none;" href="settings.php">&nbsp;&nbsp;Einstellungen</a></li>
        <li class="nav-li nav-active"><i class="fa fa-object-group"></i><a style="color: white; text-decoration: none;" href="modules.php">&nbsp;&nbsp;Module</a></li>
        <?php
        $dir = "modules/*";
        foreach (glob($dir) as $file) {
          if (!is_dir($file)) {
            echo "<li class='nav-li'><i class='fa fa-object-group'></i><a style='color: white; text-decoration: none;' href='modules/" . basename($file) . "'>&nbsp;&nbsp;" . basename($file, ".php") . "</a></li>";
          }
        }
         ?>
    </ul>
  </nav>
    <div class="main-container">
        <div class="content">
            <div class="board-title">Module</div>
            <div class="info-text">Hier sind alle Module, welche in deinem System installiert sind. Du kannst sie deaktivieren, oder welche hinzufügen.</div>
            <div class="container100percent border-bottom-gray">
                <div class="container12-5percent">
                    <div class="module-text"><b>Modulname</b></div>
                </div>
            </div>
            <?php
            $dir = "modules/*";
            foreach (glob($dir) as $file) {
              if (!is_dir($file)) {
                echo '<div class="container100percent border">
                    <div class="container12-5percent">
                        <div style="padding-left: 30px; text-align: left;" class="module-text font12">' . basename($file, ".php") . '</div>
                    </div>
                </div>';
              }
            }
             ?>
        </div>
    </div>
</body>
</html>
