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
        echo ("
		<script>
        alert('$message');
        history.go(-1)
		</script>
        ");
        exit;
    }   

    //특수문자 변경하기
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);   
        return $data;     
    }
?>