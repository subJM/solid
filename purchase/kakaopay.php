<?php
session_start();
$num=$_GET['num'];
$id=$_GET['id'];
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";
  $sql="select * from recruit_plan where num='$num'";
  $result_recruit_plan=mysqli_query($con,$sql);
  $row_recruit_plan=mysqli_fetch_array($result_recruit_plan);
  $sql="select * from members where id='".$id."'";
  $result_corporate=mysqli_query($con,$sql);
  $row_corporate=mysqli_fetch_array($result_corporate);
 ?>

<html>

<head>
  <title>카카오페이</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <style type="text/css">
  /* <![CDATA[ */
  @charset "utf-8";

  /* reset */
  body,
  div,
  dl,
  dt,
  dd,
  ul,
  ol,
  li,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  pre,
  code,
  form,
  fieldset,
  legend,
  textarea,
  p,
  blockquote,
  th,
  td,
  input,
  select,
  button {
    margin: 0;
    padding: 0
  }

  fieldset,
  img {
    border: 0 none
  }

  dl,
  ul,
  ol,
  menu,
  li {
    list-style: none
  }

  blockquote,
  q {
    quotes: none
  }

  blockquote:before,
  blockquote:after,
  q:before,
  q:after {
    content: '';
    content: none
  }

  input,
  select,
  textarea,
  button {
    vertical-align: middle;
    font-size: 100%
  }

  button {
    border: 0 none;
    background-color: transparent;
    cursor: pointer
  }

  table {
    border-collapse: collapse;
    border-spacing: 0
  }

  body {
    -webkit-text-size-adjust: none
  }

  input:checked[type='checkbox'] {
    background-color: #666;
    -webkit-appearance: checkbox
  }

  input[type='text'],
  input[type='password'],
  input[type='submit'],
  input[type='search'],
  input[type='tel'],
  input[type='email'],
  html input[type='button'],
  input[type='reset'] {
    -webkit-appearance: none;
    border-radius: 0
  }

  input[type='search']::-webkit-search-cancel-button {
    -webkit-appearance: none
  }

  body {
    background: #fff
  }

  body,
  th,
  td,
  input,
  select,
  textarea,
  button {
    font-size: 14px;
    line-height: 1.5;
    font-family: 'Apple SD Gothic Neo', 'Malgun Gothic', '맑은 고딕', sans-serif;
    color: #1e1e1e
  }

  a {
    color: #333;
    text-decoration: none
  }

  a:active,
  a:hover {
    text-decoration: none
  }

  address,
  caption,
  cite,
  code,
  dfn,
  em,
  var {
    font-style: normal;
    font-weight: normal
  }

  /* global */
  #kakaoIndex {
    overflow: hidden;
    position: absolute;
    left: -9999px;
    width: 0;
    height: 1px;
    margin: 0;
    padding: 0
  }

  .ir_pm {
    display: block;
    overflow: hidden;
    font-size: 0px;
    line-height: 0;
    text-indent: -9999px
  }

  .ir_wa {
    display: block;
    overflow: hidden;
    position: relative;
    z-index: -1;
    width: 100%;
    height: 100%
  }

  .screen_out {
    overflow: hidden;
    position: absolute;
    width: 0;
    height: 0;
    line-height: 0;
    text-indent: -9999px
  }

  .show {
    display: block
  }

  .hide {
    display: none
  }

  article,
  aside,
  footer,
  header,
  hgroup,
  main,
  nav,
  section {
    display: block
  }

  /* Payment Demo */
  .wrap_demo {
    min-width: 320px;
    margin: 0 auto 156px;
    text-align: center
  }

  .wrap_demo .tit_kakaopay {
    display: block;
    width: 67px;
    height: 22px;
    margin: 72px auto 0;
    font-size: 0;
    line-height: 0;
    text-indent: -9999px;
    background: url(/assets/img/docs/ico_pay_320.png) no-repeat 0 0
  }

  .wrap_demo .tit_demo {
    margin-top: 21px;
    font-weight: 300;
    font-size: 38px
  }

  .wrap_demo .txt_demo {
    margin-top: 20px;
    font-size: 15px;
    line-height: 24px
  }

  .wrap_demo .pay_btn {
    padding-top: 74px
  }

  .wrap_demo .pay_btn .btn_pay {
    display: block;
    width: 278px;
    height: 63px;
    margin: 10px auto 0;
    border-radius: 63px;
    font-size: 17px;
    color: #fff;
    background-color: #333;
    text-align: center
  }

  .wrap_demo .pay_btn .btn_pay_hover:hover {
    color: #111;
    background-color: #ffcf22
  }

  .wrap_demo .txt_append {
    margin-top: 30px;
    line-height: 24px;
    opacity: .5
  }

  @media only all and (-webkit-min-device-pixel-ratio: 1.5),
  only screen and (min-device-pixel-ratio: 1.5),
  only screen and (min-resolution: 1.5dppx) {
    .wrap_demo .tit_kakaopay {
      background-image: url(/assets/img/docs/ico_pay_640.png);
      background-size: 67px 22px
    }
  }

  /* ]]> */
  </style>
