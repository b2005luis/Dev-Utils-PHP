<?php

$END_PONT = "http://127.0.0.1/Dev-Utils/PHP/Financial/Investment/YahooQuotes.php";

$FIELD_PARAMS = [
    "Token" => "E7254AD7-DE861254-A90D17BA-B271795B",
    "Ticker" => "WEGE3"
];

$Channel = curl_init();

curl_setopt($Channel, CURLOPT_RETURNTRANSFER, true);
curl_setopt($Channel, CURLOPT_URL, $END_PONT);
curl_setopt($Channel, CURLOPT_POSTFIELDS, $FIELD_PARAMS);

$Result = curl_exec($Channel);
// $Result = json_decode($Result);

curl_close($Channel);

print($Result);