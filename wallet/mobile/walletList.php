<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
session_start();
// if (isset($_SESSION["user_id"])) {
//     $user_id = $_SESSION["user_id"];

    $totalAmount;
    $buyPrice;
    $sql = "SELECT * FROM coin_info";
    $result = mysqli_query($con, $sql);
    $coinNameArray = array();
    $coinName = "SELECT DISTINCT coinName FROM coin_info";
    $coinNameResult = mysqli_query($con, $coinName);

    $walletList = array();
    $sqlBuy = "SELECT * FROM purchase";
    $resultBuy = mysqli_query($con, $sqlBuy);
    $myMoney = 0;
    while ($rowBuy = mysqli_fetch_assoc($resultBuy)) {
        $myMoney = $rowBuy['price'];
    }

    while ($row = @mysqli_fetch_array($coinNameResult)) {

        $totalAmount = 0;
        $buyPrice = 0;
        $buyAmount = 0;
        $coinSql = "SELECT*FROM coin_info WHERE coinName = '$row[coinName]'";
        $coinData = mysqli_query($con, $coinSql);
        $coinNameArray[] = $row['coinName'];
        while ($row1 = mysqli_fetch_array($coinData)) {

            if ($row1['transaction'] == "buy") {
                $totalAmount += $row1['amount'];
                $buyPrice += $row1['totalPrice'];
                $buyAmount += $row1['amount'];

            } else {
                $totalAmount = $totalAmount - $row1['amount'];
            }

        }
        $wallet = array();
        $wallet['name'] = $row['coinName'];
        $wallet['totalAmount'] = $totalAmount;
        $wallet['avgPrice'] = $buyPrice / $buyAmount;
        $wallet['money'] = $myMoney;

        $walletList[] = $wallet;
    }
    echo json_encode($walletList);

// }