</head>

<body style="">
  <div id="kakaoIndex">
    <a href="#kakaoBody">
      본문 바로가기
    </a>
  </div>
  <div id="kakaoWrap" class="wrap_demo">
    <header id="kakaoHead">
      <h1 class="tit_kakaopay">
        카카오페이
      </h1>
      <hr class="hide">
      <main id="kakaoContent">
        <article id="mArticle">
          <h2 id="kakaoBody" class="tit_demo">
            Payment Demo
          </h2>
          <p class="txt_demo">
            API를 활용한 카카오페이 결제를 체험해보세요.
            <br>
            (실제 결제는 일어나지 않습니다)
          </p>
          <div class="pay_btn">
            <button type="button" class="btn_pay btn_pay_hover" id="web" onclick="payment('web');">
              PC 결제
            </button>
            <button type="button" class="btn_pay" id="mobile" onclick="payment('mobile');" disabled="disabled"
              style="cursor: no-drop;">
              모바일 결제
            </button>
          </div>
          <p class="txt_append">
            모바일 결제는 모바일 기기로 접속시 가능합니다.
          </p>
        </article>
      </main>
    </header>
  </div>
  <script type="text/javascript">
  //<![CDATA[
  $(document).ready(function() {
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('#mobile').attr('disabled', 'disabled');
      $('#mobile').removeClass('btn_pay_hover');
      $('#mobile').css('cursor', 'no-drop');
    }
  });

  function payment() {
    // var IMP = window.IMP; // 생략가능
    IMP.init('imp87607561'); //가맹점 식별 코드
    //아래 입력된 정보는 테스트를 위한것.
    //원래는 주문자 정보를 가져와서 넣어야함.

    IMP.request_pay({
      pg: 'kakaopay', //결제방식
      pay_method: 'card', //결제 수단
      merchant_uid: 'merchant_' + new Date().getTime(),
      name: '<?php echo $row_recruit_plan['name'] ?>', //order 테이블에 들어갈 주문명 혹은 주문 번호
      amount: '<?php echo $row_recruit_plan['price'] ?>', //주문 금액
      buyer_name: '<?php echo $row_corporate['id']; ?>', //구매자 이름
      kakaoOpenApp: true
    }, function(rsp) {
      //callback함수
      if (rsp.success) {
        //[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
        jQuery.ajax({
          url: "/payments/complete", //cross-domain error가 발생하지 않도록 주의해주세요
          type: 'POST',
          dataType: 'json',
          data: {
            imp_uid: rsp.imp_uid
            //기타 필요한 데이터가 있으면 추가 전달
          }
        }).done(function(data) {
          //[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
          if (everythings_fine) {
            msg = '결제가 완료되었습니다.';
            msg += '\n고유ID : ' + rsp.imp_uid;
            msg += '\n상점 거래ID : ' + rsp.merchant_uid;
            msg += '\결제 금액 : ' + rsp.paid_amount;
            msg += '카드 승인번호 : ' + rsp.apply_num;

            alert(msg);
          } else {
            //[3] 아직 제대로 결제가 되지 않았습니다.
            //[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
          }
        });
        alert('결제가 완료되었습니다.');
        $.ajax({
          url: "./purchase_insert.php",
          type: 'POST',
          data: {
            id: "<?php echo $id ?>",
            num: "<?php echo $row_recruit_plan['num'] ?>",
            name: "<?php echo $row_recruit_plan['name'] ?>",
            price: "<?php echo $row_recruit_plan['price'] ?>"
          }
        }).done(function(data) {}).fail(function() {});


        location.href =
          "http://<?= $_SERVER['HTTP_HOST'];?>/solid/purchase/point_purchase.php"

      } else {
        var msg = '결제에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg;
        alert(msg);
        // alert('결제가 실패되었습니다.');
        return false;
      } //end of else

    });
  }

  //]]>
  </script>
</body>

</html>