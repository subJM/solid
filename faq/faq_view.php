<?php
	session_start();
	include ("../db/db_connector.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXfooter.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXheader.css">
	<link rel="stylesheet" type="text/css" href="./css/faq.css?.asdasd">
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
	</header>
	<?php
         if (!$userid) {
            alert_back("회원가입사용자만 입력가능합니다.");
            exit(); 
         }
    ?>
	<section>
		<div id="board_box">
			<h3>
				자주 묻는 질문 > 내용
			</h3>
			<!-- 에러메세지 출력 -->
			<?php if(isset($_GET['error'])){ ?>
			<div id="check" style="color: red">
				<?= $_GET['error']; ?>
            </div>
            <?php } ?>
            <!--성공메세지 출력 -->
            <?php if(isset($_GET['success'])){ ?>
            <div id="check" style="color: blue">
				<?= $_GET['success']; ?>
            </div>
            <?php } ?>
			<?php
			//1. 클라이언트로부터 전송해온 값이 존재하는지 점검
			if(isset($_GET["num"])){

				//2. mysqli injection 함수 사용
				$num = mysqli_real_escape_string($con, $_GET["num"]);				
				
				//3. 공백이 있는지 점검
				if(empty($num)){
					header("location: faq_list.php?error=번호가 비어있어요");
					exit(); 
				}else{
					//해당되는 공지사항 내용 가져오기
					$sql = "select * from faq where num = '$num'";
					$select_result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($select_result);

					if(!$row){
						header("location: faq_list.php?error=해당되는 공지글을 찾을수 없습니다.");
						exit(); 
					}else{
						$id = $row["id"];
						$name = $row["name"];
						$regist_day = $row["regist_day"];
						$subject = $row["subject"];
						$content = $row["content"];
						$content = str_replace(" ", "&nbsp;", $content);
						$content = str_replace("\n", "<br>", $content);
						$hit = $row["hit"];
					}

					//다른회원이 내 공지사항을 클릭했을 경우 hit 1을 증가
					if($userid !== $id){
						$new_hit = $hit + 1;
						$sql = "update faq set hit = {$new_hit} where num = {$num} ";
						mysqli_query($con, $sql);
					}
					mysqli_close($con);

				}
			}else{
				mysqli_close($con);
				header("location: faq_list.php?error=번호 오류발생!");
				exit(); 
			}	
			?>

			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :<b><?= $subject ?></span>
					<span class="col1"><?= $name ?><?= $regist_day ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<?php 
					$writer = $row["id"];
					//회원인데 내 글이 아닌경우, 회원등록하지 않는경우
					if($userid !== $writer || !$userid){
				?>	
					<li><button type="button" onclick="location.href='faq_list.php'">목록</button></li>
				<?php
					}else{
				?>
					<li><button type="button" onclick="location.href='faq_list.php?page=1'">목록</button></li>
					<li><button type="button" onclick="location.href='faq_modify_form.php?num=<?= $num ?> &userid=<?= $id ?>'">수정</button></li>
					<li><button type="button" onclick="location.href='faq_delete.php?num=<?= $num ?>&page=1'">삭제</button></li>
					<li><button type="button" onclick="location.href='faq_form.php'">글쓰기</button></li>
				<?php
					}
					?>
					</ul>
				<ul>
			<li>
				<span class="col1">댓글 : <?= $id ?><br></span>
				<span class="col2">
				<textarea name="content" style="width:1000px; height:100px; resize: none;"></textarea>
				</span>
				<span>
					<button class="rebutton" type="button" onclick="location.href='faq_view.php'">등록</button>
				</span>
			</li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>