<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: admin/home.php');
    exit(); // Ensure no further execution after redirection
}

if(isset($_SESSION['voter'])){
    header('location: home.php');
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
                          <div class="unit-body"><a href="Phone:#">+1234567890,</a> <a class="d-block d-lg-inline-block" href="Phone:#">+1234567890</a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-map-marker align-middle"></span></div>
                          <div class="unit-body"><a href="#">Bunakan Madridejos Cebu</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-email-open align-middle"></span></div>
                          <div class="unit-body"><a href="mailto:#">mccssc@gmail.com</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="rd-navbar-top-panel-right-part">
                    <div class="rd-navbar-top-panel-left-part">
                      <div class="unit flex-row align-items-center unit-spacing-xs">
                        <div class="unit-left"><span class="icon mdi mdi-login align-middle"></span></div>
                        <div class="unit-body"><a href="sign_in.html">Login/Register</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-menu-wrap clearfix">
                <!--Navbar Brand-->
                <div class="rd-navbar-brand"><a class="d-inline-block" href="index.php">
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
                      <div class="rd-navbar-mobile-brand"><a href="index.php"><img width='136' height='138' src='images/logo-170x172.png' alt=''/></a></div>
                    </div>
                    
                    <div class="rd-navbar-search-mobile" id="rd-navbar-search-mobile">
                      <form class="rd-navbar-search-form search-form-icon-right rd-search" action="" method="GET">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-mobile-search-form-input">Search...</label>
                          <input class="rd-navbar-search-form-input form-input form-input-gray-lightest" id="rd-navbar-mobile-search-form-input" type="text" name="s" autocomplete="off"/>
                        </div>
                        <button class="icon fa fa-search rd-navbar-search-button" type="submit"></button>
                      </form>
                    </div>
                  </div>
                  <div>
                 
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
              <h2 class="fw-bold"> Register</h2>
              <hr class="divider bg-madison">
              <div class="offset-sm-top-45 text-center">
                <!--Bootstrap tabs-->
                <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                  <!--Nav tabs-->
                  <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-login-2" data-bs-toggle="tab">Registration</a></li>
                  </ul>
                  <!--Tab panes-->
                
                    <div class="tab-pane fade" id="tabs-login-2">
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
                       
                          <button class="btn button-primary" type="submit" name="add">Register</button>
                        </div>
                      </form>
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
              <!--Footer brand--><a class="d-inline-block" href="index.php"><img width='170' height='172' src='images/logo-170x172.png' alt=''/>
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
                      <div class="unit-body"><a class="text-dark" href="tel:#">1-800-1234-567,</a> <a class="d-block d-lg-inline-block text-dark" href="tel:#">1-800-6547-321</a>
                      </div>
                    </div>
                  </li>
                  <li class="offset-top-15">
                    <div class="unit flex-row align-items-center unit-spacing-xs">
                      <div class="unit-left"><span class="icon mdi mdi-map-marker align-middle icon-xs text-madison"></span></div>
                      <div class="unit-body text-start"><a class="text-dark" href="#">2130 Fulton Street San Diego, CA 94117-1080 USA</a></div>
                    </div>
                  </li>
                  <li class="offset-top-15">
                    <div class="unit flex-row align-items-center unit-spacing-xs">
                      <div class="unit-left"><span class="icon mdi mdi-email-open align-middle icon-xs text-madison"></span></div>
                      <div class="unit-body"><a href="mailto:#">info@demolink.org</a></div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="offset-top-15 text-start">
                <ul class="list-inline list-inline-xs list-inline-madison">
                  <li><a class="icon icon-xxs fa fa-facebook icon-circle icon-gray-light-filled" href="#"></a></li>
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
            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>.&nbsp;</span><span>All Rights Reserved</span><span>.&nbsp;</span><a class="text-dark" href="https://mccsscvoting.com/">Madridejos Community College</a></p>
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
    <script>
        <?php
        // Check for error messages set by login.php
        if(isset($_SESSION['error'])){
            echo "
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '".$_SESSION['error']."',
                    onClose: () => {a
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
</html>