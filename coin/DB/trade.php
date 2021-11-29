<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

$name = $_POST["name"];
$time = date("Y-m-d");
$transaction = $_POST["transaction"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$totalPrice = $_POST["totalPrice"];

$name = mysqli_real_escape_string($con, $name);
$time = mysqli_real_escape_string($con, $time);
$transaction = mysqli_real_escape_string($con, $transaction);
$price = mysqli_real_escape_string($con, $price);
$amount = mysqli_real_escape_string($con, $amount);
$totalPrice = mysqli_real_escape_string($con, $totalPrice);

$sql = "insert into coin_info ";
$sql .= "values(null,'$name', '$time', '$transaction', '$price', '$amount', '$totalPrice')";

mysqli_query($con, $sql) or die("삽입 ERROR" . mysqli_error($con)); // $sql 에 저장된 명령 실행

mysqli_close($con);

echo "
      <script>
        alert('거래 성공.');
        location.replace('coin.php');
      </script>
    ";
