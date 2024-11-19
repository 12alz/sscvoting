<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class=" skin-red" style="background: rgba(60, 141, 188, 0.9);">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votes
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Votes</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
          <script>
              Swal.fire({
                  icon: 'error',
                  text: '{$_SESSION['error']}',
              });
          </script>
      ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
          <script>
              Swal.fire({
              icon: 'success',
              text: '{$_SESSION['success']}',
              height: '1000px',
              });
          </script>
      ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="archive" class="btn"><i class="fa fa-archive"></i> archived</a>
               <a href="#reset" data-toggle="modal" class="btn"><i class="fa fa-close"></i> Remove</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Position</th>
                  <th>Candidate</th>
                  <th>Votes Count</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM votes WHERE stat = 0";
                   $query = $conn->query($sql);
                   while($row = $query->fetch_assoc()){
                   $sql = "SELECT * FROM positions";
                   $query = $conn->query($sql);
                   while($row = $query->fetch_assoc()){
                   $id = $row['id'];
                   $sql = "SELECT * FROM candidates WHERE position_id = '$id'";
                   $cquery = $conn->query($sql);
                  while($crow = $cquery->fetch_assoc()){
                  $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
                  $vquery = $conn->query($sql);
                   $votes = $vquery->num_rows;
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['description']."</td>
                          <td>".$crow['firstname'].' '.$crow['lastname']."</td>
                          <td>".$votes."</td>
                        </tr>
                      ";
                    }
                  }
              }  
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
