<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if (isset($_POST['vote'])) {
		// Ensure at least one candidate is selected
		if (count($_POST) == 1) {
			$_SESSION['error'][] = 'Please vote for at least one candidate';
		} else {
			$_SESSION['post'] = $_POST;
			$sql = "SELECT * FROM positions";
			$query = $conn->query($sql);
			$error = false;
			$sql_array = array();

			// Iterate through all positions
			while ($row = $query->fetch_assoc()) {
				$position = slugify($row['description']); // Generate position key based on description
				$pos_id = $row['id'];

				// Check if the position has candidates selected
				if (isset($_POST[$position])) {
					$selected_candidates = $_POST[$position]; // Get the selected candidates for this position
					$max_votes = $row['max_vote']; // Get the max number of votes allowed for the position

					// If multiple candidates can be selected (max_vote > 1)
					if ($max_votes > 1) {
						// Check if more than the allowed number of candidates are selected
						if (count($selected_candidates) > $max_votes) {
							$error = true;
							$_SESSION['error'][] = 'You can only choose ' . $max_votes . ' candidates for ' . $row['description'];

							// Automatically limit to the first 2 candidates if more than 2 are selected
							$selected_candidates = array_slice($selected_candidates, 0, $max_votes);
						}

						// Insert each selected candidate into the votes table
						foreach ($selected_candidates as $candidate_id) {
							$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) 
										     VALUES ('" . $voter['id'] . "', '$candidate_id', '$pos_id')";
						}

					} else { 
						// If only one candidate can be selected (max_vote == 1)
						$candidate = $selected_candidates[0];
						$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) 
									     VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
					}
				}
			}

			// If no error, execute all the vote insertions
			if (!$error) {
				foreach ($sql_array as $sql_row) {
					$conn->query($sql_row);
				}

				unset($_SESSION['post']);
				$_SESSION['success'] = 'Ballot Submitted';
			}
		}
	} else {
		$_SESSION['error'][] = 'Select candidates to vote first';
	}

	// Redirect back to the home page after handling
	header('location: home');
?>
