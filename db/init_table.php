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
            case 'purchase' : 
                $sql = "insert into `purchase` values (null, '2019-08-20 11:11:23', 'ilhase', '0', '무료 체험', 0, '0', '-'),
                (null, '2019-09-20 11:11:23', 'chamchi', '5', '포인트 구매', 8, '1000', '카카오페이'),
                (null, '2019-09-20 00:11:23', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-09-20 11:31:23', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-12-20 11:19:23', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-09-20 11:02:23', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-09-20 11:11:23', 'allan54', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-11-20 08:11:53', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-11-20 11:11:23', 'chamchi', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-11-20 12:11:23', 'mac123', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-09-20 11:11:25', 'mac123', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-09-20 00:11:23', 'solid', '5', '포인트 구매 ', 8,  '1000', '카카오페이'),
                (null, '2019-12-20 11:15:53', 'solid', '5', '포인트 구매 ', 8,  '1000', '카카오페이')";
                break;
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