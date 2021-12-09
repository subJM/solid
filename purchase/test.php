<?php
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";

// $sql="select * from purchase where member_id='aaaaa';";
//  $id_result=mysqli_query($con,$sql);
//  echo "<script>console.log(".isset($id_result).")</script>";

//  if(isset($id_result)==1){
//   $sql="update purchase set available_count = available_count+'1000000' where member_id='aaaaa';";
//   mysqli_query($con,$sql);
// }else{
//   $sql="insert into purchase values(null, now(), 'aaaaa', 5, '포인트 구매',1000,1000,'카카오페이');";
//   mysqli_query($con,$sql); 
// }
$sql="select * from recruit_plan where price='1000';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
var_dump($row);


?>