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
    <span><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/index.php"><img class="top1-1_icon"
          src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/logo1.svg" /></a></span>
    <ul class="top1-1table">
      <li class="top1-1tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/coinList/coinList.php">거래소</a>
      </li>
      <li class="top1-1tabletd">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/notice/notice_list.php">공지사항</a>
      </li>
      <li class="top1-1tabletd"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/wallet.php">자산</a></li>
      <li class="top1-1tabletd"><a
          href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/question/question_list.php">1:1문의</a>
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
        <img id="optionmenu" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/optionmenu.png">

        <ul class="submenu">
          <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php?mode='modify'">마이페이지</a></li>
          <li><a href="./memo/memo.php" onclick="win_memo(this.href); return false;">쪽지함</a></li>
          <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/point_purchase.php">포인트구매</a></li>
          <?php
			}
            if ($userid && $userlevel == 1) { ?>
          <li>
            <a class="top1-2tabletd" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/login/logout.php">로그아웃</a>
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
      </li>
    </ul>
  </div>
</div>
<script>
var win_memo = function() { // 쪽지 팝업창
  href = "http://<?= $_SERVER['HTTP_HOST'] ?>/solid/memo/memo.php?kind=recv&page=1";
  var new_win = window.open(href, 'win_memo', 'left=100,top=100,width=620,height=600,scrollbars=1');
  new_win.focus();
}
</script>