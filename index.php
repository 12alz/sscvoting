<?php
header("Cache-control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html class="wide wow-animation scrollTo" lang="en">
  <head>
    <!-- Site Title-->
    <title>Home</title>
    <meta charset="utf-8">
    <!-- <meta name="format-detection" content="telephone=no"> -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
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
      <header class="page-head header-panel-absolute">
        <!-- RD Navbar Transparent-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-default" data-auto-height="false" data-lg-auto-height="true" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="210px" data-xl-stick-up-offset="85px" data-xxl-stick-up-offset="85px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap"><span></span></button>
                <h4 class="panel-title d-lg-none">Home</h4>
                <!-- RD Navbar Right Side Toggle-->
                <button class="rd-navbar-top-panel-toggle d-lg-none" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span></button>
                <div class="rd-navbar-top-panel">
                  <div class="rd-navbar-top-panel-left-part">
                    <ul class="list-unstyled">
                      <li>
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-phone align-middle"></span></div>
                          <div class="unit-body"><a href="tel:#">63-948-3618-713</a> <a class="d-block d-lg-inline-block" href="tel:#"></a>
                          </div>
                        </div>
                      </li>
                      <li>  
                        <div class="unit flex-row align-items-center unit-spacing-xs">
                          <div class="unit-left"><span class="icon mdi mdi-map-marker align-middle"></span></div>
                          <div class="unit-body"><a href="#">Crossing Bunakan, Madridejos, Cebu, Madridejos, Philippines</a></div>
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
                        <div class="unit-body"><a href="sign_in.php">Login/Register</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-menu-wrap clearfix">
                <!--Navbar Brand-->
                <div class="rd-navbar-brand"><a class="d-inline-block" href="index.php">
                    <div class="unit align-items-sm-center unit-xl unit-spacing-custom">
                      <div class="unit-left"><img width='170' height='172' src='https://mccsscvoting.com/images/2.png' alt=''/>
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
                      <div class="rd-navbar-mobile-brand"><a href="index.php"><img width='136' height='138' src='https://mccsscvoting.com/images/2.png' alt=''/></a></div>
                    </div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="active"><a href="index.php">Home</a>
                       
                      </li>
                      <!-- <li><a href="#">Elements</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="grid.html">Grid</a>
                          </li>
                          <li><a href="icons.html">Icons</a>
                          </li>
                          <li><a href="tables.html">Tables</a>
                          </li>
                          <li><a href="progress-bars.html">Progress bars</a>
                          </li>
                          <li><a href="tabs-and-accordions.html">Tabs &amp; Accordions</a>
                          </li>
                          <li><a href="forms.html">Forms</a>
                          </li>
                          <li><a href="buttons.html">Buttons</a>
                          </li>
                          <li><a href="typography.html">Typography</a>
                          </li>
                        </ul>
                      </li> -->
                      <li><a href="#">Pages</a>
                        <div class="rd-navbar-megamenu">
                          <div class="row section-relative">
                            <ul class="col-lg-3">
                              <li>
                                <h6>Programs</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="academics.html">Academics</a></li>
                                </ul>
                              </li>
                            </ul>
                            <ul class="col-lg-3">
                              <li>
                                <h6>Pages</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="404.php">404</a></li>
                                  <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                  <li><a href="maintenance.html">Maintenance</a></li>
                                  <li><a href="login-register.html">Login/Register</a></li>
                                  <li><a href="search-result.php">Search Results</a></li>
                                </ul>
                              </li>
                            </ul>
                            <ul class="col-lg-3">
                              <li>
                                <h6>About</h6>
                                <ul class="list-unstyled offset-lg-top-20">
                                  <li><a href="history.html">History</a></li>
                                  <li><a href="people.html">People</a></li>
                                  <li><a href="team-member-profile.html">Team Member Profile</a></li>
                                </ul>
                              </li>
                              <li>
                              
                       
                        </div>
                      </li>
                      <li><a href="#">News</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="classic-news.php">Classic news</a>
                          </li>
                          </li>
                          <li><a href="news-post-page.php">News Post Page</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="#">Campus</a>
                        <ul class="rd-navbar-dropdown">
                          <li><a href="grid-gallery.html">Grid Gallery</a>
                          </li>
                          <li><a href="grid-without-padding-gallery.html">Grid Without Padding Gallery</a>
                          </li>
                          <li><a href="masonry-gallery.html">Masonry Gallery</a>
                          </li>
                          <li><a href="cobbles-gallery.html">ddCobbles Gallery</a>
                          </li>
                        </ul>
                      </li>
                      <!-- <li><a href="#">Shop</a>
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
                      <!-- <li><a href="donate.html">Donate</a> -->
                      </li>
                      <li><a href="contacts.php">Contacts</a>
                      </li>
                      <!-- <li class="d-lg-none"><a href="shopping-cart.html">Shopping Cart (2)</a></li> -->
                    </ul>
                    <!--RD Navbar Mobile Search-->
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
                    <!--RD Navbar Search-->
                    <div class="rd-navbar-search"><a class="rd-navbar-search-toggle mdi" data-rd-navbar-toggle=".rd-navbar-search" href="#"><span></span></a>
                      <form class="rd-navbar-search-form search-form-icon-right rd-search" action="" data-search-live="rd-search-results-live" method="GET">
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
      <section class="section">
        <!-- Swiper-->
        <div class="swiper-container swiper-slider swiper-slider-modern" data-loop="true" data-autoplay="4000" data-slide-effect="fade" data-height="42.1875%" data-min-height="480px">
          <div class="swiper-wrapper">
            <div class="swiper-slide" data-slide-bg="https://mccsscvoting.com/images/mcc.jpg" style="background-position: 80% center">
              <div class="swiper-slide-caption">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-9 col-sm-10">
                      <div data-caption-animate="fadeInUp" data-caption-delay="100">
                        <h1 class="fw-bold">Providing Higher Education</h1>
                      </div>
                      <div class="offset-top-20 offset-xs-top-40 offset-xl-top-45" data-caption-animate="fadeInUp" data-caption-delay="150">
                        <h5>Any successful career starts with advanced higher education. At our school, you will have a deeper knowledge of the subjects that will be particularly useful when climbing the career ladder.</h5>
                      </div>
                      <div class="offset-top-20 offset-xl-top-30" data-caption-animate="fadeInUp" data-caption-delay="400"><a class="btn button-primary" href="#">Start a Journey</a>
                        <!-- <div class="inset-sm-left-30 d-xl-inline-block"><a class="btn button-default d-none d-xl-inline-block" href="index.php/#" target="_blank">Mission Vision</a></div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide" data-slide-bg="images/slide-02-1920x810.jpg" style="background-position: 80% center">
              <div class="swiper-slide-caption">
                <div class="container">
                  <div class="row justify-content-sm-center">
                    <div class="col-lg-9 col-sm-10">
                      <div data-caption-animate="fadeInUp" data-caption-delay="100">
                        <h1 class="fw-bold">Creating Your Future</h1>
                      </div>
                      <div class="offset-top-20 offset-xs-top-40 offset-xl-top-45" data-caption-animate="fadeInUp" data-caption-delay="150">
                        <h5>Together with our school professors and academics, you can create the future for yourself. It means obtaining necessary skills and knowledge to make everything you learned here work for you in the future.</h5>
                      </div>
                      <div class="offset-top-20 offset-xl-top-30" data-caption-animate="fadeInUp" data-caption-delay="400"><a class="btn button-primary" href="#">Start a Journey</a>
                        <!-- <div class="inset-sm-left-30 d-xl-inline-block"><a class="btn button-default d-none d-xl-inline-block" href="" target="_blank">Mission Vision</a></div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide" data-slide-bg="images/slide-03-1920x810.jpg" style="background-position: 80% center">
              <div class="swiper-slide-caption">
                <div class="container">
                  <div class="row justify-content-sm-center">
                    <div class="col-lg-9 col-sm-10">
                      <div data-caption-animate="fadeInUp" data-caption-delay="100">
                        <h1 class="fw-bold">More Than Just Studying</h1>
                      </div>
                      <div class="offset-top-20 offset-xs-top-40 offset-xl-top-45" data-caption-animate="fadeInUp" data-caption-delay="150">
                        <h5>Besides providing you with new knowledge and training in chosen disciplines, our school also gives you an opportunity to benefit from spending your free time by playing sports, taking part in conferences, and enjoying student life.</h5>
                      </div>
                      <div class="offset-top-20 offset-xl-top-30" data-caption-animate="fadeInUp" data-caption-delay="400"><a class="btn button-primary" href="#">Start a Journey</a>                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Swiper Pagination-->
          <div class="swiper-pagination"></div>
        </div>
      </section>
      <!-- <section class="section section-lg">
        <div class="container container-wide">
          <div class="row row-30 align-items-lg-center">
            <div class="col-lg-6 col-xl-7"><img class="img-responsive" src="images/landing-3.png" alt=""></div>
            <div class="col-lg-6 col-xl-5 text-start">
              <h2>Home Layouts and Demos</h2>
              <hr class="divider bg-madison divider-md-0">
              <p>Choose from our wide range of predefined Homepage layouts and demos to create your Own Amazing Experience.</p> -->
              <!-- <div class="offset-top-50"><a class="btn button-primary" href="https://www.templatemonster.com/website-templates/responsive-website-template-59029.html" target="_blank">Get Template!</a></div> -->
            <!-- </div>
          </div>
          <div class="offset-top-60">
            <div class="row row-30 isotope-wrap"> -->
              <!-- Isotope Filters-->
              <!-- <div class="col-xl-12">
                <div class="isotope-filters isotope-filters-horizontal">
                  <button class="isotope-filters-toggle btn button-primary" data-custom-toggle="#isotope-filters" data-custom-toggle-disable-on-blur="true" data-custom-toggle-hide-on-blur="true">Filter<span class="caret"></span></button>
                  <ul class="isotope-filters-modern isotope-filters-list" id="isotope-filters">
                    <li><a class="active" data-isotope-filter="*" href="#">All</a></li>
                    <li><a data-isotope-filter="Home" href="#">Home</a></li>
                    <li><a data-isotope-filter="News" href="#">News</a></li> -->
                    <!-- <li><a data-isotope-filter="Shop" href="#">Shop</a></li>
                    <li><a data-isotope-filter="Campus" href="#">Campus</a></li>
                    <li><a data-isotope-filter="Elements" href="#">Elements</a></li> -->
                    <!-- <li><a data-isotope-filter="Pages" href="#">Pages</a></li> -->
                  <!-- </ul>
                </div>
              </div>
          </div>
        </div>
      </section> -->
      <section class="section bg-catskill section-lg">
        <div class="container">
          <h2>Vision Statement</h2>
          <hr class="divider bg-madison">
          <div class="row justify-content-md-center">
            <div class="col-md-10 col-lg-7 col-xl-6">
              <p>The Madridejos Community College dreams to mold professionally competitive,service   oriented,   productive,   and value-laden   citizens,   through   quality   education   andintegral formation. Inspired by its four-fold functions of effective instruction, personalenhancement, research and extension, and production, it shall become a deeply rootedfoundation   of   the   town   's   socio-economic   upliftment   and   a   prime   mover   for   nationbuilding.</p>
              <div class="offset-top-35">
                <ul class="list-inline list-inline-sm list-inline-madison">
                  <li><a class="icon icon-xxs fa fa-facebook icon-rect icon-gray-light-filled" href="#"></a></li>
                  <li><a class="icon icon-xxs fa fa-twitter icon-rect icon-gray-light-filled" href="#"></a></li>
                  <li><a class="icon icon-xxs fa fa-google icon-rect icon-gray-light-filled" href="#"></a></li>
                  <li><a class="icon icon-xxs fa fa-instagram icon-rect icon-gray-light-filled" href="#"></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer Classic-->
      <footer class="page-footer bg-catskill section-xs">
        <div class="container">
          <div class="row row-20 justify-content-sm-center align-items-md-center text-lg-start">
            <div class="col-sm-10 col-lg-6">
              <!--Footer brand--><a class="d-inline-block" href="index.php">
                <div class="unit align-items-sm-center flex-column unit-md flex-lg-row unit-spacing-xxs">
                  <div class="unit-left"><img class="img-responsive d-inline-block" src="https://mccsscvoting.com/images/2.png" width="70" height="70" alt=""></div>
                  <div class="unit-body text-xxl-start">
                    <div>
                      <h6 class="barnd-name text-ubold">Madridejos</h6>
                    </div>
                    <div>
                      <p class="brand-slogan text-gray fst-italic font-accent">Community College</p>
                    </div>
                  </div>
                </div></a>
            </div>
            <div class="col-sm-10 col-lg-6 text-lg-end">
              <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>.&nbsp;</span><span>All Rights Reserved</span><span>.&nbsp;</span><a class="text-dark" href="https://mccsscvoting.com/">Madridejos Community College</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Outsput-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="dist/js/core.min.js"></script>
    <script src="dist/js/script.js"></script>
    </script>
     <body oncontextmenu="return true" onkeydown="return true;" onmousedown="return true;">
       <script>
         $(document).bind("contextmenu",function(e) {
            e.preventDefault();
         });
                        
         eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(3(){(3 a(){8{(3 b(2){7((\'\'+(2/2)).6!==1||2%5===0){(3(){}).9(\'4\')()}c{4}b(++2)})(0)}d(e){g(a,f)}})()})();',17,17,'||i|function|debugger|20|length|if|try|constructor|||else|catch||5000|setTimeout'.split('|'),0,{}))
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
</html>