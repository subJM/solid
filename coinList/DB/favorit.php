<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

// $user_id = $_SESSION['user_id'];
$user_id = "master";

$sql = "SELECT * FROM favorite_coin";
// WHERE id ='$user_id'
$list = array();
$result = mysqli_query($con, $sql) or die("검색 ERROR" . mysqli_error($con));
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    $list[$count++] = $row['coinName'];
}

echo "let favorit_coinName = " . json_encode($list);

mysqli_close($con);