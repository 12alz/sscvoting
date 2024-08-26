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
        max-width: 600px;
        margin: 20px auto;
      }

      .news-item {
        background: #fff;
        border: 1px solid #dddfe2;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      }

      .news-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }

      .news-header img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
      }

      .news-header .news-author {
        font-weight: bold;
        font-size: 14px;
      }

      .news-header .news-meta {
        color: #65676b;
        font-size: 12px;
      }

      .news-content img {
        width: 100%;
        border-radius: 8px;
        margin-top: 10px;
      }

      .news-content p {
        font-size: 14px;
        color: #1c1e21;
        margin-top: 10px;
        line-height: 1.5;
      }

      .news-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        border-top: 1px solid #dddfe2;
        padding-top: 10px;
      }

      .news-actions button {
        background: none;
        border: none;
        color: #65676b;
        font-size: 14px;
        cursor: pointer;
      }

      .news-actions button:hover {
        text-decoration: underline;
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
            <div class="news-item">
              <div class="news-header">
                <img src="images/profile1.jpg" alt="User Profile Picture">
                <div>
                  <div class="news-author">John Doe</div>
                  <div class="news-meta">2 hrs ago • Madridejos Community College</div>
                </div>
              </div>
              <div class="news-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vehicula sapien sed neque euismod, ac suscipit est tincidunt.</p>
                <img src="images/news1.jpg" alt="News Image">
              </div>
              <div class="news-actions">
                <button>Like</button>
                <button>Comment</button>
                <button>Share</button>
              </div>
            </div>

            <div class="news-item">
              <div class="news-header">
                <img src="images/profile2.jpg" alt="User Profile Picture">
                <div>
                  <div class="news-author">Jane Smith</div>
                  <div class="news-meta">4 hrs ago • Madridejos Community College</div>
                </div>
              </div>
              <div class="news-content">
                <p>Sed quis ligula non nunc hendrerit dictum. Nulla facilisi. Cras sit amet tortor ac libero venenatis tempus a eget lacus.</p>
                <img src="images/news2.jpg" alt="News Image">
              </div>
              <div class="news-actions">
                <button>Like</button>
                <button>Comment</button>
                <button>Share</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End of News Section -->
    </div>
    <script src="dist/js/jquery.js"></script>
    <script src="dist/js/bootstrap.js"></script>
  </body>
</html>
