<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css">
	<link rel="stylesheet" type="text/css" href="./css/faq.css?.sx">
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/solid/faq/js/notice.js"></script>
	<script>
  function faq_input() {
    console.log("눌림");
    var a = document.board_form.subject.value;
    var b = document.board_form.content.value;
    
    //공백만 입력된 경우
    var blank_pattern = /^\s+|\s+$/g;
    if(a.replace(blank_pattern, '' ) == "" | b.replace(blank_pattern, '' ) == "" ){
      alert('공백만 입력되었습니다.');
      document.board_form.action = "faq_list.php?error=글등록에 실패했습니다!";
      document.board_form.submit();
      exit;
    }

    //특수문자가 있는 경우
    var special_pattern = /[`~!@#$%^&*|\\\'\";:\/?]/gi;
    if(special_pattern.test(a) == true | special_pattern.test(b) == true ){
      alert('특수문자가 입력되었습니다.');
      document.board_form.action = "faq_list.php?error=글등록에 실패했습니다!";
      document.board_form.submit();
      exit;
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
						<span class="col2"><input name="subject" type="text" placeholder="제목을 작성해주세요."></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content" placeholder="내용을 작성해주세요."></textarea>
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