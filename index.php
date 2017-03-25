<!--[if IE 9 ]><html class="ie9"><![endif]-->
<?php
include 'php/config.php';
?>
<html>
<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Intranet - Login</title><!-- Vendor CSS -->
  <link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
  <link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet"><!-- CSS -->
  <link href="css/app_1.min.css" rel="stylesheet">
  <link href="css/app_2.min.css" rel="stylesheet">
  <style type="text/css">
        body {
          overflow:hidden !important;
        }
  </style>
</head>
<body>
  <div class="login-content">
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
          <small>Intranet <?php echo $version; ?></small>
          <a class="btn btn-login btn-default btn-float"><i class="zmdi zmdi-arrow-forward"></i></a> <input class="btn btn-login btn-default btn-float" name="submit" type="submit" value=" ">
        </div>
      </form><!--<div class="lcb-navigation">
                    <a href="#" data-ma-action="login-switch" data-ma-block="#l-register"><i class="zmdi zmdi-plus"></i> <span>Register</span></a>
                    <a href="#" data-ma-action="login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
                </div>-->
    </div><!-- Register -->
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
  <script src="vendors/bower_components/Waves/dist/waves.min.js">
  </script> <!-- Placeholder for IE9 -->
   <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
   
  <script src="js/app.min.js">
  </script>
</body>
</html>