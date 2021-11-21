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

<div class="top1">
    <div class="top1-1">
        <span><img class="icon" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/logo1.svg" /></span>
        <ul class="top1-1table">
        
            <li class="top1-1tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/coin/coin.html">거래소</li>
            <li class="top1-1tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php">공지사항</li>
            <li class="top1-1tabletd">자산</li>
            <li class="top1-1tabletd">1:1문의</li>
        </ul>
    </div>
    <div class="top1-2">
        <ul class="top1-2table">
        <?php
			if (!$userid) {
                ?>
				<li class="top1-2tabletd" ><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php">회원가입</a></li>
				<li class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/login_form.php">로그인</a></li>
			<?php
			} else {
				$logged = $username . "(" . $userid . ")님 환영합니다.";
			?>
				<li><?= $logged ?></li>
				<li>< class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/logout.php">로그아웃</li>
			<?php
			}
            if ($userid && $userlevel == 1) { ?>
				<li>< href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/admin/admin_members.php">관리자모드
				</li>
			<?php
			} else if ($userid) {
			?>
				<li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_mypage.php">마이페이지
				</li>
			<?php
			}
			?>
        </ul>
    </div>
</div>


