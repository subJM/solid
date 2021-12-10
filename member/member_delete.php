<?php
  session_start();
  include $_SERVER['DOCUMENT_ROOT']."/solid/db/db_connector.php";
  
  if(isset($_SESSION['user_id'])) {

      $userid = $_SESSION['user_id'];
      $sql = "DELETE FROM solid.members WHERE id='$userid';";
      $select_result = mysqli_query($con, $sql) or die("멤버 삭제 ERROR" . mysqli_error($con));
      $result = mysqli_fetch_assoc($select_result);

      if($result){
         unset($_SESSION["user_id"]);
         unset($_SESSION["user_name"]);
         unset($_SESSION["user_level"]);
      }
      echo "
      <script>
         location.href = '../index.php?실패';
         </script>
      ";
   }


  echo "
       <script>
          location.href = '../index.php?뭐지';
          </script>
       ";
?>
