<?php
// download_script.php

// Define the CSV file name
$filename = "template.csv";

// Set headers to trigger a download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Add header row to the CSV
fputcsv($output, ['Firstname', 'Lastname', 'Username']); // Customize as needed

// Optionally, you can add sample data
// fputcsv($output, ['Sample Firstname', 'Sample Lastname', 'Sample Username']);

// Close the output stream
fclose($output);
exit();
?>
