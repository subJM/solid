<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    echo "
                <script>
                alert('로그인이 필요합니다.');
                location.replace('../coin.php');
                </script>";
                exit();
}

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";

if (isset($_POST["name"]) && isset($_POST["transaction"]) && isset($_POST["price"]) && isset($_POST["amount"]) && isset($_POST["totalPrice"])) {
    //2. mysql injection 함수 사용
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $transaction = mysqli_real_escape_string($con, $_POST["transaction"]);
    $price = mysqli_real_escape_string($con, $_POST["price"]);
    $amount = mysqli_real_escape_string($con, $_POST["amount"]);
    $totalPrice = mysqli_real_escape_string($con, $_POST["totalPrice"]);
    $time = date("Y-m-d");
    $myMoney = 0;
    //3. 공백이 있는지 점검
    if (empty($name) && empty($transaction) && empty($price) && empty($amount) && empty($totalPrice)) {
        exit();
    } else {
        if ($transaction == 'buy') {
            $sqlBuy = "SELECT * FROM purchase WHERE member_id ='$user_id'";
            $resultBuy = mysqli_query($con, $sqlBuy);

            while ($rowBuy = mysqli_fetch_assoc($resultBuy)) {
                $myMoney = $rowBuy['price'];
            }
            if ($myMoney - $totalPrice < 0) {
                echo "
                <script>
                alert('보유금액이 부족합니다.');
                location.replace('../coin.php');
                </script>";
                mysqli_close($con);
                exit();
            }

        } else {
            $totalAmount = 0;
            $sqlSell = "SELECT * FROM coin_info WHERE coinName ='$name'";
            $resultSell = mysqli_query($con, $sqlSell) or die("검색 ERROR" . mysqli_error($con));
            while ($rowSell = mysqli_fetch_assoc($resultSell)) {

                if ($rowSell['transaction'] === 'buy') {
                    $totalAmount += $rowSell['amount'];
                } else {
                    $totalAmount -= $rowSell['amount'];
                }
            }

            if ($totalAmount - $amount <= 0) {
                echo "
                <script>
                alert('판매할수있는 코인이 부족합니다.');
                location.replace('../coin.php');
                </script>";
                mysqli_close($con);
                exit();
            }
        }
        $sql = "insert into coin_info ";
        $sql .= "values(null,'$name', '$time', '$transaction', '$price', '$amount', '$totalPrice')";

        mysqli_query($con, $sql) or die("삽입 ERROR" . mysqli_error($con)); // $sql 에 저장된 명령 실행

        if ($transaction === 'buy') {
            $sql = "UPDATE purchase SET price = $myMoney - $totalPrice";
            mysqli_query($con, $sql) or die("수정 ERROR" . mysqli_error($con));
        } else {
            $sql = "UPDATE purchase SET price = '$myMoney + $totalPrice'";
            mysqli_query($con, $sql) or die("수정 ERROR" . mysqli_error($con));
        }
        echo "
        <script>
        alert('거래성공.');
        location.replace('../coin.php');
        </script>";
        mysqli_close($con);
        exit;

    }
} else {
    mysqli_close($con);
    exit();
}
