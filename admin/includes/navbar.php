<header class="main-header">
  <!-- Logo -->
  <a href="home.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SSC Voting System </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notification-btn">
            <i class="fa fa-bell"></i>
       
            <?php
            
            include '../includes/conn.php'; 
            $sql = "SELECT COUNT(*) as count FROM voters WHERE  notified = 0";
            $result = mysqli_query($conn, $sql);
            $notification_count = mysqli_fetch_assoc($result)['count'];
            ?>
            <span class="label label-warning" id="notification-count"><?php echo $notification_count; ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo $notification_count; ?> notifications</li>
            <li>
             
              <ul class="menu" id="notification-list">
                <?php
              
                $sql = "SELECT * FROM voters WHERE  notified";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                  echo '<li>
                          <a href="../admin/voters.php?id=' . htmlspecialchars($row['voters_id']) . '">
                            <i class="fa fa-users text-aqua"></i> ' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . '
                          </a>
                        </li>';
                }
                ?>
              </ul>
            </li>
            <li class="footer"><a href="../admin/voters.php">View all</a></li>
          </ul>
        </li>
 

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $user['firstname'].' '.$user['lastname']; ?>
                <small>Member since July 2024</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Edit</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#notification-btn').click(function(e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: 'includes/notification.php',
      data: { action: 'mark_as_read' },
      success: function(response) {
        if (response.success) {
          $('#notification-count').text('0');
        } else {
          console.error('Failed to update notifications.');
        }
      },
      dataType: 'json'
    });
  });
});
</script>

    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>