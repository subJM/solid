<?php
error_reporting(E_ALL ^ E_NOTICE);
$url = "https://api.bithumb.com/public/ticker/all";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($curl);
curl_close($curl);
$data = $responseData['data'];
echo $data;
