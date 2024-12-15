<?php
// Get the current request URL
$request = $_SERVER['REQUEST_URI'];

// Redirect to remove .php extension
if (strpos($request, '.php') !== false) {
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}
?>
<!DOCTYPE html>
<html class="wide wow-animation scrollTo" lang="en">
  <head>
    <!-- Site Title-->
    <title>404</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="keywords" content="intense web design multipurpose template">
    <meta name="date" content="Dec 26">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CMerriweather:400,300,300italic,400italic,700,700italic">
    <link rel="stylesheet" href="dist/css/bootstrap.css">
    <link rel="stylesheet" href="dist/css/fonts.css">
    <link rel="stylesheet" href="dist/css/style.css">
  </head>
  <body>
    <div class="preloader"> 
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Content-->
      <section class="section page-content section-cover section-404 section-30 bg-default">
        <div><a href="./"><img src="images/logo-170x172.png" width="110" height="110" alt=""></a></div>
        <div class="section-xxs">
          <div class="container">
            <div>
              <h1 class="font-default"><span class="big text-light fw-bold">404</span></h1>
            </div>
            <div class="offset-top-10">
              <h2 class="fw-bold">Sorry, the page was not found</h2>
            </div>
            <div class="offset-top-15 offset-lg-top-30">
              <hr class="divider bg-madison">
            </div>
            <div class="offset-top-30 offset-lg-top-60">
              <p>You may have mistyped the address or the page may have moved.</p>
            </div>
            <div class="offset-top-15 offset-lg-top-30">
              <div class="group group-xl"><a class="btn button-primary btn-icon btn-icon btn-icon-left" href="./"><span class="icon fa fa-arrow-left"></span><span>Back to Home Page</span></a><a class="btn button-default btn-icon btn-icon btn-icon-left" href="contacts"><span class="icon fa fa-envelope"></span><span>Contact Us</span></a></div>
            </div>
          </div>
        </div>
        <div>
          <p>&copy; <span class="copyright-year"></span> All Rights Reserved Terms of Use and <a href="privacy-policy">Privacy Policy</a></p>
        </div>
      </section>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="dist/js/core.min.js"></script>
    <script src="dist/js/script.js"></script>
</html>