<?php
// A sample PHP Script to POST data using cURL
// Data in JSON format

$data = array(
    'USERNAME' => 'nandini',
    'PASSWORD' => 'pass'
);

$payload = json_encode($data);

// Prepare new cURL resource
$ch = curl_init('http://localhost/estore/User_login.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);

// Submit the POST request
$result = curl_exec($ch);
echo $result;
// Close cURL session handle
curl_close($ch);

?>