<?php
include $_SERVER['DOCUMENT_ROOT']."/solid/db/db_connector.php";  // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.
if(isset($_SESSION["user_id"] )){
	$mb_id = $_SESSION["user_id"];

	$kind = $_GET['kind'] ? $_GET['kind'] : 'recv';

	if ($kind == 'recv') {
		$unkind = 'send';
		$kind_title = '받은';
	} else if ($kind == 'send') {
		$unkind = 'recv';
		$kind_title = '보낸';
	} else {
		echo "<script>alert(''.$kind .'값을 넘겨주세요.');</script>";
		echo "<script>location.replace('./login.php');</script>";
		exit;
	}

	$sql = " SELECT COUNT(*) AS cnt FROM memo WHERE me_{$kind}_mb_id = '{$mb_id}' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$total_count = $row['cnt'];

	$page_rows = 5; // 페이지당 목록 수
	$page = $_GET['page'];

	$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

	$list = array();

	$sql = " SELECT a.*, b.mb_id, b.mb_name, b.mb_email
				FROM memo a
				LEFT JOIN member b ON (a.me_{$unkind}_mb_id = b.mb_id)
				WHERE a.me_{$kind}_mb_id = '{$mb_id}'
				ORDER BY a.me_id DESC LIMIT $from_record, {$page_rows} ";
	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++)
	{
		$list[$i] = $row;

		$mb_id = $row["me_{$unkind}_mb_id"];

		if ($row['me_read_datetime'] == '0000-00-00 00:00:00')
			$read_datetime = '아직 읽지 않음';
		else
			$read_datetime =$row['me_read_datetime'];

		$send_datetime = $row['me_send_datetime'];

		$list[$i]['send_datetime'] = $send_datetime;
		$list[$i]['read_datetime'] = $read_datetime;
		$list[$i]['view_href'] = './memo_view.php?me_id='.$row['me_id'].'&amp;kind='.$kind; // 쪽지 읽기 링크
		$list[$i]['del_href'] = './memo_delete.php?me_id='.$row['me_id'].'&amp;kind='.$kind; // 쪽지 삭제 링크
	}

	$str = ''; // 페이징 시작
	if ($page > 1) {
		$str .= '<a href="./memo.php?kind='.$kind.'&amp;page=1" class="pg_page pg_start">처음</a>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<a href="./memo.php?kind='.$kind.'&amp;page='.($start_page-1).'" class="pg_page pg_prev">이전</a>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<a href="./memo.php?kind='.$kind.'&amp;page='.$k.'" class="pg_page">'.$k.'</a>';
			else
				$str .= '<strong class="pg_current">'.$k.'</strong>';
		}
	}

	if ($total_page > $end_page) $str .= '<a href="./memo.php?kind='.$kind.'&amp;page='.($end_page+1).'" class="pg_page pg_next">다음</a>';

	if ($page < $total_page) {
		$str .= '<a href="./memo.php?kind='.$kind.'&amp;page='.$total_page.'" class="pg_page pg_end">맨끝</a>';
	}

	if ($str) // 페이지가 있다면 생성
		$write_page = "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
	else
		$write_page = "";

	mysqli_close($conn); // 데이터베이스 접속 종료
}else{
	alert_back("잘못된 접근입니다.");
	
}


?>

<html>
<head>
	<title>Memo</title>
	<link href="./css/style.css" rel="stylesheet" type="text/css">
</head>
<body id="memo">
	<!-- 쪽지 목록 시작 { -->
	<div>
		<h1>내 쪽지함</h1>

		<ul>
			<li><a href="./memo.php?kind=recv">받은쪽지</a></li>
			<li><a href="./memo.php?kind=send">보낸쪽지</a></li>
			<li><a href="./memo_form.php">쪽지쓰기</a></li>
		</ul>

		<div>
			<table>
			<caption>
				전체 <?php echo $kind_title ?>쪽지 <?php echo $total_count ?>통<br>
			</caption>
			<colgroup>
				<col width="20%">
				<col width="">
				<col width="">
				<col width="20%">
			</colgroup>
			<thead>
			<tr>
				<th><?php echo ($kind == "recv") ? "보낸사람" : "받는사람";  ?></th>
				<th>보낸시간</th>
				<th>읽은시간</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?php for ($i=0; $i<count($list); $i++) {  ?>
			<tr>
				<td><?php echo $list[$i]['mb_name'] ?></td>
				<td><?php echo $list[$i]['send_datetime'] ?></td>
				<td><a href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['read_datetime'] ?></a></td>
				<td><a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;">삭제</a></td>
			</tr>
			<?php }  ?>
			<?php if ($i==0) { echo '<tr><td colspan="4">자료가 없습니다.</td></tr>'; }  ?>
			</tbody>
			</table>
		</div>

		<p><?php echo $write_page;  ?><!-- 페이지 --></p>

		<div>
			<button type="button" onclick="window.close();">창닫기</button>
		</div>
	</div>
	<!-- } 쪽지 목록 끝 -->
	
</body>
</html>