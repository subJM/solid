<?php
    // print_r($_POST);
    session_start();
    include ("../db/db_connector.php");

    //2. 세션이 등록되지 않았다면 다시 돌려보낸다.
    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["user_name"])){
        alert_back("회원만 사용 가능합니다.");
        exit;
    }else {
        $userid = $_SESSION["user_id"];
        $username = $_SESSION["user_name"];
    }
    // echo "세션 등록 성공 <br>" ; 
    //2. 클라이언트로부터 전송해온 값이 존재하는지 점검
    if(isset($_POST["subject"]) && isset($_POST["content"])){
        //3. mysqli injection 함수 사용(방어)
        $subject = mysqli_real_escape_string($con, $_POST["subject"]);
        $content = mysqli_real_escape_string($con, $_POST["content"]);

        //4. 공백이 있는지 점검
        if(empty($subject)){
            header("location: faq_form.php?error=제목을 입력해주세요!");
            exit;
        }else if(empty($content)){
            header("location: faq_form.php?error=내용을 입력해주세요!");
            exit;
        }else{
            // echo "아이디확인2 <br>" ;
            //5. 삽입하기전에 해당아이디가 있는지 점검
            $sql = "select * from members where id = '$userid'";
            // echo " '$userid'" ;
            $select_result = mysqli_query($con, $sql);

            if(mysqli_num_rows($select_result) === 0){
                // echo "아이디확인1 <br>" ;
                header("location: faq_form.php?error=아이디가 없습니다!");
                exit;
            }else{
                // echo "아이디확인 <br>" ;
                $regist_day = date("Y-m-d (H:i)");//현재의 '년-월-일-시-분' 저장
        
                $sql = "insert into faq (id, name, subject, content, regist_day, hit)";
                $sql .= " values('$userid', '$username', '$_POST[subject]', '$_POST[content]', '$regist_day', 0 )";
                
                $insert_result = mysqli_query($con, $sql);


                if(!$insert_result){
                    // echo "insert 등록 실패 <br>" ;
                    mysqli_close($con);
                    header("location: faq_form.php?error=글등록에 실패했습니다!");
                    exit();
                }else{
                    // echo "insert 등록 성공 <br>" ;
                    mysqli_close($con);
                    header("location: faq_list.php?success=글등록에 성공했습니다!");
                    exit();
                }

            }
        }
    }else {
        // echo "오류 발생 <br>" ;
        mysqli_close($con);
        header("location: faq_form.php?error=알수없는 오류발생");
        exit;
    }
?>
