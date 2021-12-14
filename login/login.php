<?php
header('Content-Type: text/html; charset=UTF-8');
include "../db/db_connector.php";
error_reporting(E_ALL ^ E_NOTICE);
$id = $_POST["id"];
$password = $_POST["password"];
if (!isset($_POST['client'])) {

    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);

    $num_match = mysqli_num_rows($result);

    if (!$num_match) {
        echo ("
            <script>
              window.alert('등록되지 않은 아이디입니다!')
              history.go(-1)
            </script>
          ");
    } else {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["password"];

        if (!$db_pass) {
            echo ("
                <script>
                  console.log('$db_pass');
                  window.alert('비밀번호가 틀립니다!')
                  history.go(-1)
                </script>
            ");

            mysqli_close($con);
            exit;
        } else {
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["user_level"] = $row["level"];

            echo ("
                <script>
                  location.href = '../index.php';
                </script>
              ");

            mysqli_close($con);
        }
    }
} else {

    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);

    $num_match = mysqli_num_rows($result);

    if (!$num_match) {
        echo "false";
    } else {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["password"];

        if (!$db_pass) {
            echo "false";

            mysqli_close($con);
            exit;
        } else {
            session_start();

            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["user_level"] = $row["level"];

            echo "true";

            mysqli_close($con);
        }
    }
}
