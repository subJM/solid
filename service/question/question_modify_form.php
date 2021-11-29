<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXfooter.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXheader.css">
	<link rel="stylesheet" type="text/css" href="./css/notice.css">
</head>

<body>
	<header>
		<?php include  $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
	</header>
	<br><br><br>
	<section>
		<div id="board_box">
			<h3 id="board_title">
				문의게시판 > 수정
			</h3>
			<?php
			// $num  = $_GET["num"];
			// $page = $_GET["page"];

			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";

			create_table($con, 'question');
			create_table($con, 'question_ripple');
			// $con = mysqli_connect("localhost", "user1", "12345", "sample");

			$sql = "select * from question where num=$";
			$result = mysqli_query($con, $sql);
			$row = mysqli_query($con, $sql);
			$name       = $row["name"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$read_pw	= $row["read_pw"];
			$file_name  = $row["file_name_0"];
			?>
			<form name="board_form" method="post" action="dmi_question.php?num=<?= $num ?>&page=<?= $page ?>&mode=modify" enctype="multipart/form-data">
				<ul id="board_form">
					<!-- <li>
						<span class="col1">이름 : </span>
						<span class="col2"></span>
					</li> -->
					<li id="read_pw">
						<span class="col1">비밀번호 : </span>
						<span class="col2"><input  autocomplete="off" type="password" name="read_pw"></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input autocomplete="off" name="subject" input  autocomplete="off" type="text" value="<?= $subject ?>"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일</span>
						<span class="col2"><input type="file" name="upfile"></span>
						<span class="col2" onclick="location.href='question_click.php?num=<?= $num ?>&page=<?= $page ?>'" ><?= $file_name ?></span>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" onclick="check_input()">수정하기</button></li>
					<li><button type="button" onclick="location.href='question_list.php'">목록</button></li>
				</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>