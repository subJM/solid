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

	<section>
		<br><br><br>
		<div id="board_box">
			<h3 class="title">
				자주 묻는 질문
			</h3>
			<?php
			// $num  = $_GET["num"];
			// $page  = $_GET["page"];

			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";

			create_table($con, 'faq');
			// $con = mysqli_connect("localhost", "user1", "12345", "sample");

			$sql = "select * from faq where num=$";
			$result = mysqli_query($con, $sql);

			$row = mysqli_query($con, $sql);
			$id      = $row["id"];
			$name      = $row["name"];
			$regist_day = $row["regist_day"];
			$subject    = $row["subject"];
			$content    = $row["content"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			?>
			<ul id="view_content">
			<li>
					<span class="col1">
						제목 : 코로나바이러스감염증-19 대응 집단시설.다중이용시설 소독 안내(제3-4판)<?= $subject ?>
					</span>
				</li>
				<li>
				<span>
					코로나바이러스감염증-19 대응 집단시설·다중이용시설 소독 안내 (제3-4판)을 올려드리니 업무에 활용하시기 바랍니다.
					* 소독제 관련 세부정보 및 붙임 7. 코로나19 살균·소독제품의 안전한 사용을 위한 세부지침의 최신 개정안 자료는 환경부(화학제품관리과) 초록누리(http://ecolife.me.go.kr) 에서 확인 가능
				</span>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='faq_list.php?page=<?= $page ?>'">목록</button></li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='faq_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button>
					<?php
					} else {
					?>
						<button style="display: none;">수정</button>
					<?php
					}
					?>

				</li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='dmi_faq.php?num=<?= $num ?>&page=<?= $page ?>&mode=delete'">삭제</button>
					<?php
					} else {
					?>
						<button style="display: none;">삭제</button>
					<?php
					}
					?>

				</li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='faq_form.php'">글쓰기</button>
					<?php
					} else {
					?>
						<button style="display: none;">글쓰기</button>
					<?php
					}
					?>
				</li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>