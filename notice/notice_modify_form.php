<?php
	session_start();
	include ("../db/db_connector.php");
?>
<!-- 게시글 수정 -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.3">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.3">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.3">
	<link rel="stylesheet" type="text/css" href="./css/notice.css">
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
	</header>
	<?php
         if (!$userid) {
            alert_back("게시물 작성자만가능합니다.");
            exit(); 
         }
    ?>
	<section>
		<div id="board_box">
			<h3 id="board_title">
				공지사항 > 내용
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
					header("location: notice_list.php?error=번호가 비어있어요");
					exit(); 
				}else{
					//해당되는 공지사항 내용 가져오기
					$sql = "select * from notice where num = '$num'";
					$select_result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($select_result);

					if(!$row){
						header("location: notice_list.php?error=해당되는 공지글을 찾을수 없습니다.");
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
					mysqli_close($con);

				}
			}else{
				mysqli_close($con);
				header("location: notice_list.php?error=수정하기 오류발생!");
				exit(); 
			}	
			// print_r($row);
			?>
			<form name="board_form" method="post" action="notice_update.php?num=<?= $num ?>" enctype="multipart/form-data">
				<ul id="board_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $username ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span>
						<input name="subject" style="resize: none;" value="<?= $subject ?>">
						</span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content" style="resize: none;"><?= $content ?></textarea>
						</span>
					</li>
			</ul>
			<ul class="buttons">
				<?php 
					$writer = $row["id"];
					//회원인데 내 글이 아닌경우, 회원등록하지 않는경우 목록버튼만 출력
					if($userid !== $writer || !$userid){
				?>	
					<li><button type="button" onclick="location.href='notice_list.php'">목록</button></li>
				<?php
					}else{
				?>
					<li><button type="button" onclick="location.href='notice_list.php?page=1'">목록</button></li>
					<li><button type="button" onclick="location.href='notice_delete.php?num=<?= $num ?>'">삭제</button></li>
					<li><button type="submit" >완료</button></li>
				<?php
					}
				?>
			</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>