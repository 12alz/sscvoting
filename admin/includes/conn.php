<?php
// database credential
$host = "127.0.0.1:3306";
$dbname = "u510162695_votesystem";
$username = "u510162695_votesystem";
$password = "1Votesystem";

//create connection
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		//echo "Connection Failed";
	}
	//echo "Connection Success";

	// Set the filename for the download
	$filename = $database . "_backup_" . date("Y-m-d_H-i-s") . ".sql";

	// Create a command to export the database
	$command = "mysqldump --opt -h $host -u $user -p$password $database > $filename";

	// Execute the command
	system($command);

	// Check if the file exists and initiate the download
	if (file_exists($filename)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/sql');
		header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush(); // Flush system output buffer
		readfile($filename);
		exit;
	} else {
		echo "Error creating backup.";
	}

	// Close the database connection
	$conn->close();
?>