<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Archived
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
               <a href="votes.php" class="btn"><i class="fa fa-reply"></i> back</a>
               <a href="#arch" data-toggle="modal" class="btn"><i class="fa fa-undo"></i> Restore</a>
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
                  $sql = "SELECT * FROM votes WHERE stat = 1";
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
  <?php include 'includes/archive_modal.php'; ?>
  <?php include 'includes/vdelete_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
