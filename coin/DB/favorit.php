<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
session_start();

if (isset($_POST["coinName"])) {
    $coinName = mysqli_real_escape_string($con, $_POST["coinName"]);

    if (empty($coinName)) {
        exit();
    } else {

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT coinName FROM favorite_coin WHERE coinName ='$coinName' AND id='$user_id'";
        $result = mysqli_query($con, $sql) or die("검색 ERROR" . mysqli_error($con));
        $result_record = mysqli_num_rows($result);
        if (!$result_record) {
            $sql = "insert into favorite_coin values(null,'$user_id','$coinName')";

            mysqli_query($con, $sql) or die("삽입 ERROR" . mysqli_error($con));
            $message = '즐겨찾기 성공.';
            mysqli_close($con);
            alert_back($message);
        } else {
            $sql = "delete from favorite_coin where coinName='$coinName'";

            mysqli_query($con, $sql) or die("삭제 ERROR" . mysqli_error($con));
            $message = '즐겨찾기 삭제성공.';
            mysqli_close($con);
            alert_back($message);
        }

    }
} else {
    mysqli_close($con);
}
