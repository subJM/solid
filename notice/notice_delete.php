<?php
    session_start();
    include ("../db/db_connector.php");

    $num = $_GET['num'];
    $sql = "delete from notice where num='$num';";
    $delete_result = mysqli_query($con, $sql);

    if($delete_result){
        mysqli_close($con);
        header("location: notice_list.php?success=게시물 삭제 성공했습니다!");
        alert_back("게시물이 삭제되었습니다.");
        exit();
    }else{
        mysqli_close($con);
        header("location: notice_modify_form.php?error=게시물 삭제 실패했습니다.");
        alert_back("게시물이 삭제되지 않았습니다.");
        exit();
    }
?>