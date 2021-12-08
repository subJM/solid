<?php
    session_start();
    include ("../db/db_connector.php");

    $userid = $_SESSION['user_id'];
    $userlevel = $_SESSION['user_level'];

    $num = $_GET['num'];
    $id = $_GET['id'];
    $parent = $_GET['parent'];

    if($userid === $id | $userlevel === 1){
    $sql = "delete from question_ripple where num='$num';";
    $delete_result = mysqli_query($con, $sql);
    }
    if($delete_result){
        mysqli_close($con);
        header("location: question_view.php?num={$parent}&success=댓글 삭제 성공했습니다!");
        alert_back("댓글이 삭제되었습니다.");
        exit();
    }else{
        mysqli_close($con);
        header("location: question_view.php?num={$parent}&error=댓글 삭제 실패했습니다.");
        alert_back("댓글이 삭제되지 않았습니다.");
        exit();
    }
?>