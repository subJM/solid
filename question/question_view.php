<?php
	session_start();
	include ("../db/db_connector.php");
	$userid = $_SESSION['user_id'];

	//1. 클라이언트로부터 전송해온 값이 존재하는지 점검
	if(isset($_GET['num'])){

		$num = $_GET['num'];				
			//해당되는 공지사항 내용 가져오기
			$sql = "select * from question where num = '$num'";
			$select_result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($select_result);

			if(!$row){
				header("location: question_list.php?error=해당되는 공지글을 찾을수 없습니다.");
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
				$sql = "update question set hit = {$new_hit} where num = {$num} ";
				mysqli_query($con, $sql);
			

		}
	}else{
		header("location: question_list.php?error=번호 오류발생!!!!");
		exit(); 
	}
	// 댓글 등록

	$sql_rip = "select * from question_ripple where parent = $num;";
	$result = mysqli_query($con, $sql_rip);
	$rip_row = array();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Solid</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css">
	<link rel="stylesheet" type="text/css" href="./css/question.css?.sss">
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
				문의게시판 > 내용
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
			

			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :<b><?= $subject ?></span>
					<span class="col2"><?= $name ?><?= $regist_day ?></span>
				</li>
				<li class="li_content">
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<?php 
					$writer = $row["id"];
					//회원인데 내 글이 아닌경우, 회원등록하지 않는경우
					if($userid !== $writer || !$userid){
				?>	
					<li><button type="button" onclick="location.href='question_list.php'">목록</button></li>
				<?php
					}else{
				?>
					<li><button type="button" onclick="location.href='question_list.php?page=1'">목록</button></li>
					<li><button type="button" onclick="location.href='question_modify_form.php?num=<?= $num ?> &userid=<?= $id ?>'">수정</button></li>
					<li><button class="delete_button" type="button" onclick="location.href='question_delete.php?num=<?= $num ?>&page=1'">삭제</button></li>
					<li><button type="button" onclick="location.href='question_form.php'">글쓰기</button></li>
				<?php
					}
				?>
			</ul>
			
			<ul id="ripple_view">
				<?php for($i=0; $rip_row[$i]= mysqli_fetch_assoc($result) ; $i++){ ?>
					<li>
						<span class="col1"><?= $rip_row[$i]['name'] ?> &nbsp; (<?= $rip_row[$i]['id'] ?>) &nbsp; <?= $rip_row[$i]['regist_day'] ?> </span>
						<span class="col2"> &nbsp; <?= $rip_row[$i]['content'] ?> </span>
					</li>
					<button class="de_button"type="button" onclick="location.href='question_ripple_delete.php?num=<?= $rip_row[$i]['num'] ?>&id=<?= $rip_row[$i]['id'] ?>&parent=<?=$num?>'">삭제</button>
				<?php } ?>
			</ul>
			<ul id="board_ripple">
				<li>
					<span class="col12">댓글작성 <?=$username ?> :&nbsp;(<?= $userid ?>)</span>
				</li>
				<form name="board_ripple" method="post" action="question_ripple_insert.php?num=<?=$num?>" enctype="multipart/form-data">
					<li>
						<span class="col2">
							<textarea class="rip_content" name="rip_content" placeholder="이곳에 댓글을 작성해주세요." require></textarea>
						</span>
						<span>
							<button class="re_button" type="submit" >등록</button>
						</span>
					</li>
				</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>