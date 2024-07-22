<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>Voting</b>System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
            </a>
          </li>
          <li><a href="#" id="logout"><i class="fa fa-sign-out"></i> LOGOUT</a></li>  
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      document.getElementById('logout').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          icon: 'success',
          title: 'Successfully sign out!',
          text: '<?php echo $_SESSION['success']; ?>',
        
            window.location.href = 'logout.php';
          
        });
      });
    </script>
  </nav>
</header>
