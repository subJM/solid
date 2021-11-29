<?php
function create_procedure($con, $procedure_name)
{
  $flag = "NO";
  $sql = "SHOW PROCEDURE STATUS WHERE db = 'todagtodag';";
  $result = mysqli_query($con, $sql) or die('Error: ' . mysqli_error($con));

  while ($row = mysqli_fetch_row($result)) {
    if ($row[1] === "$procedure_name") { //문자열로 넘어오므로 ""으로 처리 ''은 문자열뿐아니라 속성도 반영
      $flag = "OK";
      break;
    }
  } //end of while

  if ($flag === "NO") {
    switch ($procedure_name) {
      case 'members_procedure':
        $sql = "
            CREATE PROCEDURE `members_procedure`()
            BEGIN
            INSERT INTO `members` (`id`,`password`,`name`,`phone`,`email`,`address`,`regist_day`,`level`) VALUES ('master','123456','관리자','010-0000-0000','user1001@gmail.com','10000\$서울특별시 강남구 강남동\$1001동 101호','2021-11-29', 1);
            END";
        break;
      
        default : 
        echo "<script>alert('해당 프로지서명이 없습니다. 점검요망!');</script>";
      break;
    }

    if (mysqli_query($con, $sql)) {
      echo "<script>alert('$procedure_name 프로시저가 생성되었습니다.');</script>";
      call_procedure($con, $procedure_name);
    } else {
      echo "프로시저 생성 중 실패원인" . mysqli_error($con);
    }
  } //end of if flag

} //end of function
function call_procedure($con, $procedure_name)
{
  $sql = "call " . $procedure_name . ";";
  $result = mysqli_query($con, $sql) or die('Error: ' . mysqli_error($con));
  if ($result) {
    echo "<script>alert('$procedure_name 프로시저가 정상적으로 작동되었습니다.');</script>";
  } else {
    echo "프로시저 작동 중 실패원인" . mysqli_error($con);
  }
}
