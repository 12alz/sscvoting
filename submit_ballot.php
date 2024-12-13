<?php
    include 'includes/session.php';
    include 'includes/slugify.php';

    if (isset($_POST['vote'])) {
        // Ensure that at least one candidate is selected
        if (count($_POST) == 1) {
            $_SESSION['error'][] = 'Please vote for at least one candidate';
        } else {
            $_SESSION['post'] = $_POST;
            $sql = "SELECT * FROM positions";
            $query = $conn->query($sql);
            $error = false;
            $sql_array = array();

            while ($row = $query->fetch_assoc()) {
                $position = slugify($row['description']); // Generate a slug for the position
                $pos_id = $row['id'];

                // Check if candidates are selected for this position
                if (isset($_POST[$position])) {
                    $selected_candidates = $_POST[$position]; // Get selected candidates for this position
                    $max_votes = $row['max_vote']; // Get the max votes allowed for this position

                    // Case: Multiple votes allowed (max_vote > 1)
                    if ($max_votes > 1) {
                        // If more candidates are selected than allowed
                        if (count($selected_candidates) > $max_votes) {
                            $error = true;
                            $_SESSION['error'][] = 'You can only choose ' . $max_votes . ' candidates for ' . $row['description'];

                            // Limit to the maximum number of votes allowed
                            $selected_candidates = array_slice($selected_candidates, 0, $max_votes);
                        }

                        // Insert each valid selected candidate into the votes table
                        foreach ($selected_candidates as $candidate_id) {
                            $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) 
                                             VALUES ('" . $voter['id'] . "', '$candidate_id', '$pos_id')";
                        }

                    } else { 
                        // Case: Only one vote allowed (max_vote == 1)
                        $candidate = $selected_candidates[0]; // Only one candidate can be selected
                        $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) 
                                         VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
                    }
                }
            }

            // If there were no errors, execute all the insert queries for votes
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

    // Redirect after processing
    header('location: home');
?>
