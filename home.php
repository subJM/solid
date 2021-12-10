<div class="slideshow">
  <div class="slideshow_slides">
    <a href="#"><img class="slide_pic" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/mainpic-1.png"
        alt="slide" /></a>
    <a href="#"><img class="slide_pic" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/mainpic-2.png"
        alt="slide" /></a>
    <a href="#"><img class="slide_pic" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/mainpic-3.png"
        alt="slide" /></a>
    <a href="#"><img class="slide_pic" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/mainpic-5.png"
        alt="slide" /></a>
  </div>
  <div class="slideshow_nav">
    <a href="#" class="prev">prev</a>
    <a href="#" class="next">next</a>
  </div>
  <div class="slide_indicator">
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
  </div>
</div>
<div class="notice_FAQ">
  <div id="notice">
    <table class="">
      <th id="notice-1" class="notice_FAQ_left">공지사항</th>
      <th class="notice_FAQ_right"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/notice/notice_list.php">전체보기</a>
      </th>
      <?php 
					//1. 현재페이지가 없다면 1페이지로 셋팅
					$page = isset($_GET["page"]) ? $_GET["page"] : 1;

					//2. 전체 레코드 수
					$sql = "select * from notice order by num desc";
					$select_result = mysqli_query($con, $sql);
					$total_record = mysqli_num_rows($select_result);

					//3. 페이지당 글 수 를 넣는다.
					$scale = 5;

					//4. 전체 페이지 수 ($total_page) 계산
					$total_page=($total_record !== 0) ? ceil($total_record / $scale) : 0;

					//4-1. 표시할 페이지($page)에 따라 $start 계산
					$start = ($page - 1) * $scale;

					//5. 현재 페이지 레코드 결과값을 저장하기위해서 배열선언
					$list = array();

					//6. 해당되는 페이지 레코드를 가져와서 배열에 넣고 회원번호 포함
					$sql = "select * from notice order by num desc LIMIT 5";
					$select_result = mysqli_query($con, $sql);

					for ($i=0; $row=mysqli_fetch_assoc($select_result); $i++){
						$list[$i] = $row;
						//회원번호
						$list_num = $total_record - ($page - 1) * $scale;
						$list[$i]['no'] = $list_num - $i;
					}
      for($i=0; $i<count($list); $i++){ ?>
      <tr>
        <td class="notice_FAQ_left"><a
            href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/notice/notice_view.php?num=<?= $list[$i]['num'] ?>"><?= $list[$i]['subject'] ?></a>
        </td>
        <td class="notice_FAQ_right"><?= $list[$i]['regist_day'] ?></td>
      </tr>
      <?php }	?>
    </table>
  </div>
  <div id="updown">
  </div>
  <div id="FAQ">
    <table>
      <th id="FAQ-1" class="notice_FAQ_left">FAQ</th>
      <th class="notice_FAQ_right"><a class="tag" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/faq/faq_list.php">전체보기
        </a></th>
      <?php 
					//1. 현재페이지가 없다면 1페이지로 셋팅
					$page = isset($_GET["page"]) ? $_GET["page"] : 1;

					//2. 전체 레코드 수
					$sql = "select * from faq  order by num desc";
					$select_result = mysqli_query($con, $sql);
					$total_record = mysqli_num_rows($select_result);

					//3. 페이지당 글 수 를 넣는다.
					$scale = 5;

					//4. 전체 페이지 수 ($total_page) 계산
					$total_page=($total_record !== 0) ? ceil($total_record / $scale) : 0;

					//4-1. 표시할 페이지($page)에 따라 $start 계산
					$start = ($page - 1) * $scale;

					//5. 현재 페이지 레코드 결과값을 저장하기위해서 배열선언
					$list = array();

					//6. 해당되는 페이지 레코드를 가져와서 배열에 넣고 회원번호 포함
					$sql = "select * from faq order by num desc LIMIT 5";
					$select_result = mysqli_query($con, $sql);

					for ($i=0; $row=mysqli_fetch_assoc($select_result); $i++){
						$list[$i] = $row;
						//회원번호
						$list_num = $total_record - ($page - 1) * $scale;
						$list[$i]['no'] = $list_num - $i;
					}

					for($i=0; $i<count($list); $i++){
				?>
      <tr>
        <td class="notice_FAQ_left"><a
            href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/faq/faq_view.php?num=<?= $list[$i]['num'] ?>">
            <?= $list[$i]['subject'] ?></a></td>
        <td class="notice_FAQ_right"><?= $list[$i]['regist_day'] ?></td>
      </tr>
      <?php }	?>
    </table>
  </div>
</div>
<div class="subframe">
  <img id="subpic" src="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_main_sub.png" />
</div>