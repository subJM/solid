<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";  // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.

session_start();
$mb_id = $_SESSION['user_id'];
$kind = $_GET['kind'] ? $_GET['kind'] : 'recv';

if (!$mb_id) {
	echo "<script>alert('회원만 이용하실 수 있습니다.');window.close();</script>";
	exit;
}

$me_id = $_GET['me_id'];

$sql = " DELETE FROM memo
            WHERE me_id = '{$me_id}'
            AND (me_recv_mb_id = '$mb_id' OR me_send_mb_id = '$mb_id') ";
$result = mysqli_query($con, $sql);

if ($result) { // 쿼리가 정상 실행됐다면.
	$url = './memo.php?kind='.$kind;
	echo "<script>alert('쪽지가 삭제 완료 되었습니다.');</script>";
	echo "<script>location.replace('$url');</script>";
	exit;
} else {
	echo "삭제 실패: " . mysqli_error($con);
	mysqli_close($con); // 데이터베이스 접속 종료
}
?>