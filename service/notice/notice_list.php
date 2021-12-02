<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/FTXcss/FTXmain.css">
	<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/FTXcss/FTXfooter.css">
	<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/FTXcss/FTXheader.css?231">
	<link rel="stylesheet" type="text/css" href="./css/notice.css">
</head>

<body>
	<div class="container">
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php";?>
	</header>
	<section>
		<div id="board_box">
			<br><br><br>
			<h3>공지사항</h3>
			<hr>
			<ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<!-- <span class="col6">조회</span> -->
				</li>
					<?php
for ($i = 0; $i < 10; $i++) {?>
				<li>
						<span class="col1">1</span>
						<span class="col2_1"><a href="notice_view.php?num=6&page=1">코로나바이러스감염증-19 대응 집단시설.다중이용시설 소독 안내(제3-4판)</a></span>
						<span class="col3">관리자</span>
						<span class="col4"> </span>
						<span class="col5">2020-08-19 (15:03)</span>
						<!-- <span class="col6">11</span> -->
					</li>
					<?php }?>
			</ul>

			<ul id="page_num">
				<li>&nbsp;</li>
				<li><b> 1 </b></li>
				<li>&nbsp;</li>
			</ul> <!-- page -->
			<ul class="buttons">
				<li><button onclick="location.href='notice_form.php'">글쓰기</button></li>
				<li><button onclick="location.href='notice_list.php'">목록</button></li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php";?>
	</footer>
	</div>
</body>

</html>