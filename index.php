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
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css">
</head>

<body>
    <div class="container">
        <header>
            <?php include "./header.php"; ?>
        </header>
        <article>
            <?php include "./home.php"; ?>
        </article>
        <footer>
            <?php include "./footer.php"; ?>
        </footer>
    </div>
</body>

</html>