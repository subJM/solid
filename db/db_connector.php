<?php
    //1. 데이터베이스 시간 설정을 해준다.
    date_default_timezone_set("Asia/Seoul");
    
    //2. 데이터베이스 접속 및 오류처리(데이터베이스 생성기능부여)
    $servername = "localhost";
    $username = "root";
    $userpassword = "123456";

    
    $con = mysqli_connect($servername, $username, $userpassword);
    if(!$con){
        die("connect failed".mysqli_connect_error());
    }
    
    //3. 데이터베이스 확인하기
    $database_flag = false;
    $sql = "show databases";
    $result = mysqli_query($con, $sql) or die("Error".mysqli_error($con));
    while($row = mysqli_fetch_array($result)){
        if($row["Database"] == "solid"){
            $database_flag = true;
            break;
        }
    }

    //4. 데이터베이스 없으면 만들기
    if($database_flag === false){
        $sql = "create database solid";
        $value = mysqli_query($con, $sql) or die("Error".mysqli_error($con));
        if($value === true){
            echo "
            <script>
            alert('solid DB가 생성되었습니다.');
            </script>
            ";
        }
    }

    //5. 데이터베이스 접속하기($con -> 데이터베이스 연결함.)
    $dbcon = mysqli_select_db($con, "solid") or die("Error".mysqli_error($con));
    if(!$dbcon){
        echo "
        <script>
        alert('solid DB가 생성되었습니다.');
        </script>
        ";
    }

    //경고 메시지
    function alert_back($message){
        echo "
		<script>
        alert('$message');
        history.go(-1)
		</script>
        ";
        exit;
    }   

    //특수문자 변경하기
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);   
        return $data;     
    }
    //페이지 처리함수
    function get_paging($write_pages, $cur_page, $total_page, $url){
    //memo_login&page123 => memo_login&page= 변환시켜달라 
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    //1. 현재페이지가 1페이지가 아니고 2페이지 이상이라면 처음가기를 등록한다.  
    if ($cur_page > 1) {
        $str .= '<a href="'.$url.'1" class="pg_page pg_start">처음</a>'.PHP_EOL;
    }

    //2 시작페이지와 끝페이지를 등록한다.(현재12page 시작페이지: 11 ~ 끝페이지 20) 
	// 끝페이지가 중요함.(총 56페이지일때 현재52페이지 시작페이지: 51 ~ 끝페이지 60)
	// 끝페이지 >= 총페이지보다 크거나 같으면 끝페이지 = 총페이지 시작: 51 ~ 끝페이지 56)
    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;
    if ($end_page >= $total_page) $end_page = $total_page;//마지막페이지에 해당된다.

    //3 시작페이지가 2페이지 이상이면 [이전]  시작페이지 -1
	//[처음][이전][11]스트롱[12]스트롱[13]...[19][20] => [처음][이전][1][2][3]...[9]스트롱[10]스트롱
    if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).'" class="pg_page pg_prev">이전</a>'.PHP_EOL;

    //4 전체페이지가 2이상 이고 시작페이지 11페이지 끝페이지 20페이지면 현재페이지 12페이지
	//[처음][이전][11]스트롱[12]스트롱[13]...[19][20]
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<a href="'.$url.$k.'" class="pg_page">'.$k.'</a>'.PHP_EOL;
            else
                $str .= '<strong class="pg_current">'.$k.'</strong>'.PHP_EOL;
        }
    }

    //5 전체페이지 56 > 20페이지라면 [다음]
	//[처음][이전][11]스트롱[12]스트롱[13]...[19][20][다음] => [처음][이전]스트롱[21]스트롱[22][23]...[29][30]
    if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).'" class="pg_page pg_next">다음</a>'.PHP_EOL;

    //6 현재페이지가 전체페이지보다 작다면 [처음][이전][11]스트롱[12]스트롱[13]...[19][20][다음][끝]
    if ($cur_page < $total_page) {
        $str .= '<a href="'.$url.$total_page.'" class="pg_page pg_end">맨끝</a>'.PHP_EOL;
    }

    //7 $str 페이징 문자열이 만들어 졌다면 생성
    if ($str)
        return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
    else
        return "";
}
?>