<?php
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";

$sql="select * from purchase where member_id='bbbbb';";
$id_result=mysqli_query($con,$sql);
$result=mysqli_fetch_assoc($id_result);

mysqli_close($con);
var_dump(isset($result));
?>