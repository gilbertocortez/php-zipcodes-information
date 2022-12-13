<?php
// -------------------------------------------------------------------------------------------------------------------
// Project:     Zip Code Information Generator
// Technology:  PHP, HTML, CSS
// Author:      Gilberto Cortez
// Website:     InteractiveUtopia.com
// -------------------------------------------------------------------------------------------------------------------

// Start Server Session
session_start();

// Display All Errors (For Easier Development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include Zip API Key (Kept Secret for Security)
// Importing variables: $key_zipapi (API Key), $key_zipapi_email (API User eMail), $key_zipapi_password (API User Password);
include '../../_private/config.php';

// Provide User Zip Code for Call
$call_zipcode = '92115';
$call_city = 'Chula+Vista';
$call_sate = 'CA';

// URL where cURL will make the request
$url = "https://service.zipapi.us/zipcode/$call_zipcode?X-API-KEY=$key_zipapi&fields=geolocation,population";
//$url = "https://service.zipapi.us/zipcode/zips?X-API-KEY=$key_zipapi&city=$call_city&state=$call_sate";
//$url = "https://service.zipapi.us/population/zipcode/$call_zipcode?X-API-KEY=$key_zipapi&fields=male_population,female_population";

// Initiate the cURL object
$curl = curl_init();

// Set up cURL connection option
// Set up URL
curl_setopt($curl, CURLOPT_URL, $url);
// Set up user log in credentials
curl_setopt($curl, CURLOPT_USERPWD, $key_zipapi_email . ":" . $key_zipapi_password);
// Expecting a response
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// Protocols to use
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// Verify SSL Certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


// Execute cURL Call and store response is $result variable
$result = curl_exec($curl);
// If the response is empty, kill script and provide Connection Failure error
if(!$result){
    die("Connection Failure");
}

// Close cURL Connection
curl_close($curl);

$result_object = json_decode($result);


// Print Response
echo '<pre>';
print_r( $result_object );
echo '</pre>';
