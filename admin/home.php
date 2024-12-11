<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class=" skin-red" style="background: rgba(60, 141, 188, 0.9);">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CMerriweather:400,300,300italic,400italic,700,700italic">
<link rel="stylesheet" href="dist/css/bootstrap.css">
<link rel="stylesheet" href="dist/css/fonts.css">
<link rel="stylesheet" href="dist/css/style.css">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" skin-red>
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
       <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>No. of <br>Positions</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="positions" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                          <?php
              $sql = "SELECT COUNT(*) AS total FROM microsoft WHERE id NOT IN (SELECT voters_id FROM votes)";
              $query = $conn->query($sql);

              // Check if query is successful
              if ($query) {
                  $row = $query->fetch_assoc();
                  echo "<h3>".$row['total']."</h3>";
              } else {
                  // Handle query error
                  echo "Query failed: " . $conn->error;
              }
              ?>

              <p>No. of <br>In Active Voters</p>

            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM import_ms365";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
          
              <p>MS365 <br>Accounts</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="msaccount" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM candidates";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
          
              <p>No. of <br>Candidates</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="candidates" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM voters WHERE recstat = 0";
                // $sql = "SELECT * FROM votersS";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
             
              <p>Total <br>Voters</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="voters" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                // $sql = "SELECT * FROM votes WHERE stat = 0";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Student <br>Voted</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="votes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-xs-6">
          <h3>Voting Tally</h3>
        </div>
        <?php 
        // Update Switch
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $status = isset($_POST['switchStatus']) ? 1 : 0;
            $sql = "UPDATE admin SET switch=$status WHERE id=1 ";
            $conn->query($sql);
        }
        // End Update Switch
        // Check Switch 
            $sql = "SELECT switch FROM admin";
            $query = $conn->query($sql);
            $row = $query->fetch_assoc();
            $status = $row['switch'];
        // End Check Switch ?> 
        <script>
          function toggleSwitch(){
              document.getElementById('switchBtn').submit();
          }
        </script>
      <div class="col-xs-6 text-right">
        <form action="" id="switchBtn" method="post">
        <input type="checkbox" name="switchStatus" data-toggle="switchbutton" <?php if ($status) echo 'checked'; ?> data-onstyle="primary" data-offstyle="secondary" onchange="toggleSwitch()">
        </form>
        </div>
      </div>
      <div id="voting-tally">
        <?php
          $sql = "SELECT * FROM positions ORDER BY priority ASC";
          $query = $conn->query($sql);
          $inc = 3;
          while($row = $query->fetch_assoc()){
            $inc = ($inc == 3) ? 1 : $inc+1; 
            if($inc == 1) echo "<div class='row'>";
            echo "
              <div class='col-sm-4'>
                <div class='box box-solid'>
                  <div class='box-header with-border'>
                    <h4 class='box-title'><b>".$row['description']."</b></h4>
                  </div>
                  <div class='box-body'>
                    <div class='chart'>
                      <canvas id='".slugify($row['description'])."' style='height:100px'></canvas>
                    </div>
                  </div>
                </div>
              </div>
            ";
            if($inc == 3) echo "</div>";  
          }
          if($inc == 1) echo "<div class='col-sm-6'></div></div>";
        ?>
      </div>
    </section>
    <!-- right col -->
  </div>
  <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

<script>
  function AutoRefresh(t){
    setTimeout('location.reload(true);',t);
  }

  function generateChart(ctx, labels, data) {
        var barChartData = {
            labels: labels,
            datasets: [
                {
                    label: 'Votes',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: data
                }
            ]
        };

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,  // Allow height to adjust as well
            scales: {
                x: {
                    ticks: {
                        maxRotation: 60, // Rotate labels if they overflow
                        minRotation: 80, // Make labels fit better on smaller screens
                        autoSkip: true, // Skip labels if they overlap
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        };

        new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
    }
  

  <?php
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
      $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
      $cquery = $conn->query($sql);
      $carray = array();
      $varray = array();
      while($crow = $cquery->fetch_assoc()){
        array_push($carray, $crow['firstname']);
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        array_push($varray, $vquery->num_rows);
      }
      $carray = json_encode($carray);
      $varray = json_encode($varray);
  ?>
      $(function(){
        var description = '<?php echo slugify($row['description']); ?>';
        var ctx = $('#'+description).get(0).getContext('2d');
        generateChart(ctx, <?php echo $carray; ?>, <?php echo $varray; ?>);
      });
  <?php
    }
  ?>
</script> 

<style>
   .chart {
        position: relative;
        width: 100% !important;
        height: auto !important;
    }

    /* Optional: Add this to allow scrolling if too many items are shown */
    .chart-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
.small-box.bg-red {
    background: linear-gradient(135deg, #ff0000, #ff6347); /* Red gradient */
    color: white; /* Ensure the text is visible */
}
.small-box.bg-purple {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Adjust the colors as per your preference */
    color: white; /* Ensure the text color stands out against the gradient */
}

</style>
</body>
</html>
 <!-- ##violet -->
<!-- .small-box.bg-purple {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Adjust the colors as per your preference */
    color: white; /* Ensure the text color stands out against the gradient */
} -->
