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
	<br><br><br>
		<div id="board_box">
			<h3 class="title">
				문의게시판
			</h3>
			<?php
			// $num  = $_GET["num"];
			// $page  = $_GET["page"];

			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
			include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";
			include $_SERVER['DOCUMENT_ROOT'] . "/solid/service/question/question_func.php";

			create_table($con, 'question');
			create_table($con, 'question_ripple');
			// $con = mysqli_connect("localhost", "user1", "12345", "sample");

			$sql = "select * from question where num=$";
			$result = mysqli_query($con, $sql);

			$row = mysqli_query($con, $sql);
			$id      = $row["id"];
			$name      = $row["name"];
			$regist_day = $row["regist_day"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$file_name    = $row["file_name_0"];
			$file_type    = $row["file_type_0"];
			$file_copied  = $row["file_copied_0"];
			$hit          = $row["hit"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$type = explode("/", $file_type);
			//숫자 0 " " '0' null 0.0   $a = array()
			if (!empty($file_copied) && $type[0] == "image") {
				//이미지 정보를 가져오기 위한 함수 width, height, type
				$image_info = getimagesize("./data/" . $file_copied);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
				$image_type = $image_info[2];
				if ($image_width > 400) $image_width = 400;
			} else {
				$image_width = 0;
				$image_height = 0;
				$image_type = "";
			}

			$new_hit = $hit + 1;
			$sql = "update question set hit=$new_hit where num=$";
			mysqli_query($con, $sql);

			?>
			<ul id="view_content">
				<li>
					<span class="col1">
						제목 : 코인문의
					</span>
				</li>
				<li>
					<span>코인 거래가 안되는데요?
					</span>
				</li>
				<li>
					<?php
					if ($type[0] == "image") {
						echo "<img src='./data/$file_copied' width='$image_width'><br>";
					} elseif (!empty($_SESSION['user_id']) && !empty($file_copied)) {
						$real_name = $file_copied;
						$file_path = "./data/" . $real_name;
						$file_size = filesize($file_path);
						//2. 업로드된 이름을 보여주고 [저장] 할것인지 선택한다.
						echo "
                        ▷ 첨부파일 : $file_name &nbsp; [ $file_size Byte ]
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href='question_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}
					?>
					<?= $content ?>
				</li>
			</ul>
			<ul id="ripple">
			<li style="font-weight: bold;">댓글</li>
			<?php
				$sql = "select * from question_ripple where parent='' ";
				$ripple_result = mysqli_query($con, $sql);
				while ($ripple_row = mysqli_fetch_array($ripple_result)) {
					$ripple_num = $ripple_row['num'];
					$ripple_id = $ripple_row['id'];
					$ripple_name = $ripple_row['name'];
					$ripple_date = $ripple_row['regist_day'];
					$ripple_content = $ripple_row['content'];
					$ripple_content = str_replace("\n", "<br>", $ripple_content);
					$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
					?>
				<li id="ripple_head"><span id="span1"><?= $ripple_id ?></span><span id="span2"><?= $ripple_date ?></span></li>
				<li id="mdi_del">
					<?php
						$message = question_ripple_delete($ripple_id, $ripple_num, 'dmi_question.php', $page, $hit, $num);
						echo $message;
						?>
					</li>
					<li id="ripple_content">
						<?= $ripple_content ?>
					</li>
					<?php
				} //end of while
				mysqli_close($con);
				?>
				<form name="ripple_form" action="dmi_question.php?mode=insert_ripple" method="post">
					<input type="hidden" name="parent" value="<?= $num ?>">
					<input type="hidden" name="hit" value="<?= $hit ?>">
					<input type="hidden" name="page" value="<?= $page ?>">
					<div id="ripple_insert">
						<div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
					</div>
					<!--end of ripple_insert -->
				</form>
			</ul>
			<ul class="buttons">
				<li><button id="buttons" onclick="'question_view.php'">등록</button></li>
				<li><button onclick="location.href='question_list.php?page=<?= $page ?>'">목록</button></li>
				<li>
					<?php
					if ($userid === "admin"|| $userid === $id) {
						?>
						<button onclick="location.href='question_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button>
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
					if ($userid === "admin"|| $userid === $id) {
						?>
						<button onclick="location.href='dmi_question.php?num=<?= $num ?>&page=<?= $page ?>&mode=delete'">삭제</button>
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
					if(isset($_SESSION['user_id'])){ 
					?>
						<button onclick="location.href='question_form.php'">글쓰기</button>
					<?php
					} else {
					?>
					<button style="display: none;">글쓰기</button>
					<?php 
					}
					?>
				</li>
			<!-- <li><button onclick="location.href='question_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button></li>
			<li><button onclick="location.href='dmi_question.php?num=<?= $num ?>&page=<?= $page ?>&mode=delete'">삭제</button></li>
			<li><button onclick="location.href='question_form.php'">글쓰기</button></li> -->
		</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>