<?php
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";
$id =$_POST['id'];
$num =$_POST['num'];
$name =$_POST['name'];
$price =$_POST['price'];
$account =$_POST['account'];
echo $account;

if(isset($_POST['p_type'])){
  $p_type ="무통장(".$account.")";
}else{
  $p_type="카카오페이";
}

$sql="select * from recruit_plan where price=".$price.";";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
date_default_timezone_set("Asia/Seoul");
$date=date("Y-m-d H:i:s");
$sql1 = "select * from purchase where available_count;"
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_array($result1);
$sql="update purchase set available_count = $row1['avaliable_count'] + $row['count'] where id = $id;";
mysqli_query($con,$sql);
 ?>