<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-family: 'Poppins'">Newsletter</h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Newsletter</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
      if (isset($_SESSION['success'])) {
          echo "
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '{$_SESSION['success']}',
                  confirmButtonText: 'OK'
              });
          </script>
          ";
          unset($_SESSION['success']);
      }

      if (isset($_SESSION['error'])) {
          echo "
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '{$_SESSION['error']}',
                  confirmButtonText: 'OK'
              });
          </script>
          ";
          unset($_SESSION['error']);
      }
      ?>

      <div class="container mt-5" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;">
        <h2 class="text-center mb-4" style="color: #333; font-family:Poppins;">Add News</h2>
        <form method="post" action="../admin/add_news_mailer.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" style="color: #333; font-family:Poppins;">News Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter News Title" required>
            </div>
            <div class="form-group">
                <label for="content" style="font-family: IBM Plex">News Content</label>
                <textarea class="form-control" name="content" id="content" rows="4" placeholder="Enter News Content" required></textarea>
            </div>
           
            <button type="submit" class="btn btn-danger btn-block" style="background: linear-gradient(135deg, #ff0000, #ff6347); color: white;" name="btn-add-news">Add News</button>
        </form>
      </div>
    </section>   
  </div>

  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
