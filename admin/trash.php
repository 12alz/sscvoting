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
        Archived Voters List
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="voters.php" class="btn"><i class="fa fa-reply"></i> back</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>Student ID</th>
                   <th>Lastname</th>
                  <th>Firstname</th>
                  <th>Photo</th>
                  <th>Course</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM voters WHERE recstat = 1";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td>".$row['voters_id']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['firstname']."</td>

                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                           
                          </td>
                          <td>".$row['course']."</td>
                          <td>".$row['status']."</td>
                          <td>
                             <a href ='' class='btn  btn-sm delete btn-flat fa fa-undo' data-id='".$row['id']."'></a>
                             <a href ='' class='btn btn-sm edit btn-flat fa fa-trash' data-id='".$row['id']."'></a>
                           
                          </td>
                        </tr>
                      ";
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
  <?php include 'trash_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_password').val(response.password);
      $('#edit_course').val(response.course);
      $('#edit_voters_id').val(response.voters_id);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
