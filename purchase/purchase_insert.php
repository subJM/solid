<?php
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";
$id =$_POST['id'];
$num =$_POST['num'];
$name =$_POST['name'];
$account =$_POST['account'];
echo $account;

if(isset($_POST['p_type'])){
  $p_type ="무통장(".$account.")";
}else{
  $p_type="카카오페이";
}


date_default_timezone_set("Asia/Seoul");
 $date=date("Y-m-d H:i:s");
 $sql="select * from purchase where member_id='$id';";
 $id_result=mysqli_query($con,$sql);
 $result=mysqli_fetch_assoc($id_result);
 $point = 1000000;
 $price = 1000;
 if(isset($result)){
  $sql="update purchase set available_count = (available_count+'$point') where member_id='$id';";
  mysqli_query($con,$sql);
}else {
  $sql="insert into purchase values(null,'{$date}','{$id}','{$num}' ,'{$name}',$point , $price,'{$p_type}');";
  mysqli_query($con,$sql); 
}
mysqli_close($con);
?>