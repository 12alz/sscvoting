<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Content Wrapper. Contains page contentS -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-family: 'Poppins'">Registration Logs</h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registration Logs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      // Success/Error Notifications
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

      <div class="container mt-5" style="max-width: 1000px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;">
        <h2 class="text-center mb-4" style="color: #333; font-family:Poppins;">Registration Logs</h2>
        
        <?php
    
        $sql = "SELECT * FROM login_logs ORDER BY timestamp DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
        ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>IP Address</th>
                        <th>Username</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <!-- <td><?php echo $row['id']; ?></td> -->
                            <td><?php echo $row['ip_adress']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($row['timestamp'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p>No registration logs found.</p>";
        }
        ?>
        
      </div>
    </section>   
  </div>

  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
