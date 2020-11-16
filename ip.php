<?php
$ip = '134.201.250.155';
$access_key = '4985d1432ad4a137720f0660bf48267d';

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, true);
print_r($api_result);
// Output the "capital" object inside "location"
echo $api_result['location']['capital'];
?>