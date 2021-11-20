<!-- <?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (isset($_SESSION["user_id"])) $userid = $_SESSION["user_id"];
else $userid = "";
if (isset($_SESSION["user_name"])) $username = $_SESSION["user_name"];
else $username = "";
if (isset($_SESSION["user_level"])) $userlevel = $_SESSION["user_level"];
else $userlevel = "";
?> -->

<!-- <?
    if (isset($_POST['mode']) && $_POST['mode'] === "white") { ?>
<div id="top" class="white">
	<img src="http://<?= $_SERVER['HTTP_HOST'] ?>/todagtodag/img/todagtodag_logo_white.png">
	<? } else { ?>
	<div id="top">
		<img src="http://<?= $_SERVER['HTTP_HOST'] ?>/todagtodag/img/todagtodag_logo.png">
		<? } ?> -->
<div class="top1">
    <div class="top1-1">
        <span><img class="icon" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/logo1.svg" /></span>
        <ul class="top1-1table">
        
            <li class="top1-1tabletd">거래소</li>
            <li class="top1-1tabletd">공지사항</li>
            <li class="top1-1tabletd">자산</li>
            <li class="top1-1tabletd">1:1문의</li>
        </ul>
    </div>
    <div class="top1-2">
        <ul class="top1-2table">
        <?php
			if (!$userid) {
                ?>
				<li><a class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php">회원가입</a>
				</li>
				<li><a class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/login_form.php">로그인</a></li>
			<?php
			} else {
				$logged = $username . "(" . $userid . ")님 환영합니다.";
			?>
				<li><?= $logged ?></li>
				<li><a class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/logout.php">로그아웃</a></li>
			<?php
			}
            if ($userid && $userlevel == 1) { ?>
				<li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/admin/admin_members.php">관리자모드</a>
				</li>
			<?php
			} else if ($userid) {
			?>
				<li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_mypage.php">마이페이지</a>
				</li>
			<?php
			}
			?>
        </ul>
    </div>
</div>


