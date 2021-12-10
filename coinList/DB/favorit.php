<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
session_start();

// if (!isset($_SESSION["user_id"])) {
//     $message = '로그인이 필요합니다.';
//     alert_back($message);
// }

// $user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM favorite_coin";
$list = array();
$result = mysqli_query($con, $sql) or die("검색 ERROR" . mysqli_error($con));
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    $list[$count++] = $row['coinName'];
}

if (!isset($_POST['client'])) {
    echo "let favorit_coinName = " . json_encode($list);

} else {
    echo json_encode($list);
}

mysqli_close($con);
