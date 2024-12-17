<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<body class="skin-red" style="background: rgba(60, 141, 188, 0.9);">

<!-- Fonts and Stylesheets -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CMerriweather:400,300,300italic,400italic,700,700italic">
<link rel="stylesheet" href="dist/css/bootstrap.css">
<link rel="stylesheet" href="dist/css/fonts.css">
<link rel="stylesheet" href="dist/css/style.css">

<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
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

      <!-- Stats Boxes -->
      <div class="row">
        <?php
          $stats = [
            ['title' => 'No. of Positions', 'icon' => 'fa-tasks', 'sql' => 'SELECT * FROM positions', 'link' => 'positions'],
            ['title' => 'No. of Inactive Voters', 'icon' => 'fa-child', 'sql' => 'SELECT COUNT(*) AS total FROM microsoft WHERE id NOT IN (SELECT voters_id FROM votes)', 'link' => ''],
            ['title' => 'MS365 Accounts', 'icon' => 'fa-black-tie', 'sql' => 'SELECT * FROM import_ms365', 'link' => 'msaccount'],
            ['title' => 'No. of Candidates', 'icon' => 'fa-black-tie', 'sql' => 'SELECT * FROM candidates', 'link' => 'candidates'],
            ['title' => 'Total Voters', 'icon' => 'fa-users', 'sql' => 'SELECT * FROM voters WHERE recstat = 0', 'link' => 'voters'],
            ['title' => 'Students Voted', 'icon' => 'fa-edit', 'sql' => 'SELECT * FROM votes GROUP BY voters_id', 'link' => 'votes'],
          ];

          foreach ($stats as $stat) {
            $query = $conn->query($stat['sql']);
            $num_rows = $query ? $query->num_rows : 0;
            echo "
              <div class='col-lg-4 col-xs-6'>
                <div class='small-box bg-red'>
                  <div class='inner'>
                    <h3>$num_rows</h3>
                    <p>{$stat['title']}</p>
                  </div>
                  <div class='icon'>
                    <i class='fa {$stat['icon']}'></i>
                  </div>
                  <a href='{$stat['link']}' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
                </div>
              </div>
            ";
          }
        ?>
      </div>

      <!-- Enable/Disable Voting by Course -->
      <div class="row">
        <h3>Enable/Disable Voting by Course</h3>
        <?php
          $sql = "SELECT * FROM course_switches";
          $query = $conn->query($sql);

          while ($row = $query->fetch_assoc()) {
            ?>
            <div class="col-xs-6">
              <form method="POST" action="">
                <label for="switch_<?php echo $row['course_name']; ?>"><?php echo $row['course_name']; ?> Voting</label>
                <input type="checkbox" name="switch_<?php echo $row['course_name']; ?>" data-toggle="switchbutton" <?php echo $row['switch'] == 1 ? 'checked' : ''; ?> data-onstyle="primary" data-offstyle="secondary" onchange="this.form.submit()">
                <input type="hidden" name="course_name" value="<?php echo $row['course_name']; ?>">
              </form>
            </div>
            <?php
          }
        ?>
      </div>

      <!-- Voting Tally -->
      <div class="row">
        <div class="col-xs-6">
          <h3>Voting Tally</h3>
        </div>

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

          while ($row = $query->fetch_assoc()) {
            $inc = ($inc == 3) ? 1 : $inc + 1;
            if ($inc == 1) echo "<div class='row'>";

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

            if ($inc == 3) echo "</div>";
          }
          if ($inc == 1) echo "<div class='col-sm-6'></div></div>";
        ?>
      </div>
    </section>
  </div>

  <?php include 'includes/footer.php'; ?>

</div>

<?php include 'includes/scripts.php'; ?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

<script>
  function toggleSwitch() {
    document.getElementById('switchBtn').submit();
  }

  function generateChart(ctx, labels, data) {
    var barChartData = {
      labels: labels,
      datasets: [{
        label: 'Votes',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        data: data
      }]
    };

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
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

  <?php
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
      $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
      $cquery = $conn->query($sql);
      $carray = array();
      $varray = array();

      while ($crow = $cquery->fetch_assoc()) {
        array_push($carray, $crow['firstname']);
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        array_push($varray, $vquery->num_rows);
      }
      $carray = json_encode($carray);
      $varray = json_encode($varray);
  ?>
      $(function() {
        var description = '<?php echo slugify($row['description']); ?>';
        var ctx = $('#'+description).get(0).getContext('2d');
        generateChart(ctx, <?php echo $carray; ?>, <?php echo $varray; ?>);
      });
  <?php
    }
  ?>
</script>

<style>
  .small-box.bg-red {
    background: linear-gradient(135deg, #ff0000, #ff6347);
    color: white;
  }

  .small-box.bg-purple {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
  }
</style>

</body>
</html>
