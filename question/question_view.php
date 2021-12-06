<?php
	session_start();
	include ("../db/db_connector.php");
	$userid = $_SESSION['user_id'];

	//1. 클라이언트로부터 전송해온 값이 존재하는지 점검
	if(isset($_GET["num"])){

		//2. mysqli injection 함수 사용
		$num = mysqli_real_escape_string($con, $_GET["num"]);				
		
		//3. 공백이 있는지 점검
		if(empty($num)){
			header("location: question_list.php?error=번호가 비어있어요");
			exit(); 
		}else{
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

		}
	}else{
		header("location: question_list.php?error=번호 오류발생!");
		exit(); 
	}

	$sql_rip = "select * from question_ripple where parent = $id";
	$select_ripple_result = mysqli_query($con, $sql_rip);
			
	$rip_result= mysqli_fetch_assoc($select_ripple_result);

	for($i=0; $i >count($rip_result); $i++){ 
		$rip_subject = $rip_result['parent'];
		$rip_id = $rip_result['id'];
		$rip_name = $rip_result['name'];
		$rip_content = $rip_result['content'];
		$rip_regist_day = $rip_result['regist_day'];
	}
			
	var_dump(isset($rip_result));
	// 'question_ripple':
	// $sql = "CREATE TABLE IF NOT EXISTS `question_ripple` (
	//   `num` int(11) NOT NULL AUTO_INCREMENT,
	//   `parent` int(11) NOT NULL,
	//   `id` char(15) NOT NULL,
	//   `name` char(10) NOT NULL,
	//   `content` text NOT NULL,
	//   `regist_day` char(20) DEFAULT NULL;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Solid</title>
<<<<<<< HEAD
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.3">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.3">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.3">
	<link rel="stylesheet" type="text/css" href="./css/question.css?.as">
=======
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.afkqwesadkkster">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.aqwessadd">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.5ssaassasasa12sdda">
	<link rel="stylesheet" type="text/css" href="./css/question.css">
>>>>>>> 26c0139b64527df8a873218843c1c07b1e438024
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
					<li><button type="button" onclick="location.href='question_delete.php?num=<?= $num ?>&page=1'">삭제</button></li>
					<li><button type="button" onclick="location.href='question_form.php'">글쓰기</button></li>
				<?php
					}
				?>
			</ul>
			
			<ul id="ripple_view">
				<?php if(isset($rip_result)){ ?>
				<li>
					<span class="col1"><?= $rip_name ?><?= $rip_regist_day ?></span>
					<span class="col2"><b>내용 :<b><?= $rip_subject ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
				<?php } ?>
			</ul>
			
			<ul>
				<li><button type="button" onclick="location.href='question_ripple_delete.php?num=<?= $num ?>&page=1'">삭제</button></li>
				<li><button type="button" onclick="location.href='question_ripple_insert.php?num=<?= $id?>'">댓글작성</button></li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
	</footer>
</body>

</html>