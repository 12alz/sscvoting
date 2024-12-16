<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <h1>Student Voters List</h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php
        if (isset($_SESSION['error'])) {
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
        if (isset($_SESSION['success'])) {
          echo "
          <script>
              Swal.fire({
                  icon: 'success',
                  text: '{$_SESSION['success']}',
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
              <div class="row">
                <div class="col-md-6">
                  <!-- Buttons for CSV Upload and Download -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#csvUploadModal">
                    <i class="fa fa-upload"></i> Import MS365 Account
                  </button>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#downloadCsvModal">
                    <i class="fa fa-download"></i> Download Template CSV
                  </button>
                </div>
              </div>
            </div>
            <div class="box-body">
              <!-- Table -->
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Username</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "includes/conn.php"; // Include DB connection

                    // Fetch student records
                    $query = "SELECT id, Firstname, Lastname, username FROM microsoft";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['Firstname']}</td>
                                    <td>{$row['Lastname']}</td>
                                    <td>{$row['username']}</td>
                                    <td>
                                       <a href='' class='btn btn-sm edit btn-flat fa fa-edit' data-id='".$row['id']."'></a>
                                       <a href='' class='btn btn-sm delete btn-flat fa fa-trash' data-id='".$row['id']."'></a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found.</td></tr>";
                    }

                    $conn->close(); // Close DB connection
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- CSV Upload Modal -->
  <div class="modal fade" id="csvUploadModal" tabindex="-1" role="dialog" aria-labelledby="csvUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="csvUploadModalLabel">Upload CSV File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../admin/upload_csv.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="csv_file">Select CSV File:</label>
              <input type="file" name="csv_file" accept=".csv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-upload"></i> Upload CSV
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Downloading CSV Template -->
  <div class="modal fade" id="downloadCsvModal" tabindex="-1" role="dialog" aria-labelledby="downloadCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="downloadCsvModalLabel">Download Template CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Click the button below to download the template CSV file for importing data.</p>
          <a href="../admin/download_script.php" class="btn btn-primary">Download Template CSV</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../admin/ms_edit.php" method="POST">
            <input type="hidden" name="id" class="id">
            <div class="form-group">
              <label for="edit_firstname">First Name:</label>
              <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
            </div>
            <div class="form-group">
              <label for="edit_lastname">Last Name:</label>
              <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
            </div>
            <div class="form-group">
              <label for="edit_username">Username:</label>
              <input type="text" class="form-control" id="edit_username" name="username" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="../admin/ms_delete.php" method="POST">
            <input type="hidden" name="id" class="id">
            <p class="lead">Are you sure you want to delete this user?</p>
            <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-primary btn-flat fa fa-check pull-left" name="delete">YES</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/scripts.php'; ?>

  <script>
  $(function(){
    // Edit User
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#editModal').modal('show');
      var id = $(this).data('id');
      getRow(id); // Fetch user data
    });

    // Delete User
    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#deleteModal').modal('show');
      var id = $(this).data('id');
      $('.id').val(id);
    });
  });

  function getRow(id) {
    $.ajax({
      type: 'POST',
      url: '../admin/msrows.php', // This file should return the user data as JSON
      data: {id: id},
      dataType: 'json',
      success: function(response) {
        // Populate the form with the user's details
        $('.id').val(response.id);
        $('#edit_firstname').val(response.firstname);
        $('#edit_lastname').val(response.lastname);
        $('#edit_username').val(response.username);
      }
    });
  }
  </script>
</body>
</html>
