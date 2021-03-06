<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_statement.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
// echo $_SERVER['DOCUMENT_ROOT']
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain_section.css">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/js/main.js"></script>
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