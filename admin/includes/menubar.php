<aside class="main-sidebar"id="nav">>
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" >
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="votes.php"><span class="glyphicon glyphicon-lock"></span> <span>Votes</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span>Student Voters</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span>SSC Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span>SSC Candidates</span></a></li>
      <li class=""><a href="msaccount.php"><i class="fa fa-folder"></i> <span>MS365 Accounts</span></a></li>
      <li class=""><a href="add_news.php"><i class="fa fa-newspaper-o"></i> <span>Newsletter</span></a></li>
      <li class="header">SETTINGS</li>
      <li class="" > <a href="print.php"><span class="glyphicon glyphicon-print"></span> Print Result</a></span></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<script type="text/javascript">
  var nav = document.getElementById('nav');
  window.onscroll = function(){
    if (window.pageYOffset > 100) {
      nav.style.position = "fixed";
      nav.style.top = 0;
    }else{
      nav.style.position = "absolute";
      nav.style.top = "100";
    }
  }
</script>