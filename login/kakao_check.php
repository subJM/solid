<?php
  include $_SERVER['DOCUMENT_ROOT']."/solid/db/db_connector.php";
  session_start();
  $kakao_name = $_POST["kakao_name"];
  $kakao_email = $_POST["kakao_email"];
  $test = "#";

  $kakao_name = str_replace("\"", "", $kakao_name);
  $kakao_email = str_replace("\"", "", $kakao_email);

  $sql = "select * from members where name='$kakao_name' and email='$kakao_email';";
  $result = mysqli_query($con,$sql);
  mysqli_close($con);

  echo $kakao_name;
  echo $test;
  echo $kakao_email;
  
  $rowcount=mysqli_num_rows($result);
  if(!$rowcount){
    $s = '[{"kakao_id":"실패"}]';
  }else{
    $_SESSION['user_id']=$kakao_email;
    $_SESSION['user_name']=$kakao_name;
    $s = '[{"kakao_id":"성공"}]';
  }
 ?>
