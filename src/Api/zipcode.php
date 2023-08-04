<?php
header('Content-Type: application/json');
// URL to make the GET request
$url = 'https://www.zipcodeapi.com/rest/hlkvYJ4xqENitmRbXDsT40JdfYwnhOTVUcW61fxe5kohNDum4Os6J3iTkKhEPspZ/info.json/'.$_GET['zipcode'];

// Initialize cURL session
$curl = curl_init($url);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it directly
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification (use with caution)
curl_setopt($curl, CURLOPT_TIMEOUT, 10); // Set timeout for the request in seconds

// Execute the cURL session and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    $error_message = curl_error($curl);
    // Handle the error appropriately
    echo "cURL Error: " . $error_message;
}

// Close cURL session
curl_close($curl);

// Handle the response data
if ($response) {
    // Handle the successful response from the API
    // In this example, we'll display the data
    echo json_encode($response);
} else {
    // Handle the case where no response is received
    echo json_encode(["error" => "No response received."]);
}