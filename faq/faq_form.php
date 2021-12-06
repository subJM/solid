<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXfooter.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXheader.css">
	<link rel="stylesheet" type="text/css" href="./css/faq.css">
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/solid/faq/js/notice.js"></script>
	<script>
		function faq_input() {
			console.log("눌림");
			if (!document.board_form.subject.value) {
				alert("제목을 입력하세요!");
				document.board_form.subject.focus();
				return;
			}
			if (!document.board_form.content.value) {
				alert("내용을 입력하세요!");
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
		}
	</script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
	</header>
	<?php
	if (!$userid) {
		alert_back("회원가입 후 이용하세요.");
		exit;
	}
	?>
	<section>
		<div id="board_box">
			<h3 id="board_title">
				자주 묻는 질문 > 게시물 작성
			</h3>

			<form name="board_form" method="post" action="faq_insert.php" enctype="multipart/form-data">
				<ul id="board_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $username ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"></textarea>
						</span>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="submit" onclick="faq_input()">등록</button></li>
					<li><button type="button" onclick="location.href='faq_list.php'">목록</button></li>
				</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>