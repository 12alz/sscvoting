<!DOCTYPE html>
<html class="wide wow-animation scrollTo" lang="en">
  <head>
    <!-- Site Title-->
    <title>News</title>
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
    <style>
      .news-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
      }

      .news-item {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        width: calc(33.333% - 20px);
        cursor: pointer;
      }

      .news-item img {
        width: 100%;
        border-radius: 8px;
      }

      .news-item h3 {
        font-size: 1.5rem;
        margin-top: 15px;
      }

      .news-item p {
        font-size: 1rem;
        margin-top: 10px;
        color: #555;
      }

      .news-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      }

      @media (max-width: 768px) {
        .news-item {
          width: calc(50% - 20px);
        }
      }

      @media (max-width: 480px) {
        .news-item {
          width: 100%;
        }
      }
    </style>
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
          <nav class="rd-navbar rd-navbar-default">
            <!-- Navbar content here -->
          </nav>
        </div>
      </header>
      <!-- Classic Breadcrumbs-->
      <section class="section breadcrumb-classic context-dark">
        <div class="container">
          <h1>Latest News</h1>
          <div class="offset-top-10 offset-md-top-35">
            <ul class="list-inline list-inline-lg list-inline-dashed p">
              <li><a href="index.php">Home</a></li>
              <li>News</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- News Section -->
      <section class="section section-md bg-gray-100">
        <div class="container">
          <div class="news-container">
            <div class="news-item wow fadeInUp" data-wow-delay="0.1s">
              <img src="images/news1.jpg" alt="News Image">
              <h3>News Title 1</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="news-item wow fadeInUp" data-wow-delay="0.2s">
              <img src="images/news2.jpg" alt="News Image">
              <h3>News Title 2</h3>
              <p>Integer vehicula sapien sed neque euismod, ac suscipit est tincidunt.</p>
            </div>
            <div class="news-item wow fadeInUp" data-wow-delay="0.3s">
              <img src="images/news3.jpg" alt="News Image">
              <h3>News Title 3</h3>
              <p>Sed quis ligula non nunc hendrerit dictum.</p>
            </div>
          </div>
        </div>
      </section>
      <!-- End of News Section -->
    </div>
    <script src="dist/js/jquery.js"></script>
    <script src="dist/js/bootstrap.js"></script>
    <script src="dist/js/wow.js"></script>
    <script>
      new WOW().init();
    </script>
  </body>
</html>

            
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="dist/js/core.min.js"></script>
    <script src="dist/js/script.js"></script>

</html>