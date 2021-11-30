<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

echo "
      <script>
        alert('거래 성공.');
        location.replace('../coin.php');
      </script>
    ";

if (isset($_POST["name"]) && isset($_POST["transaction"]) && isset($_POST["price"]) && isset($_POST["amount"]) && isset($_POST["totalPrice"])) {

    //2. mysql injection 함수 사용
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $transaction = mysqli_real_escape_string($con, $_POST["transaction"]);
    $price = mysqli_real_escape_string($con, $_POST["price"]);
    $amount = mysqli_real_escape_string($con, $_POST["amount"]);
    $totalPrice = mysqli_real_escape_string($con, $_POST["totalPrice"]);
    $time = date("Y-m-d");

    //3. 공백이 있는지 점검
    if (empty($name) && empty($transaction) && empty($price) && empty($amount) && empty($totalPrice)) {
        exit();
    } else {
        // if (condition) {
        $sql = "insert into coin_info ";
        $sql .= "values(null,'$name', '$time', '$transaction', '$price', '$amount', '$totalPrice')";

        mysqli_query($con, $sql) or die("삽입 ERROR" . mysqli_error($con)); // $sql 에 저장된 명령 실행

        mysqli_close($con);
        // }

    }
} else {
    mysqli_close($con);
    exit();
}
