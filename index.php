<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_statement.php";
// echo $_SERVER['DOCUMENT_ROOT']
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <title>No.1 가상자산 플랫폼, Solid</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.afkqwesadkkster">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.aqwessadd">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.5ssaassasasa12sdda">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain_section.css?assasaaaddsa">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/js/main.js?saad"></script>
</head>

<body onload="call_js()">
  <div class="container">
    <header>
      <?php include "./header.php"; ?>
    </header>
    <section id="main-section">
      <?php include "./home.php"; ?>
    </section>
    <footer>
      <?php include "./footer.php"; ?>
    </footer>
  </div>
</body>

</html>