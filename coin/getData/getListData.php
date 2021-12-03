<?php
error_reporting(E_ALL ^ E_NOTICE);
$coinName = $_GET['name'];
$urlTicker = "https://api.bithumb.com/public/ticker/" . $coinName;
$urlTransaction = "https://api.bithumb.com/public/transaction_history/" . $coinName;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlTicker);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$resultTicker = curl_exec($curl);

curl_setopt($curl, CURLOPT_URL, $urlTransaction);
$resultTransaction = curl_exec($curl);
$ticker = json_decode($resultTicker);
$transaction = json_decode($resultTransaction);

curl_close($curl);

$list = array();

$closing_price = $ticker->data->prev_closing_price;
$current_price = $transaction->data[0]->price;
$change = ceil((($closing_price - $current_price) / $closing_price) * 10000) / 100;
$list[$coinName] = array();
$list[$coinName]['closing_price'] = $closing_price;
$list[$coinName]['current_price'] = $current_price;
$list[$coinName]['change'] = $change . '%';

echo $list;
​?>
