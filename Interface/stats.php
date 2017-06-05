<?php
session_start();

include_once '../php/config.php';
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
        <title>Intranet - Stats</title>
        <!-- Vendor CSS -->
        <link href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
        <link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
        <!-- CSS -->
        <link href="css/app_1.min.css" rel="stylesheet">
        <link href="css/app_2.min.css" rel="stylesheet">
        <style type="text/css">
             ::-webkit-scrollbar {
                display: none;
            }

        </style>
        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
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
            </ul>
            <!-- Top Search Content -->
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
                                <a href="settings.php">
                                    <?php echo $_SESSION['system_index_settings']; ?>
                                </a>
                            </li>
                            <li>
                                <a href="php/logout.php">
                                    <?php echo $_SESSION['system_index_logout']; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php"><i class="zmdi zmdi-home"></i><?php echo $_SESSION['system_index_dashboard']; ?></a>
                    </li>
                    <?php
        $dir = $modules_path . "/*";
        foreach (glob($dir) as $file) {
            if (!is_dir($file)) {
              if (basename(__FILE__, '.php') == basename($file, '.php')) {
                echo "<li class='active'><a href='" . $modules_path . "/" . basename($file) . "'>" . basename($file, ".php") . "<i class='zmdi zmdi-badge-check'></i></a></li>";
              } else {
                echo "<li><a href='" . $modules_path . "/" . basename($file) . "'>" . basename($file, ".php") . "<i class='zmdi zmdi-badge-check'></i></a></li>";
              }
            }
          }
           ?>
                        <li class="active">
                            <a href="stats.php"><i class="zmdi zmdi-reader"></i><?php echo $_SESSION['system_index_stats']; ?></a>
                        </li>
                </ul>
            </aside>
            <section id="content">
                <div class="container">

                    <div class="card">
                        <div class="card-header">
                            <h2>Server Information <small><?php echo $_SESSION['system_stats_desc'] ?></small> </h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="epc-item card">
                                    <div class="easy-pie main-pie" data-percent="<?php $load = sys_getloadavg();
	echo $load[0];?>">
                                        <div class="percent">
                                            <?php $load = sys_getloadavg(); echo $load[0];?>
                                        </div>
                                        <div class="pie-title">CPU Average</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="epc-item card">
                                    <?php
                                    $free = shell_exec('free');
                                    $free = (string)trim($free);
                                    $free_arr = explode("\n", $free);
                                    $mem = explode(" ", $free_arr[1]);
                                    $mem = array_filter($mem);
                                    $mem = array_merge($mem);
                                    $memory_usage = $mem[2]/$mem[1]*100;
                                    $memory_usage = round($memory_usage, 1);
                                    ?>
                                        <div class="easy-pie main-pie" data-percent="<?php echo $memory_usage; ?>">
                                            <div class="percent">
                                                <?php echo $memory_usage;?>
                                            </div>
                                            <div class="pie-title">Free RAM</div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <?php
                                    $fh = fopen('/proc/meminfo','r');
                                    $mem = 0;
                                    while ($line = fgets($fh)) {
                                    $pieces = array();
                                    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                                        $mem = $pieces[1];
                                        break;
                                        }
                                    }
                                    fclose($fh); 
                                
                                    $usedrn = memory_get_usage();
                                    
                                    $usage = round((100 / ($mem * 1024)) * $usedrn, 2);
                                    
                                    ?>
                                    <div class="epc-item card">
                                        <div class="easy-pie main-pie" data-percent="<?php echo $usage; ?>">
                                            <div class="percent">
                                                <?php echo $usage; ?>
                                            </div>
                                            <div class="pie-title">Memory allocated by PHP</div>
                                        </div>
                                    </div>
                            </div>

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Intranet Information<small>Detailed Information about the current configuration from your Intranet</small></h2>
                        </div>
                        <div class="card-body card-padding">
                            <h4>Intranet information</h4>
                            <p class="stats-modules-text" id="vrs_num">Version:
                                <?php echo $version; ?>
                            </p>
                            <p class="stats-modules-text" style="display: inline">Latest Version:
                                <p class="version_num"></p>
                                <a class="update-link" href="php/update.php"></a>
                            </p>
                            <script>
                                $.get("https://api.github.com/repos/IntranetProject/intranet_frontend/commits", function(data, status) {
                                    var i = 0;
                                    var x = 3;
                                    $.each(data, function(idx, obj) {
                                        if (i >= x) {
                                            return false;
                                        } else {
                                            if (i < 1) {
                                                var version = obj.commit.message.split(";");
                                                $(".version_num").html(version[0]);
                                                if (version != $("#vrs_num")) {
                                                    $(".update-link").html("Update Now!");
                                                }
                                            }
                                            i++;
                                        }
                                    });
                                });
                            </script>
                            <p class="stats-modules-text">Documentation:
                                <a target="_blank" href="http://docs.intranetproject.net/v/<?php $var = explode("v", $version); echo $var[1]; ?>">Offical Site</a>
                            </p>
                            <p class="stats-modules-text">Logged in user:
                                <?php echo $_SESSION['name']; ?>
                            </p>
                            <h4>Modules:</h4>
                            <p class="stats-modules-text">Modules installed:
                                <?php $i = 0; $dir = $modules_path . "/";
                                    if ($handle = opendir($dir)) {
                                        while (($file = readdir($handle)) !== false) {
                                            if (!in_array($file, array('.', "..")) && !is_dir($dir.$file)) {
                                                $i++;
                                            }
                                        }
                                        echo $i;
                                    }
                                ?>
                            </p>
                            <p class="stats-modules-text">Modules with Interface file:
                                <?php $i = 0; $dir = $modules_path . "/php/";
                                    if ($handle = opendir($dir)) {
                                        while (($file = readdir($handle)) !== false) {
                                            if (!in_array($file, array('.', "..")) && !is_dir($dir.$file)) {
                                                if (substr(basename($file),0,strlen('interface_')) === 'interface_') {
                                                    $i++;
                                                }
                                            }
                                        }
                                        echo $i;
                                    }
                            ?>
                            </p>
                            <h4>Config Setup</h4>
                            <p class="stats-modules-text">Network Path:
                                <?php echo $network_path; ?>
                            </p>
                            <p class="stats-modules-text">Modules Path:
                                <?php echo $modules_path; ?>
                            </p>
                            <p class="stats-modules-text">Language:
                                <?php echo $language; ?>
                            </p>
                            <p class="stats-modules-text">REST API enabled:
                                <?php if ($restapi) { echo "true"; } else { echo "false"; }; ?>
                            </p>
                            <p class="stats-modules-text"></p>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <footer id="footer">
            Copyright &copy; 2017 Intranet
            <?php echo $version;?>
        </footer>
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


        </script>
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="js/app.min.js">


        </script>
    </body>

    </html>
