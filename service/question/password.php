<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

	$pass = $_POST["pass"];
	$num = $_POST["num"];
	$page = $_POST["page"];

	$sql = "SELECT * from question where num=$num";

			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);

			$read_pw = $row["read_pw"];

			if ($pass !== $read_pw) {
				echo "fail";
			}
?>
