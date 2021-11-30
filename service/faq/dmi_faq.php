<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";

create_table($con, 'faq');

if (isset($_GET["mode"]) && $_GET["mode"] === "insert") {
    $userid = $_GET["id"];
    $username = $_GET["name"];

    if (!$userid) {
        echo ("
      <script>
      alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
      history.go(-1)
      </script>    
      ");
        exit;
    }
    
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // $subject = htmlspecialchars($subject, ENT_QUOTES);
    // $content = htmlspecialchars($content, ENT_QUOTES);
    $subject = test_input($subject);
    $content = test_input($content);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $sql = "insert into faq (id, name, subject, content, regist_day) ";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day' )";
    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);                // DB 연결 끊기

    echo "
	   <script>
	    location.href = 'faq_list.php';
	   </script>
	";
} else if (isset($_GET["mode"]) && $_GET["mode"] === "modify") {
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $sql = "update faq set subject='$subject', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);
    
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'faq_list.php?page=$page';
	      </script>
      ";
} else if (isset($_GET["mode"]) && $_GET["mode"] === "delete") {
    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $sql = "select * from faq where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $sql = "delete from faq where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'faq_list.php?page=$page';
	     </script>
	   ";
}
