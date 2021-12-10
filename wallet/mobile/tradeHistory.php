
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
session_start();
$user_id = $_SESSION['user_id'];
$user_id = "master";
$history = array();
$sql = "SELECT * FROM coin_info WHERE id='$user_id'";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $history[] = $row;
}
echo json_encode($history);
?>