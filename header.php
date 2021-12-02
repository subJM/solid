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
        <span><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/index.php"><img class="top1-1_icon" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/logo1.svg" /></a></span>
        <ul class="top1-1table">
            <li class="top1-1tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/coin/coin.php">거래소</a>
            </li>
            <li class="top1-1tabletd">
                <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/notice/notice.php">공지사항</a>
            </li>
            <li class="top1-1tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/wallet.php">자산</a></li>
            <li class="top1-1tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/service/service.php">1:1문의</a>
            </li>
        </ul>
    </div>
    <div class="top1-2">
        <ul class="top1-2table">
            <?php
            if (!$userid) {
            ?>

                <li class="top1-2tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php">회원가입</a></li>
                <li class="top1-2tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/login_form.php">로그인</a>
                </li>
            <?php
            } else {
                $logged = $username . "(" . $userid . ")님 환영합니다.";
            ?>
                <li id="welcome_message" class="optionmenutable"><?= $logged ?></li>
                <li id="headermenu" class="optionmenutable">
                    <img id=optionmenu" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/optionmenu.png">

                    <ul class="submenu">
                        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php?mode='modify'">마이페이지</a>
                        </li>
                        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/admin/admin_members.php">쪽지함</a></li>
                    <?php
                }
                if ($userid && $userlevel == 1) { ?>
                        <li>
                            < class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/logout.php">관리자
                        </li>

                    <?php
                } else if ($userid) {
                    ?>
                        <li>
                            <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/logout.php">로그아웃</a>
                        </li>

                    <?php
                }
                    ?>
                    </ul>
                </li>

        </ul>
    </div>
</div>