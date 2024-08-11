<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" skin-green>
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-purple">
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
            <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-purple">
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
            <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM voters";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
             
              <p>Total <br>Voters</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM candidates ORDER BY id = 0";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Student <br>Voted</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-xs-6">
          <h3>Voting Tally</h3>
        </div>
        <div class="col-xs-6 text-right">
          <button id="fullscreen-btn" class="btn btn-primary bg-purple">Fullscreen</button>
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
      maintainAspectRatio: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    new Chart(ctx, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    });
  }

  document.getElementById('fullscreen-btn').addEventListener('click', function() {
    var elem = document.getElementById('voting-tally');
    if (!document.fullscreenElement) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) { /* Firefox */
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { /* IE/Edge */
        elem.msRequestFullscreen();
      }
      elem.style.backgroundColor = "lightgray";
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      }
      elem.style.backgroundColor = "";
    }
  });

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
</body>
</html>