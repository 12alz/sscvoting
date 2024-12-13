<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    // Check if the user has already voted
    $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
    $vquery = $conn->query($sql);
    
    if ($vquery->num_rows > 0) {
        $_SESSION['error'][] = 'You have already voted in this election.';
    } else {
        // Initialize error flag and vote submission array
        $error = false;
        $sql_array = array();

        // Loop through all positions to check for vote integrity
        $sql = "SELECT * FROM positions";
        $query = $conn->query($sql);

        while ($row = $query->fetch_assoc()) {
            $position = slugify($row['description']);
            $pos_id = $row['id'];

            if (isset($_POST[$position])) {
                $selectedCandidates = $_POST[$position]; // Get the selected candidates

                // If max vote is 1, ensure only one candidate is selected
                if ($row['max_vote'] == 1 && count($selectedCandidates) > 1) {
                    $error = true;
                    $_SESSION['error'][] = 'You can only choose one candidate for ' . $row['description'];
                } else {
                    // Insert each selected candidate into the database
                    foreach ($selectedCandidates as $candidate_id) {
                        $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate_id', '$pos_id')";
                    }
                }
            }
        }

        // If no errors, save the votes
        if (!$error) {
            foreach ($sql_array as $sql_row) {
                $conn->query($sql_row);
            }

            unset($_SESSION['post']);
            $_SESSION['success'] = 'Your vote has been successfully submitted!';
        }
    }
} else {
    $_SESSION['error'][] = 'Please select at least one candidate to vote for.';
}

header('location: home');
?>
