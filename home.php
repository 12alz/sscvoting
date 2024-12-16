<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    
    <div class="content-wrapper">
        <div class="container">

            <!-- Main content -->
            <section class="content">
                <?php
                    $parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
                    $title = $parse['election_title'];
                ?>
                <h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php
                        if(isset($_SESSION['error'])){
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul>
                                    <?php
                                    foreach($_SESSION['error'] as $error){
                                        echo "
                                            <li>".$error."</li>
                                        ";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
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

                        <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="message"></span>
                        </div>
                        <?php
                        // Check If Voting Started
                        $ssql = "SELECT switch FROM admin WHERE id = 1";
                        $squery = $conn->query($ssql);
                        $row  = $squery->fetch_assoc();

                        if($row['switch'] == 0){
                            ?>
                            <div class="text-center">
                                <h3>Please wait for voting to start.</h3>
                            </div>
                            <?php 
                        } else {
                            $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
                            $vquery = $conn->query($sql);
                            if($vquery->num_rows > 0){
                                ?>
                                <div class="text-center">
                                    <h3>You have already voted for this election.</h3>
                                    <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <!-- Voting Ballot -->
                                <form method="POST" id="ballotForm" action="submit_ballot.php">
                                    <!-- Course Selection -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="course">Select your Course</label>
                                            <select name="course" id="course" class="form-control">
                                                <option value="">-- Select Course --</option>
                                                <option value="bsit">BSIT</option>
                                                <option value="bsis">BSIS</option>
                                                <!-- Add other courses here -->
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Voting Ballot Content -->
                                    <div id="voting-ballot">
                                        <?php
                                            include 'includes/slugify.php';
                                            
                                            $candidate = '';
                                            $sql = "SELECT * FROM positions ORDER BY priority ASC";
                                            $query = $conn->query($sql);
                                            while($row = $query->fetch_assoc()){
                                                $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                                                $cquery = $conn->query($sql);
                                                while($crow = $cquery->fetch_assoc()){
                                                    $slug = slugify($row['description']);
                                                    $checked = '';
                                                    if(isset($_SESSION['post'][$slug])){
                                                        $value = $_SESSION['post'][$slug];

                                                        if(is_array($value)){
                                                            foreach($value as $val){
                                                                if($val == $crow['id']){
                                                                    $checked = 'checked';
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            if($value == $crow['id']){
                                                                $checked = 'checked';
                                                            }
                                                        }
                                                    }
                                                    
                                                    $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
                                                    
                                                    $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';

                                                    $candidate .= '
                                                        <li class="candidate" data-course="'.$crow['course'].'">
                                                            '.$input.'<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'"><i class="fa fa-search"></i> Platform</button><img src="'.$image.'" height="100px" width="100px" class="clist"><span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
                                                        </li>
                                                    ';
                                                }

                                                $instruct = ($row['max_vote'] > 1) ? 'You may select up to '.$row['max_vote'].' candidates' : 'Select only one candidate';

                                                echo '
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="box box-solid" id="'.$row['id'].'">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><b>'.$row['description'].'</b></h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    <p>'.$instruct.'
                                                                        <span class="pull-right">
                                                                            <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="'.slugify($row['description']).'"><i class="fa fa-refresh"></i> Reset</button>
                                                                        </span>
                                                                    </p>
                                                                    <div id="candidate_list">
                                                                        <ul>
                                                                            '.$candidate.'
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                                                $candidate = '';
                                            }
                                        ?>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button> 
                                        <button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                                    </div>
                                </form>
                                <?php
                            }
                        }
                    ?>
                </div>
            </section>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>

<script>
<script>
$(document).ready(function() {
    // Handle course selection change
    $('#course').change(function() {
        var selectedCourse = $(this).val();  // Get the selected course
        
        // If a course is selected, filter candidates based on the selected course
        if (selectedCourse) {
            // Show candidates whose data-course matches the selected course, hide others
            $('#voting-ballot .candidate').each(function() {
                var course = $(this).data('course');  // Get the course for this candidate
                if (course === selectedCourse) {
                    $(this).show();  // Show this candidate
                } else {
                    $(this).hide();  // Hide this candidate
                }
            });
        } else {
            // If no course is selected, show all candidates
            $('#voting-ballot .candidate').show();
        }
    });

    // Initialize the filtering (in case a course is selected by default)
    $('#course').trigger('change');
});
</script>

</script>

</body>
</html>
