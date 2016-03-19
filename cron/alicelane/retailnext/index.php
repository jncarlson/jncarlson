<?php


$requestURL = "https://alicelane.cust.retailnext.net/retailnext/api/query?measures=traffic+subtype=out+alias=traffic_out+verbose=true&groupings=location;hour_minute+unit_size=60+verbose=true&date_ranges=currentday&time_ranges=store_hours&location_ids=a38d5c4d-24a1-4f24-9a32-3dc503e65603;8cb753b4-5be4-433b-b6e7-01e93b527b3e&api_key=ED5A0684-A43B-552B-5249-7B3562B8EBE2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $requestURL);
curl_setopt($ch, CURLOPT_POST, 0);
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
curl_close ($ch);

print_r($server_output);



