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
			<h3>
				공지사항
			</h3>
			<?php

			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";

			create_table($con, 'notice');

			$sql = "select * from notice where num=";
			$result = mysqli_query($con, $sql);

			$row = mysqli_query($con, $sql);
			$num      = $row["num"];
			$id      = $row["id"];
			$name      = $row["name"];
			$regist_day = $row["regist_day"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$file_name    = $row["file_name"];
			$file_type    = $row["file_type"];
			$file_copied  = $row["file_copied"];
			$hit          = $row["hit"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;

			mysqli_query($con, $sql);
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
				<li>
					<?php
					if ($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/" . $real_name;
						$file_size = filesize($file_path); //php 함수

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='notice_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}
					?>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='notice_list.php'">목록</button></li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='notice_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button>
					<?php
					} else {
					?>
						<button onclick="location.href='notice_modify_form.php'">수정</button>
					<?php
					}
					?>
				</li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='dmi_notice.php?num=<?= $num ?>&page=<?= $page ?>&mode=delete'">삭제</button>
					<?php
					} else {
					?>
						<button delete onclick="location.href='notice_list.php'">삭제</button>
					<?php
					}
					?>
				</li>
				<li>
					<?php
					if ($userid === "admin") {
					?>
						<button onclick="location.href='notice_form.php'">글쓰기</button>
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