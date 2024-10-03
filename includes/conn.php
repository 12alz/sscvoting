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


	echo "Connection Success"; 


	// backup
$mysqlUserName = '127.0.0.1:3306';
$mysqlPassword = '1Votesystem';
$mysqlHostName = 'u510162695_votesystem';
$dbName = 'u510162695_votesystem';

// Function to export the database
function ExportDatabase($host, $user, $pass, $name)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables = $mysqli->query('SHOW TABLES');
    $targetTables = [];

    while ($row = $queryTables->fetch_row()) {
        $targetTables[] = $row[0];
    }

    // ... (fetch data from tables and create SQL content)

    // Set appropriate headers for download
    $backupName = $name . '.sql';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"$backupName\"");
    echo $content;
    exit;
}

// Usage
ExportDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $dbName);
?>