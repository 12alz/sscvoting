<?php
// download_script.php


$filename = "template.csv";

// Set headers to trigger a download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');


fputcsv($output, ['Firstname', 'Lastname', 'Username']); 


fclose($output);
exit();
?>
