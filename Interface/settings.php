<?php
session_start();

include_once '../php/config.php';
if (($_SESSION['login'])) {

} else {
  header("Location: " . $network_path);
}
?><!--[if IE 9 ]><html class="ie9"><![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Intanet - Settings</title><!-- Vendor CSS -->
  <link href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
  <link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
  <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
  <link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
  <link href="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"><!-- CSS -->
  <link href="css/app_1.min.css" rel="stylesheet">
  <link href="css/app_2.min.css" rel="stylesheet">
  <style type="text/css">
    ::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>
<body>
  <header class="clearfix" id="header">
    <ul class="h-inner">
      <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
        <div class="line-wrap">
          <div class="line top"></div>
          <div class="line center"></div>
          <div class="line bottom"></div>
        </div>
      </li>
      <li class="hi-logo hidden-xs">
        <a href="index.php">Intranet</a>
      </li>
      <li class="pull-right">
        <ul class="hi-menu">
          <li class="dropdown">
            <a data-toggle="dropdown" href="#"><i class="him-icon zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
              <li class="hidden-xs">
                <a data-ma-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i><?php echo $_SESSION['system_index_togglefullscreen']; ?></a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul><!-- Top Search Content -->
  </header>
  <section id="main">
    <aside class="sidebar c-overflow" id="sidebar">
      <ul class="main-menu">
        <li class="mm-profile sub-menu">
          <a class="media" data-ma-action="submenu-toggle" href="#"><img alt="" class="pull-left" src="<?php echo $_SESSION['img_url']; ?>">
          <div class="media-body">
            <?php echo $_SESSION['name'] ?>
          </div></a>
          <ul>
            <li class="active">
              <a href="settings.php"><?php echo $_SESSION['system_index_settings']; ?></a>
            </li>
            <li>
              <a href="php/logout.php"><?php echo $_SESSION['system_index_logout']; ?></a>
            </li>
          </ul>
        </li>
        <li>
          <a href="index.php"><i class="zmdi zmdi-home"></i><?php echo $_SESSION['system_index_dashboard']; ?></a>
        </li><?php
                  $dir = "modules/*";
                  foreach (glob($dir) as $file) {
                    if (!is_dir($file)) {
                      if (basename(__FILE__, '.php') == basename($file, '.php')) {
                        echo "<li class='active'><a href='modules/" . basename($file) . "'>" . basename($file, ".php") . "<i class='zmdi zmdi-badge-check'></i></a></li>";
                      } else {
                        echo "<li><a href='modules/" . basename($file) . "'>" . basename($file, ".php") . "<i class='zmdi zmdi-badge-check'></i></a></li>";
                      }
                    }
                  }
                   ?>
          <li>
            <a href="stats.php"><i class="zmdi zmdi-reader"></i><?php echo $_SESSION['system_index_stats']; ?></a>
          </li>
      </ul>
    </aside>
    <section id="content">
      <div class="container">
        <div class="block-header"></div>
                <?php
                if (isset($_SESSION['change_profile'])) {
                  if (strpos($_SESSION['change_profile'], 'Fehler.') === false) {
                    echo '<div class="card"><div class="card-body card-padding bgm-teal c-white">' . $_SESSION['change_profile'] . '</div></div>';
                  } else {
                    echo '<div class="card"><div class="card-body card-padding bgm-pink c-white">' . $_SESSION['change_profile'] . '</div></div>';
                  }
                unset($_SESSION['change_profile']);
                }
                if (isset($_SESSION['create_user'])) {
                  if (strpos($_SESSION['create_user'], 'Fehler') === false) {
                    echo '<div class="card"><div class="card-body card-padding bgm-teal c-white">' . $_SESSION['create_user'] . '</div></div>';
                  } else {
                    echo '<div class="card"><div class="card-body card-padding bgm-pink c-white">' . $_SESSION['create_user'] . '</div></div>';
                  }
                  unset($_SESSION['create_user']);
                }
                ?>
        <h2><?php echo $_SESSION['system_settings_title']; ?></h2>
        <div class="card">
          <div class="card-header">
            <h2><?php echo $_SESSION['system_settings_privatetitle']; ?><small><?php echo $_SESSION['system_settings_privatdesc']; ?></small></h2>
          </div>
          <div class="card-body card-padding">
            <form action="php/saveoptions.php" class="row" method="POST" role="form">
              <div class="col-sm-3">
                <div class="form-group fg-line">
                  <label class="sr-only" for="change_name">Email address</label> <input class="form-control input-sm" id="change_name" name="name" placeholder="Name" type="text" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group fg-line">
                  <label class="sr-only" for="change_login">Password</label> <input class="form-control input-sm" id="change_login" name="loginname" placeholder="Login Name" type="text" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group fg-line">
                  <label class="sr-only" for="change_password">Password</label> <input class="form-control input-sm" id="change_password" name="password" placeholder="Passwort" type="password" required>
                </div>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-default btn-file m-r-10 waves-effect" name="submit" type="sumbit" value=" "><?php echo $_SESSION['system_settings_save']; ?></button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2><?php echo $_SESSION['system_settings_pictitle']; ?><small><?php echo $_SESSION['system_settings_picdesc']; ?></small></h2>
          </div>
          <div class="card-body card-padding">
            <form action="php/changeprofilepicture.php" enctype="multipart/form-data" method="post" class="row" role="form" >
              <div class="col-sm-2">
                <div class="form-group fg-line">
                  <input class="form-control input-sm" name="fileToUpload" id="fileToUpload" type="file" required>
                </div>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-default btn-file m-r-10 waves-effect" name="submit" type="sumbit" value=" "><?php echo $_SESSION['system_settings_save']; ?></button>
              </div>
            </form>
          </div>
        </div>
        <?php
        if ($_SESSION['rank'] == "admin") {
        echo '<div class="card">';
          echo '<div class="card-header">';
            echo '<h2>' . $_SESSION['system_settings_usermanagment'] . '<small> ' . $_SESSION['system_settings_usermanagmentdesc'] . '</small><small>' . $_SESSION['system_settings_usermanagment_adduser'] . '</small></h2>';
          echo '</div>';
          echo '<div class="card-body card-padding"><form class="row" role="form" action="php/createuser.php" method="POST">';
            echo '<div class="col-sm-2"><div class="form-group fg-line"><label class="sr-only" for="create_name">Name</label> <input class="form-control input-sm" id="create_name" name="name" placeholder="Name" type="text" required></div></div>';
            echo '<div class="col-sm-2"><div class="form-group fg-line"><label class="sr-only" for="create_loginname">Loginname</label> <input class="form-control input-sm" id="create_loginname" name="loginname" placeholder="Loginname" type="text" required></div></div>';
            echo '<div class="col-sm-2"><div class="form-group fg-line"><label class="sr-only" for="create_password">Passwort</label> <input class="form-control input-sm" id="create_password" name="password" placeholder="Passwort" type="text" required></div></div>';
            echo '<div class="col-sm-2"><div class="select"><select class="form-control" name="rank" required><option>Benutzer</option><option>Admin</option></select></div></div>';
            echo '<div class="col-sm-2"><button class="btn btn-default btn-file m-r-10 waves-effect" name="submit" type="sumbit" value=" ">Speichern!</button></div>';
          echo '</form>';
        echo '</div></div>';
        
        echo '<div class="card">';
          echo '<div class="card-header">';
            echo '<h2>' . $_SESSION['system_settings_usermanagment_userlisttitle'] . '<small>' . $_SESSION['system_settings_usermanagment_userlistsmall'] . '</small></h2>';
          echo '</div>';
          echo '<div class="card-body card-padding table-reponsive">';
            echo '<table class="table">';
              echo '<thead><tr><th>#</th><th>Name</th><th>Loginname</th><th>img_url</th><th>Rank</th></tr></thead>';
              echo '<tbody>';
              
              include '../php/config.php';

              $db_host = $__database_host;
              $db_db = $__database;
              $db_user = $__database_user;
              $db_passwd = $__database_password;
              
              $link = mysql_connect($db_host, $db_user, $db_passwd);
              if (!$link) {
                die("Keine Datenbankverbindung möglich: " . mysql_error());
              }
              
              $datenbank = mysql_select_db($db_db, $link);
              if (!$datenbank) {
                echo "Kann die Datenbank nicht nutzten: " . mysql_error();
                mysql_close($link);
                exit;
              }
              $_sql = "SELECT * FROM users";
              $_res = mysql_query($_sql, $link);
              $_anzahl = @mysql_num_rows($_res);
              
              $html = "";
              while ($row = mysql_fetch_assoc($_res)) {
                $html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['login'] . '</td><td>' . $row['img_url'] . '</td><td>' . $row['rank'] . '</td></tr>';
              }
              mysql_close($link);
              
              echo $html;
              
              echo '</tbody>';
            echo '</table>';
          echo '</div>';
        echo '</div>';
        }
        ?>
      </div>
    </section>
  </section>
  <footer id="footer">
    Copyright &copy; 2017 Intranet <?php echo $version;?>
  </footer><!-- Page Loader -->
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
  <script src="vendors/bower_components/jquery/dist/jquery.min.js">
  </script> 
  <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js">
  </script> 
  <script src="vendors/bower_components/flot/jquery.flot.js">
  </script> 
  <script src="vendors/bower_components/flot/jquery.flot.resize.js">
  </script> 
  <script src="vendors/bower_components/flot.curvedlines/curvedLines.js">
  </script> 
  <script src="vendors/sparklines/jquery.sparkline.min.js">
  </script> 
  <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js">
  </script> 
  <script src="vendors/bower_components/moment/min/moment.min.js">
  </script> 
  <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js">
  </script> 
  <script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js">
  </script> 
  <script src="vendors/bower_components/Waves/dist/waves.min.js">
  </script> 
  <script src="vendors/bootstrap-growl/bootstrap-growl.min.js">
  </script> 
  <script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js">
  </script> 
  <script src="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
  </script> <!-- Placeholder for IE9 -->
   <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
   
  <script src="js/app.min.js">
  </script>
</body>
</html>