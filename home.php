<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	
	<div class="content-wrapper">
		<div class="container">
			<section class="content">
				<h1 class="page-header text-center title"><b>Election Voting</b></h1>

				<!-- Course Selection Dropdown -->
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="course">Select Course</label>
							<select id="course" class="form-control">
								<option value="">All Courses</option>
								<option value="bsit">BSIT</option>
								<option value="bsis">BSIS</option>
								<option value="bsba">BSBA</option>
							</select>
						</div>
					</div>
				</div>

				<!-- Voting Ballot Form -->
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
								// Add other logic here to preselect candidates based on previous votes, if necessary

								$input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
								
								$image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';

								// Add the data-course attribute to filter candidates
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

			</section>
		</div>
	</div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/scripts.php'; ?>

</div>

<script>
// Filtering Candidates Based on Course
$(document).ready(function() {
    $('#course').change(function() {
        var selectedCourse = $(this).val();  // Get the selected course
        if (selectedCourse) {
            $('#voting-ballot .candidate').each(function() {
                var course = $(this).data('course');  // Get the course for this candidate
                if (course === selectedCourse) {
                    $(this).show();  // Show candidate for selected course
                } else {
                    $(this).hide();  // Hide candidate from other courses
                }
            });
        } else {
            $('#voting-ballot .candidate').show();  // Show all candidates if no course is selected
        }
    });
    // Initialize filtering
    $('#course').trigger('change');
});
</script>

</body>
</html>
