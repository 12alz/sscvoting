<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: admin/home');
    exit(); // Ensure no further execution after redirection
}

if(isset($_SESSION['voter'])){
    header('location: home');
    exit(); // Ensure no further execution after redirection
}
?>
<!DOCTYPE html>
<html class="wide wow-animation scrollTo" lang="en">
  <head>
    <!-- Site Title-->
    <title>Login/Register</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="keywords" content="Jerson Villaceran">
    <meta name="date" content="Dec 26">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CMerriweather:400,300,300italic,400italic,700,700italic">
    <link rel="stylesheet" href="dist/css/bootstrap.css">
    <link rel="stylesheet" href="dist/css/fonts.css">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suprime Student Council</title>
    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Your form code here -->

</body>
</html>

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
      <!-- Page Header-->
      <header class="page-head">
        <!-- RD Navbar Transparent-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-default" data-auto-height="false" data-lg-auto-height="true" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="210px" data-xl-stick-up-offset="85px" data-xxl-stick-up-offset="85px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap"><span></span></button>
                <h4 class="panel-title d-lg-none">Pages</h4>
                <!-- RD Navbar Right Side Toggle-->
                <button class="rd-navbar-top-panel-toggle d-lg-none" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span></button>
                <div class="rd-navbar-top-panel">
                  <div class="rd-navbar-top-panel-left-part">
                    <ul class="list-unstyled">
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-phone align-middle"></span></div>
                          <div class="unit-body"><a href="Phone:#">63-948-3618-713,</a> <a class="d-block d-lg-inline-block" href="Phone:#"></a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-map-marker align-middle"></span></div>
                          <div class="unit-body"><a href="#">Crossing Bunakan, Madridejos, Cebu, Madridejos, Philippines  </a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-email-open align-middle"></span></div>
                          <div class="unit-body"><a href="mailto:#">sscmcc13@gmail.com</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="rd-navbar-top-panel-right-part">
                    <div class="rd-navbar-top-panel-left-part">
                      <div class="unit flex-row align-items-center unit-spacing-xs">
                        <div class="unit-left"><span class="icon mdi mdi-login align-middle"></span></div>
                        <div class="unit-body"><a href="sign_in">Login/Register</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-menu-wrap clearfix">
                <!--Navbar Brand-->
                <div class="rd-navbar-brand"><a class="d-inline-block" href="index">
                    <div class="unit align-items-sm-center unit-xl unit-spacing-custom">
                      <div class="unit-left"><img width='170' height='172' src='images/logo-170x172.png' alt=''/>
                      </div>
                      <div class="unit-body">
                        <div class="rd-navbar-brand-title">Madridejos</div>
                        <div class="rd-navbar-brand-slogan">Community College</div>
                      </div>
                    </div></a></div>
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-mobile-scroll">
                    <div class="rd-navbar-mobile-header-wrap">
                      <!--Navbar Brand Mobile-->
                      <div class="rd-navbar-mobile-brand"><a href="index"><img width='136' height='138' src='images/logo-170x172.png' alt=''/></a></div>
                    </div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li><a href="index">Home</a>
                      </li>
                      <li><a href="#">Pages</a>
                        <div class="rd-navbar-megamenu">
                          <div class="row section-relative">
                            <ul class="col-lg-3">
                              <li>
                                <h6>Programs</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="academics">Academics</a></li>
                                </ul>
                              </li>
                            </ul>
                            <ul class="col-lg-3">
                              <li>
                                <h6>Pages</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="404">404</a></li>
                                  <li><a href="privacy-policy">Privacy Policy</a></li>
                                  <li><a href="maintenance">Maintenance</a></li>
                                  <li><a href="sign_in.">Login/Register</a></li>
                                </ul>
                              </li>
                            </ul>
                            <ul class="col-lg-3">
                              <li>
                                <h6>About</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="history">History</a></li>
                                  <li><a href="peoplel">People</a></li>
                                  <li><a href="team-member-profile.html">Team Member Profile</a></li>
                                </ul>
                              </li>
                              <li>
                              
                       
                        </div>
                      </li>
                      <li><a href="#">News</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="classic-news">Classic news</a>
                          </li>
                          </li>
                          <li><a href="news-post-page">News  Page</a>
                          </li>
                        </ul>
                      </li>
                      <!-- <li><a href="#">Campus</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="grid-gallery.html">Grid Gallery</a>
                          </li>
                          <li><a href="grid-without-padding-gallery.html">Grid Without Padding Gallery</a>
                          </li>
                          <li><a href="masonry-gallery.html">Masonry Gallery</a>
                          </li>
                          <li><a href="cobbles-gallery.html">Cobbles Gallery</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="#">Shop</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="product-catalog.html">Product Catalog</a>
                          </li>
                          <li><a href="single-product.html">Single Product</a>
                          </li>
                          <li><a href="shopping-cart.html">Shopping Cart</a>
                          </li>
                          <li><a href="checkout.html">Checkout</a>
                          </li>
                        </ul>
                      </li> -->
                      <li><a href="contacts">Contacts</a>
                      </li>
                      <!-- <li class="d-lg-none"><a href="shopping-cart.html">Shopping Cart (2)</a></li> -->
                    </ul>
                    <!--RD Navbar Mobile Search-->
                    <div class="rd-navbar-search-mobile" id="rd-navbar-search-mobile">
                      <form class="rd-navbar-search-form search-form-icon-right rd-search" action="" method="POST">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-mobile-search-form-input">Search...</label>
                          <input class="rd-navbar-search-form-input form-input form-input-gray-lightest" id="rd-navbar-mobile-search-form-input" type="text" name="s" autocomplete="off"/>
                        </div>
                        <button class="icon fa fa-search rd-navbar-search-button" type="submit"></button>
                      </form>
                    </div>
                  </div>
                  <div>
                    <!--RD Navbar Search-->
                    <div class="rd-navbar-search"><a class="rd-navbar-search-toggle mdi" data-rd-navbar-toggle=".rd-navbar-search" href="#"><span></span></a>
                      <form class="rd-navbar-search-form search-form-icon-right rd-search" action="" data-search-live="rd-search-results-live" method="POST">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-search-form-input">Search</label>
                          <input class="rd-navbar-search-form-input form-input form-input-gray-lightest" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off"/>
                          <div class="rd-search-results-live" id="rd-search-results-live"></div>
                        </div>
                      </form>
                    </div>
                    <!--RD Navbar shop-->
                    <!-- <div class="rd-navbar-cart"><span class="icon fa fa-shopping-cart"></span><a class="inset-left-10" href="shopping-cart.html">2</a></div> -->
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- Classic Breadcrumbs-->
      <section class="section breadcrumb-classic context-dark">
        <div class="container">
          <h1>Login/Register</h1>
          <div class="offset-top-10 offset-md-top-35">
            <ul class="list-inline list-inline-lg list-inline-dashed p">
              <li><a href="index">Home</a></li>
              <li><a href="#">Pages</a></li>
              <li>Login/Register
              </li>
            </ul>
          </div>
        </div>
      </section>
      <!--Section Login Register-->
      <section class="section section-xl bg-default">
        <div class="container">
          <div class="row justify-content-sm-center section-34">
            <div class="col-sm-8 col-md-6 col-lg-5">
              <h2 class="fw-bold">Sign In or Sign Up</h2>
              <hr class="divider bg-madison">
              <div class="offset-sm-top-45 text-center">
                <!--Bootstrap tabs-->
                <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                  <!--Nav tabs-->
                  <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-login-1" data-bs-toggle="tab">Login</a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-login-2" data-bs-toggle="tab">Registration</a></li> -->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-login-3" data-bs-toggle="tab">Login as Admin</a></li>
                  </ul>
                  <!--Tab panes-->
                  <div class="tab-content">
                    <div class="tab-pane fade" id="tabs-login-1">
                      <!-- RD Mailform-->
                      <!-- <form method="post" action="login"> -->
                      <form method="post" action="login.php" id="loginForm">
                        <div class="form-wrap">
                          <label class="form-label form-label-outside" for="form-login-username">Student ID:</label>
                          <input class="form-input bg-default" id="form-login-username" type="text" name="voter" data-constraints="@Required">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label class="form-label form-label-outside" for="form-login-password">Password:</label>
                          <input class="form-input bg-default" id="form-login-password" type="password" name="password" data-constraints="@Required">
                        </div>
                        <a href="forgot_password" class="small" style="color: #d32f2f; text-decoration: ;">Forgot Password?</a>
                        <div class="offset-top-20">
                          
                          <button class="btn button-primary d-block d-xl-inline-block" type="submit" name="login">Sign in</button><span class="inset-xl-left-20 align-middle small d-inline-block offset-top-20 offset-lg-top-0">Don't Have a account?</span>
                          <ul class="list-inline list-inline-xs list-inline-madison d-xl-inline-block inset-xl-left-10 inset-xxl-left-20 align-middle offset-top-15 offset-lg-top-0">
                          <a href="verification" data-toggle="modal" style="color: #d32f2f; font-weight: bold;">Register Here</a>
                            
                          </ul>
                        </div>
                      </form>
                    </div>
                    <!-- <div class="tab-pane fade" id="tabs-login-2">
                      <form method="POST" action="sign_up.php"  enctype="multipart/form-data">
                        <div class="form-wrap">
                          <label class="form-label form-label-outside" for="form-register-id">Student ID:</label>
                          <input class="form-input bg-default" id="form-register-id" type="text" name="voters_id" data-constraints="@Required">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label class="form-label form-label-outside" for="form-register-firstname">First Name:</label>
                          <input class="form-input bg-default" id="form-register-email" type="text" name="firstname" data-constraints="@Required @Email">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label class="form-label form-label-outside" for="form-register-lastname">Last Name:</label>
                          <input class="form-input bg-default" id="form-register-password" type="text" name="lastname" data-constraints="@Required">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label class="form-label form-label-outside" for="form-register-confirm-password">Password:</label>
                          <input class="form-input bg-default" id="form-register-confirm-password" type="password" name="password" data-constraints="@Required">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label for="course" class="form-label form-label-outside" for="course">Course</label>
                          <div class="col-sm-9">
                            <select type="text" class="form-input bg-default" id="course" name="course" required>
                              <option value="" selected>-Select-</option>
                              <option value="BSIT">BSIT</option>
                              <option value="BSBA">BSBA</option>
                              <option value="BSED">BSED</option>
                              <option value="BEED">BEED</option>
                              <option value="BSHM">BSHM</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label for="photo" class="form-label form-label-outside" for="photo">Photo</label>
                          <input type="file" id="photo" accept=".jpg, .jpeg, .png" name="photo">
                        </div>                        
                        <div class="offset-top-20">
                        <div class="g-recaptcha" data-sitekey="6LcRzQ8qAAAAAFRx7HFGBPVW6Zgq9F0TcQh63Jwt"></div>
                          <button class="btn button-primary" type="submit" name="add">Register</button>
                        </div>
                      </form>
                    </div> -->
                    <div class="tab-pane fade" id="tabs-login-3">
                      <!-- <form method="post" action="admin/login"> -->
                      <form method="post" action="admin/login.php" id="adminLoginForm">
                        <div class="form-wrap">
                        <label class="form-label form-label-outside" for="email">Email:</label>
                        <input class="form-input bg-default" id="email" type="email" name="email" data-constraints="@Required">
                        </div>
                        <div class="form-wrap offset-top-15">
                          <label class="form-label form-label-outside" for="password">Password:</label>
                          <input class="form-input bg-default" id="password" type="password" name="password" data-constraints="@Required">
                        </div>
                       
                        <a href="forgetpass" data-toggle="modal" data-target="#modal-forgotpass" class="pull-right" style="color: #d32f2f; text-decoration: none;">Forgot Password?</a>
                       
                        <div class="offset-top-20">
                          <button class="btn button-primary" type="submit" name="login">Login As Administrator</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--forget password-->
      
      
      <!-- Page Footer-->
      <!-- Corporate footer-->
      <footer class="page-footer">
        <div class="hr bg-gray-light"></div>
        <div class="container section-xs block-after-divider">
          <div class="row row-50 justify-content-xl-between justify-content-sm-center">
            <div class="col-lg-3 col-xl-2">
              <!--Footer brand--><a class="d-inline-block" href="index"><img width='170' height='172' src='images/logo-170x172.png' alt=''/>
                <div>
                  <h6 class="barnd-name fw-bold offset-top-25">Madridejos</h6>
                </div>
                <div>
                  <p class="brand-slogan text-gray fst-italic font-accent">Community College</p>
                </div></a>
            </div>
            <div class="col-sm-10 col-lg-5 col-xl-4 text-xl-start">
              <h6 class="fw-bold">Contact us</h6>
              <div class="text-subline"></div>
              <div class="offset-top-30">
                <ul class="list-unstyled contact-info list">
                  <li>
                    <div class="unit flex-row align-items-center unit-spacing-xs">
                      <div class="unit-left"><span class="icon mdi mdi-phone align-middle icon-xs text-madison"></span></div>
                      <div class="unit-body"><a class="text-dark" href="tel:#"></a> <a class="d-block d-lg-inline-block text-dark" href="tel:#">63-948-3618-713</a>
                      </div>
                    </div>
                  </li>
                  <li class="offset-top-15">
                    <div class="unit flex-row align-items-center unit-spacing-xs">
                      <div class="unit-left"><span class="icon mdi mdi-map-marker align-middle icon-xs text-madison"></span></div>
                      <div class="unit-body text-start"><a class="text-dark" href="#">Crossing Bunakan, Madridejos, Cebu, Madridejos, Philippines</a></div>
                    </div>
                  </li>
                  <li class="offset-top-15">
                    <div class="unit flex-row align-items-center unit-spacing-xs">
                      <div class="unit-left"><span class="icon mdi mdi-email-open align-middle icon-xs text-madison"></span></div>
                      <div class="unit-body"><a href="mailto:#">sscmcc13@gmail.com</a></div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="offset-top-15 text-start">
                <ul class="list-inline list-inline-xs list-inline-madison">
                  <li><a class="icon icon-xxs fa fa-facebook icon-circle icon-gray-light-filled" href="https://www.facebook.com/madridejoscollege"></a></li>
                  <li><a class="icon icon-xxs fa fa-twitter icon-circle icon-gray-light-filled" href="#"></a></li>
                  <li><a class="icon icon-xxs fa fa-google icon-circle icon-gray-light-filled" href="#"></a></li>
                  <li><a class="icon icon-xxs fa fa-instagram icon-circle icon-gray-light-filled" href="#"></a></li>
                </ul>
              </div>
            </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-madison context-dark">
          <div class="container text-lg-start section-5">
          <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>.&nbsp;</span><span>All Rights Reserved Terms of Use</span><span>.&nbsp;</span><a class="text-dark" href="privacy-policy.php">Privacy Policy</a></p>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="dist/js/core.min.js"></script>
    <script src="dist/js/script.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfuV4sqAAAAAPsjFo7TvYq8CcYwSu0qMf227C6I"></script>

<script>
    // Display Swal messages based on session status (success or error)
    <?php
    // Check for error messages set by login.php
    if(isset($_SESSION['error'])){
        echo "
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '".$_SESSION['error']."',
                onClose: () => {
                    window.location.href = 'sign_in.php';
                }
            });
        ";
        unset($_SESSION['error']);
    }

    // Check for success messages if needed
    if(isset($_SESSION['success'])){
        echo "
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '".$_SESSION['success']."',
                onClose: () => {
                    window.location.href = 'home.php';
                }
            });
        ";
        unset($_SESSION['success']);
    }
    ?>
</script>

<body oncontextmenu="return true" onkeydown="return true;" onmousedown="return true;">
  <!-- Block right-click and certain key combinations -->
  <script>
    $(document).bind("contextmenu", function(e) {
        e.preventDefault();
    });

    window.addEventListener("keydown", function(event) {
        if (event.keyCode == 123) {
            // block F12 (DevTools)
            event.preventDefault();
            event.stopPropagation();
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
            // block Strg+Shift+I (DevTools)
            event.preventDefault();
            event.stopPropagation();
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
            // block Strg+Shift+J (Console)
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });
  </script>

  <!-- reCAPTCHA script for login form -->
 

</body>