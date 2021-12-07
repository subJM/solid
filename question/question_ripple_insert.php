<?php
    session_start();
    include ("../db/db_connector.php");

    //2. 세션이 등록되지 않았다면 다시 돌려보낸다.
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])){
        alert_back("회원만 사용 가능합니다.");
        exit;
    }else {
        $userid = $_SESSION['user_id'];
        $username = $_SESSION['user_name'];
    }
    $rip_num = $_GET['num'];
    alert_back(isset($_POST['rip_content']));
    // echo "세션 등록 성공 <br>" ; 
    //2. 클라이언트로부터 전송해온 값이 존재하는지 점검
    if(isset($_POST['rip_content'])){
        //3. mysqli injection 함수 사용(방어)
        $rip_content = mysqli_real_escape_string($con, $_POST['rip_content']);
        
        //4. 공백이 있는지 점검
        if(empty($rip_content)){
            header("location: question_view.php?num={$rip_num}");
            exit;
        }else{
            // echo "아이디확인2 <br>" ;
            //5. 삽입하기전에 해당아이디가 있는지 점검
            $sql = "select * from members where id = '$userid'";
            // echo " '$userid'" ;
            $select_result = mysqli_query($con, $sql);

            if(mysqli_num_rows($select_result) === 0){
                // echo "아이디확인1 <br>" ;
                header("location: question_view.php?error=아이디가 없습니다!");
                exit;
            }else{
                // echo "아이디확인 <br>" ;
                $regist_day = date("Y-m-d (H:i)");//현재의 '년-월-일-시-분' 저장
               
                $sql = "insert into question_ripple (parent, id, name, content, regist_day)";
                $sql .= " values($rip_num,'$userid', '$username', '$rip_content' , '$regist_day')";
                
                $insert_result = mysqli_query($con, $sql);

                if(!$insert_result){
                    // echo "insert 등록 실패 <br>" ;
                    mysqli_close($con);
                    header("location: question_view.php?error=댓글등록에 실패했습니다!");
                    exit();
                }else{
                    // echo "insert 등록 성공 <br>" ;
                    mysqli_close($con);
                    header("location: question_view.php?success=댓글등록에 성공했습니다!");
                    exit();
                }

            }
        }
    }else {
        // echo "오류 발생 <br>" ;
        mysqli_close($con);
        header("location: question_list.php?error=댓글오류 발생");
        exit;
    }
?>
