<?php
    include $_SERVER['DOCUMENT_ROOT']."/solid/db/create_table.php";
    include $_SERVER['DOCUMENT_ROOT']."/solid/db/db_connector.php";

    function notice($con){
    if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["subject"]) && isset($_POST["content"])) {
        $id = mysqli_real_escape_string($con, $_POST["id"]);
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $subject = mysqli_real_escape_string($con, $_POST["subject"]);
        $content = mysqli_real_escape_string($con, $_POST["content"]);

        if (empty($id)) {
            //있으면 돌려보내기
            header("location: member_form.php?error=아이디가 비어있음.");
            exit();
        }else if (empty($name)) {
            //있으면 돌려보내기
            header("location: notice_form.php?error=이름이 비어있음.");
            exit();
        }else if (empty($subject)) {
            //있으면 돌려보내기
            header("location: notice_form.php?error=제목이 비어있음.");
            exit();
        }else if (empty($content)) {
            //있으면 돌려보내기
            header("location: notice_form.php?error=내용 비어있음.");
            exit();
        }else {
            $sql = "SELECT * FROM notice WHERE ID = '$id'";
            $row = mysqli_query($con, $sql);

            //아이디가 있다면
            if (mysqli_num_rows($row) > 0) {
                header("location: notice_form.php?error=중복된 아이디입니다.");
                exit();
            }else {
                //중복된 아이디가 아니라면 삽입
                $id = $id;
            
                $sql = "insert into notice(id, name, subject, content) ";
                $sql .= "values('$id', '$name', '$subject', '$content')";
            
                $insert_result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
                mysqli_close($con);

                if ($insert_result) {
                    header("location:http://{$_SERVER['HTTP_HOST']}/solid/index.php");
                    exit();
                }else {
                    header("location: notice_form.php?error=가입이 실패 되었습니다.");
                    exit();
                }
            }
            mysqli_close($con);
        }
    }else{
        mysqli_close($con);
        header("location: notice_form.php?error=알수없는 오류발생");
        exit();
    }
}
    
?>