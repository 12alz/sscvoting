<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	if (isset($_POST['vote'])) {
		if (count($_POST) == 2) {
			$_SESSION['error'][] = 'Please vote at least one candidate';
		} else {
			$_SESSION['post'] = $_POST;
			$sql = "SELECT * FROM positions ORDER BY priority ASC";
			$query = $conn->query($sql);
			$error = false;
			$sql_array = array();
	
			while ($row = $query->fetch_assoc()) {
				$position = slugify($row['description']);
				$pos_id = $row['id'];
				if (isset($_POST[$position])) {
					$selectedCandidates = $_POST[$position];
					$maxVote = $row['max_vote'];
	
					// Kung ang bilang ng napiling kandidato ay lumampas sa max_vote, magpakita ng error
					if (count($selectedCandidates) > $maxVote) {
						$error = true;
						$_SESSION['error'][] = 'You can only select up to ' . $maxVote . ' candidates for ' . $row['description'];
					} else {
						// Kung wasto, isama ang mga napiling kandidato sa database
						foreach ($selectedCandidates as $key => $values) {
							$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$values', '$pos_id')";
						}
					}
				}
			}
	
			if (!$error) {
				// I-commit ang lahat ng mga boto sa database
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
	
	header('location: home');
	

?>