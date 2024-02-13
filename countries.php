<?php

$url = "https://restcountries.com/v3.1/all";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
$output = curl_exec($ch);
curl_close($ch);
$countries = json_decode($output);

$population = 0;
foreach($countries as $country) {
    // echo $country->name->official . '<br>';
    // echo $country->population . "<br><hr>";

    $population += $country->population;
}

echo $population;