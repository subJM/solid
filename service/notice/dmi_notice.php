<?php

include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";

create_table($con, 'notice');

if (isset($_GET["mode"]) && $_GET["mode"] === "insert") {
    $id = $_GET["id"];
    $name = $_GET["name"];

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

    $upload_dir = "./data/";

    $upfile_name     = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 임시파일명
    $upfile_type     = $_FILES["upfile"]["type"];
    $upfile_size     = $_FILES["upfile"]["size"];  // 안되면 php init 에서 최대 크기 수정!
    $upfile_error    = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error) { // 업로드가 잘되었는지 판단
        $file = explode(".", $upfile_name); // trim과 같다. (memo.sql)
        $file_name = $file[0]; //(memo)
        $file_ext  = $file[1]; //(sql)

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;
        $copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
        $uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql 다 합친것

        if ($upfile_size  > 1000000) {
            echo ("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
			");
            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) { // 파일복사, 붙여넣기를 프로그램으로 구현
            echo ("
				<script>
				alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
				history.go(-1)
				</script>
			");
            exit;
        }
    } else {
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }

    $sql = "insert into notice (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);                // DB 연결 끊기

    echo "
	   <script>
	    location.href = 'notice_list.php';
	   </script>
	";
} else if (isset($_GET["mode"]) && $_GET["mode"] === "modify") {
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    if (isset($_FILES["upfile"])) {
        $upload_dir = "./data/";

        $upfile_name     = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 임시파일명
        $upfile_type     = $_FILES["upfile"]["type"];
        $upfile_size     = $_FILES["upfile"]["size"];  // 안되면 php init 에서 최대 크기 수정!
        $upfile_error    = $_FILES["upfile"]["error"];

        if ($upfile_name && !$upfile_error) { // 업로드가 잘되었는지 판단
            $file = explode(".", $upfile_name); // trim과 같다. (memo.sql)
            $file_name = $file[0]; //(memo)
            $file_ext  = $file[1]; //(sql)

            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name . "_" . $file_name;
            $copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
            $uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql 다 합친것

            if ($upfile_size  > 1000000) {
                echo ("
                    <script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                    </script>
                ");
                exit;
            }

            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) { // 파일복사, 붙여넣기를 프로그램으로 구현
                echo ("
                    <script>
                    alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    history.go(-1)
                    </script>
                ");
                exit;
            }
            $sql = "update notice set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
            $sql .= " where num=$num";
            mysqli_query($con, $sql);
        } else {
            $sql = "select * from notice where num = $num";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $copied_name = $row["file_copied"];

            if ($copied_name) {
                $file_path = "./data/" . $copied_name;
                unlink($file_path);
            }

            $upfile_name      = "";
            $upfile_type      = "";
            $copied_file_name = "";

            $sql = "update notice set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
            $sql .= " where num=$num";
            mysqli_query($con, $sql);
        }
    } else {
        $sql = "update notice set subject='$subject', content='$content' ";
        $sql .= " where num=$num";
        mysqli_query($con, $sql);
    }

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'notice_list.php?page=$page';
	      </script>
      ";
} else if (isset($_GET["mode"]) && $_GET["mode"] === "delete") {
    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $sql = "select * from notice where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

    if ($copied_name) {
        $file_path = "./data/" . $copied_name;
        unlink($file_path);
    }

    $sql = "delete from notice where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'notice_list.php?page=$page';
	     </script>
	   ";
}
