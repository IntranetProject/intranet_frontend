<!--[if IE 9 ]><html class="ie9"><![endif]-->
<?php

include 'php/config.php';

$db_host = $__database_host;
$db_db = $__database;
$db_user = $__database_user;
$db_passwd = $__database_password;

$link = new mysqli($db_host, $db_user, $db_passwd, $db_db);
if ($link->connect_errno > 0) {
    die("Can't connect to Database! Check login credentials!" . $link->connect_errno);
}

$_sql = "SELECT * FROM users";
$_res = $link->query($_sql);
$_anzahl = $_res->num_rows;
  
if ($_anzahl <= 0) {
  $__system_setup_desc = "<p>It looks like your visiting the first time. You need to setup the Databases or have our script doing it for you. Just put in your MySQL-Logindata below and click on setup!<br>This will only create the tables that are nessesarry for the basic system. <br> For every module you have to run their special initial script! </p>";
  $__system_setup_title = "First Steps";
  $__system_setup_logindesc ="Enter the credentials for the admin user!";
  $__system_setup_timeinformation = "Start Setup! <small>Setup can take a while. Please stay patient!</small>";
  $__system_setup_configinfo = "Attention! You have to set your MySQL credentials in the config.php (Folder: /php/config.php) first! Otherwise the setup will not work!<br> After the setup is completed you can login with your credentials down below <br> After that you can create more users. <br> Visit: <a href=''#''>the documentation</a> for more information.";

  $initial_setup = true;
} else {
  $initial_setup = false;
  }

?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>Intranet - Login</title>
        <!-- Vendor CSS -->
        <link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <!-- CSS -->
        <link href="Interface/css/app_1.min.css" rel="stylesheet">
        <link href="Interface/css/app_2.min.css" rel="stylesheet">
        <style type="text/css">
            body {
                overflow: hidden !important;
            }

        </style>
    </head>
<!--hi-->
    <body>
        <?php
  if ($initial_setup == false) {
  echo '<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
      <form action="php/login.php" id="login_form" method="post" name="login_form">
        <div class="lcb-form">
          <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
              <input class="form-control" name="login_name" placeholder="Benutzer" type="text">
            </div>
          </div>
          <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
              <input class="form-control" name="password" placeholder="Passwort" type="password">
            </div>
          </div>
          <small>Intranet ' . $version . '</small>
          <a class="btn btn-login btn-default btn-float"><i class="zmdi zmdi-arrow-forward"></i></a> <input class="btn btn-login btn-default btn-float" name="submit" type="submit" value=" ">
        </div>
      </form>
    </div><!-- Register -->';
  } else {
      echo '<div style="margin: auto; width: 50%;">';
      echo '<h1>' . $__system_setup_title . '</h1>';
      echo $__system_setup_desc . '<hr>';
      echo $__system_setup_configinfo;
      echo '<div class="card" style="margin-top: 20px">
                <a href="php/setup.php" target="_blank">' . $__system_setup_timeinformation . '</a>
            </div>';
      echo '</div>';
  }
    ?>

            </div>
            <!-- Older IE warning message -->
            <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>   
        <![endif]-->
            <!-- Javascript Libraries -->
            <script src="Interface/vendors/bower_components/jquery/dist/jquery.min.js">


            </script>
            <script src="Interface/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js">


            </script>
            <script src="Interface/vendors/bower_components/Waves/dist/waves.min.js">


            </script>
            <!-- Placeholder for IE9 -->
            <!--[if IE 9 ]>
            <script src="Interface/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

            <script src="Interface/js/app.min.js">


            </script>
    </body>

    </html>
