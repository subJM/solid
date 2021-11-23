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
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css?.afkkkter">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXfooter.css?.ad">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXheader.css?.5sda">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain_section.css?sa">
</head>

<body>
    <div class="container">
        <header>
            <?php include "./header.php"; ?>
        </header>
        <section>
            <?php include "./home.php"; ?>
        </section>
        <footer>
            <?php include "./footer.php"; ?>
        </footer>
    </div>
</body>

</html>