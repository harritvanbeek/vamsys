<?php 

include_once "includes/vamsys.php";
$vamsys =   new vamsys();


/* 
    find airport based on :
        airport_code  
        airport_id
        booking_id
*/
//echo "<pre>", print_R($vamsys->findAirport(["airport_code" => "EHAM"]));




//echo "<pre>", print_R($vamsys->airline());
//echo "<pre>", print_R($vamsys->statistics());
//echo "<pre>", print_R($vamsys->activeFlights());

//set discord user id
//echo "<pre>", print_R($vamsys->pilot());

/* 
    Get aircraft information from :
        aircraft_id
        booking_id
        aircraft_registration
*/

//echo "<pre>", print_R($vamsys->aircraft(["aircraft_registration" => "PH-MPS"]));
//echo "<pre>", print_R($vamsys->events());

/* 
    Get metar information from :
        airport_code
        date_time
*/
echo "<pre>", print_R(  $vamsys->metar(["airport_code" => "EHAM"]) );

























die;
//Documentation listed URL: /api/[...]/aircraft
//URL for you to use: https://vamsys.io/api/token/v1/aircraft


// URL of the API
   $apikey  = "252|VE6E2gwDPCjtS7V43WHibr7gFK7q9xwJJR8H6sJ8ff4d56bb";
   $url     = "https://vamsys.io/api/token/v1/discord/airport/find";
        
   
   // Set the headers
   $headers = [
       'Authorization: Bearer '.$apikey,
       'Accept: application/json'
    ];
    
    // Initialize cURL session
    $ch = curl_init($url);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true); // Set request method to POST
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set the headers
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query(array('airport_code' => 'EHAM')));
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL verification if necessary
    
    // Execute the request and get the response
    $response = curl_exec($ch);
    
    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Get HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($httpCode == 200) {
            // Print the response data
            echo "<pre>", print_r($response);
        } else {
            // Print the error code if the request failed
            echo 'Error: HTTP Status Code ' . $httpCode;
        }
    }
    
    // Close the cURL session
    curl_close($ch);
    