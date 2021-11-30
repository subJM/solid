<?php
include "http://<?= $_SERVER['HTTP_HOST'] ?>/solid/db/db_connector.php";

if(!isset($_POST['client'])){
  $id   = $_POST["id"];
  $password = $_POST["password"];

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
  }else{
    $id   = $_POST["id"];
    $password = $_POST["password"];

    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);

    $num_match = mysqli_num_rows($result);

    if (!$num_match) {
        echo json_encode(array(
          "status" => "false",
          "message" => "ID missing!"
      ));
    } else {
      $row = mysqli_fetch_array($result);
      $db_pass = $row["password"];

      if (!$db_pass) {
        echo json_encode(array(
          "status" => "false",
          "message" => "Password missing!"
        ));

        mysqli_close($con);
        exit;
      } else {
        session_start();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_name"] = $row["name"];
        $_SESSION["user_level"] = $row["level"];

        echo json_encode(array(
          "status" => "true",
          "message" => "Success!"
        ));

        mysqli_close($con);
      }
    }
  }
?>