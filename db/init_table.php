<?php

function insert_init_data($con, $table_name){
    $is_empty = false; // 테이블이 비어 있는 지 유무
    $sql = "SELECT * from $table_name";
    $result = mysqli_query($con, $sql) or die('select from table error: '.mysqli_error($con));

    $records = mysqli_num_rows($result);

    if(empty($records) ){
      $is_empty = true;
    }

    // 테이블이 비어 있을 경우, 초기값을 넣어줌
    if($is_empty){
        switch($table_name){
            // 모든 테이블에 대한 초기값
            case 'recruit_plan' :
                $sql = "insert into `recruit_plan` values (null, '포인트 구매', '1000000', '1000')";
                break;
            default:
                // 존재하지 않는 테이블명일 때
                // echo "<script>alert('존재하지 않는 테이블명 입니다.');</script>";
                break;
        } // end of switch

        if(mysqli_query($con, $sql)){
        // echo "<script>alert('$table_name 테이블 초기값 셋팅 완료');</script>";
        } else {
        echo $table_name." insert_init_data error ".mysqli_error($con);
        }
    } // end of if table is empty

} // end of function
?>