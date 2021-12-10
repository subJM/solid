<?php
function create_trigger($con, $trigger_name) {
  $flag = "NO";
  $sql = "SHOW TRIGGERs where `trigger` = '$trigger_name';";
  $result = mysqli_query($con, $sql) or die('Error: ' . mysqli_error($con));

  if (mysqli_num_rows($result) > 0) {
    $flag = "OK";
  }

  if ($flag === "NO") {
    switch ($trigger_name) {
      case 'deleted_members':
        $sql = "
          CREATE trigger deleted_members
          after delete
          on members
          for each row
          begin
          insert into deleted_members values (old.num, old.id, old.password, old.name, old.phone, 
          old.email, old.regist_day, old.level, curdate() );
          END ";
        break;
      default:
        echo "<script>alert('해당트리거명이 없습니다. 점검요망!');</script>";
        break;
    } //end of switch
    if (mysqli_query($con, $sql)) {
      echo "<script>alert('{$trigger_name}트리거가 생성되었습니다.');</script>";
    } else {
      echo "트리거 생성 중 실패원인" . mysqli_error($con);
    }
  } //end of if flag
}//end of function
?>