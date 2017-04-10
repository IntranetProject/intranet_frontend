<?php
session_start();

include '../php/config.php';
if (($_SESSION['login'])) {

} else {
  header("Location: " . $network_path);
}
?>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Intranet - Dashboard</title><!-- Vendor CSS -->
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
          <a class="media" data-ma-action="submenu-toggle" href="#"><img alt="" class="pull-left" src="<?php echo $_SESSION['img_url'] ?>">
          <div class="media-body">
            <?php echo $_SESSION['name'] ?>
          </div></a>
          <ul>
            <li>
              <a href="settings.php"><?php echo $_SESSION['system_index_settings']; ?></a>
            </li>
            <li>
              <a href="php/logout.php"><?php echo $_SESSION['system_index_logout']; ?></a>
            </li>
          </ul>
        </li>
        <li class="active">
          <a href="index.php"><i class="zmdi zmdi-home"></i><?php echo $_SESSION['system_index_dashboard']; ?></a>
        </li>
        <?php
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
          <h2>Dashboard</h2>
          <?php
          $dir = "modules/php/*";
          foreach (glob($dir) as $file) {
            if (!is_dir($file)) {
              if (substr(basename($file),0,strlen('interface_')) === 'interface_') {
                include($file);
              }
            }
          }
          ?>
          
      </div>
    </section>
  </section>
  <footer id="footer">
    Copyright &copy; 2017 Intranet <?php echo $version;?>
  </footer><!-- Page Loader -->
  <div class="page-loader">
    <div class="preloader pls-white">
      <svg class="pl-circular" viewbox="25 25 50 50">
      <circle class="plc-path" cx="50" cy="50" r="20"></circle></svg>
      <p>Please wait...</p>
    </div>
  </div><!-- Older IE warning message -->
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