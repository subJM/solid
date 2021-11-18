<?php
  session_start();
  unset($_SESSION["user_id"]);
  unset($_SESSION["user_name"]);
  unset($_SESSION["user_level"]);

  echo "
       <script>
          location.href = '../index.php';
          </script>
       ";
?>
