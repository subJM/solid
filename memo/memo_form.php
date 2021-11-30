<?php
include("./dbconn.php");  // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.

$me_recv_mb_id = $_GET['me_recv_mb_id']; // GET 방식으로 넘어온 받는 회원아이디
?>

<html>
<head>
	<title>Memo Form</title>
	<link href="./style.css" rel="stylesheet" type="text/css">
</head>
<body id="memo">
	<!-- 쪽지 보내기 시작 { -->
	<div>
		<h1>쪽지 보내기</h1>

		<ul>
			<li><a href="./memo.php?kind=recv">받은쪽지</a></li>
			<li><a href="./memo.php?kind=send">보낸쪽지</a></li>
			<li><a href="./memo_form.php">쪽지쓰기</a></li>
		</ul>

		<form name="fmemoform" action="./memo_form_update.php" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
		<div>
			<table>
			<tbody>
			<tr>
				<th>받는 회원아이디</th>
				<td>
					<input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required class="frm_input required" size="47"></br>
					<span>※ 여러 회원에게 보낼때는 콤마(,)로 구분하세요.</span>
				</td>
			</tr>
			<tr>
				<th>내용</th>
				<td><textarea name="me_memo" rows="10" cols="50" required></textarea></td>
			</tr>
			</tbody>
			</table>
		</div>

		<div class="win_btn">
			<input type="submit" value="보내기">
			<button type="button" onclick="window.close();">창닫기</button>
		</div>
		</form>
	</div>
	<!-- 쪽지 보내기 끝 { -->
</body>
</html>