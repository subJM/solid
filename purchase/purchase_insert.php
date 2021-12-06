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
$sql="insert into purchase values(null,'".$date."','".$id."',".$num.",'".$name."',".$row['count'].",".$price.",'".$p_type."')";
mysqli_query($con,$sql);
 ?>