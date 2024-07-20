<?php
include 'includes/session.php'; // Include session start logic if not already included
include 'includes/header.php'; // Include your header file
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Voting System Title</title>
    <!-- Additional meta tags, stylesheets, and scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="hold-transition skin-red layout-top-nav <?php echo date('Y-m-d H:i:s'); ?>">
<div class="wrapper">

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
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- /.navbar -->
    </header>
    <!-- /.main-header -->

    <!-- Your page content goes here -->
    <div class="content-wrapper">
        <!-- Example content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Welcome to Your Voting System</h1>
                        <p>This is the main content area.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /.wrapper -->

<?php include 'includes/scripts.php'; // Include your scripts file ?>
</body>
</html>
