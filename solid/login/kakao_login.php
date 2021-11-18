<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

$id   = $_GET["id"];

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

    mysqli_close($con);

    session_start();
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["user_name"] = $row["name"];
    $_SESSION["user_level"] = $row["level"];

    echo ("
            <script>
              location.href = '../index.php';
            </script>
          ");
}
?>