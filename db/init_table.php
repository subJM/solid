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
            case 'notice' :
                $sql = "insert into `notice` values (null, 'master', '관리자', '[안내] Solid 피싱 사이트 주의 부탁드립니다.','※ 주의!! 잠시 방심하시는 사이 회원님의 암호화폐가 출금 될 수 있습니다.

                Solid 로그인 시, URL 주소 (https://www.solid.com)를 반드시 확인해주세요.
                Solid 로그인 과정에서는 카카오페이 인증이 필요하지 않습니다. 카카오페이 인증 수신 시, 출금 여부를 반드시 확인해주세요.
                
                안녕하세요. 가장 신뢰받는 글로벌 표준 암호화폐 거래소 Solid 입니다.
                
                구글 검색엔진을 통해 \'solid\', \'Solid\' (혹은 \'djqqlxm\') 검색 시, Solid 피싱 사이트가 일부 노출되고 있습니다.
                이에 대응하기 위해 지속적으로 구글 담당자에게 연락, 신고 작업을 통하여 조치를 하고 있으나, 해당 피싱 사이트에서 지속적으로 URL 주소와 검색 키워드를 변경하여 구글에 광고를 집행하고 있어 피싱 사이트가 계속하여 노출되고 있습니다.
                
                이에 회원님들께서는 구글 등 검색엔진을 통하여 Solid 접속 시, 반드시 Solid URL 주소 (https://www.solid.com)를 확인해주시기 바랍니다.
                
                해당 피싱 사이트는 로그인 외 어떠한 기능도 작동하지 않으며, 카카오 계정 로그인 페이지 역시 피싱 사이트로 만들어져 있습니다.
                해당 사이트에 로그인 정보를 입력하실 경우, Solid 로그인 정보가 유출될 수 있습니다.
                
                Solid 로그인 시, 반드시 Solid URL 주소(https://www.solid.com 혹은 https://solid.com)를 확인해주시길 다시 한 번 당부드리며, 아래 피싱 사이트 확인 방법을 참고하시어 피싱 사이트로 판단되는 경우, 절대 Solid 로그인 정보(카카오계정 이메일, 비밀번호 및 카카오알림톡 인증번호)를 해당 사이트에 입력하지 마시기 바랍니다.
                
                또한, Solid 로그인 과정에서는 카카오페이 인증은 필요하지 않습니다.
                Solid 로그인 도중 카카오페이 인증 요청이 왔을 경우, 반드시 카카오페이 인증 요청 메시지를 확인해주시기 바랍니다.
                회원님께서 원하지 않은 출금 요청일 경우, 절대 카카오페이 인증을 하지 말아주시기 바랍니다.', DATE_FORMAT(now(), '%Y-%m-%d'),0);";
                break;
            case 'recruit_plan' :
                $sql = "insert into `recruit_plan` values (null, '포인트 구매', '1000000', '1000')";
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