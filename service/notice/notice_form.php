<?php
include("./notice_insert.php");
?>

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
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
	</header>
	<section>
		<div id="board_box">
			<h3 id="board_title">
				공지사항 > 글 쓰기
			</h3>
			<ul id="board_form">
				<form name="notice_form" id="notice_form_id" method="POST">
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input autocomplete="off" id="subject_id" name="subject" type="text"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea id="content_id" name="content"></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일</span>
						<span class="col2"><input type="file" id="file_id" name="upfile"></span>
					</li>
			</ul>
			<ul class="buttons">
				<li><input type="button" onclick="notice()">등록</input></li>
				<li><button type="button" onclick="location.href='notice_list.php'">목록</button></li>
			</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
	<?php
	if ($con === "") {
	?>
		<input type="text" name="subject" class="form_control" placeholder="제목입력">
		<br>
		<p id="input_subject_confirm"></p>
		<input type="text" name="content" class="form_control" placeholder="내용입력">
		<br>
		<p id="input_content_confirm"></p>
		<input type="file" name="upfile" class="form_control" placeholder="파일첨부">
		<br>
		<p id="input_file_confirm"></p>
	<?php
		} else {
			?>
	<?php
	}
	?>
</body>

</html>