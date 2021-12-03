<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/solid/db/db_connector.php";

  if(isset($_GET['recruit_plan'])){
    $recruit_plan=$_GET['recruit_plan'];
  }
  if(isset($_GET['id'])){
    $id=$_GET['id'];
  }
  $sql="select * from recruit_plan where num='$recruit_plan'";
  $result_recruit_plan=mysqli_query($con,$sql);
  $row_recruit_plan=mysqli_fetch_array($result_recruit_plan);
  $numrow_purchase = mysqli_num_rows($result_recruit_plan);
  $row_purchase=mysqli_fetch_array($result_recruit_plan);

  $sql="select * from members where id='$id'";
  $result_corporate=mysqli_query($con,$sql);
  $row_corporate=mysqli_fetch_array($result_corporate);



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>일하세</title>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
  <link rel="stylesheet" href="http://cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

  <script type="text/javascript">
  $(function() {
    var num = 0;
    $('#kakaopay').mouseup(function() {
      $('.hid').css('display', 'none');
    });
    $('#mutong').mouseup(function() {
      $('.hid').css('display', 'inline-table');

    });
    $('#plan_purchase_button').click(function() {
      var purchase_plan = $('input[name="purchase_method"]:checked').val();
      var p_typeValue = $("#account option:selected").val()

      if (purchase_plan == "무통장") {
        if ($("#account option:selected").val() == "-입금계좌를 선택해 주세요-") {
          alert("입금계좌를 선택해 주세요");
          return;
        }

        $.ajax({
          url: "./purchase_insert.php",
          type: 'POST',
          data: {
            id: "<?php echo $id ?>",
            num: "<?php echo $row_recruit_plan['num'] ?>",
            name: "<?php echo $row_recruit_plan['name'] ?>",
            price: "<?php echo $row_recruit_plan['price'] ?>",
            account: document.querySelector('#account').value.slice(0, 2),
            p_type: p_typeValue
          }
        }).done(function(data) {}).fail(function() {});
        alert('결제가 완료되었습니다.');
        location.href =
          "http://<?= $_SERVER['HTTP_HOST'];?>/solid/point_purchase.php"

      } else if (purchase_plan == "kakao") {
        location.href =
          "http://<?= $_SERVER['HTTP_HOST'];?>/solid/kakaopay.php?num=<?=$recruit_plan?>&id=<?=$id?>";
      }
    });
  });
  </script>
</head>

<body>

  <div class="div_container" style="margin-top:100px;">
    <h3 class="title">결제 <span class="xi-credit-card"></span></h3> <br /><br />
    <table class="table table-sm purchase_table">
      <tbody>
        <tr>
          <td colspan="2">
            <h5>구매 상품</h5>
            <h6>📄<?= $row_purchase['name']?> (<?= $row_purchase['price']?>원)</h6>
            <br /><br />
          </td>
        </tr>
        <tr class="hidden">
          <td class="hidden">
            <form name="coperate_update_submit"
              action="corperate_update.php?id='
              <?php echo $row['id'] ?>'&jc='<?php echo $row['job_category'] ?>&b_license_num=<?php echo $row['b_license_num'] ?>'" method="post">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <h5>결제 수단<span style="color:red">*</span></h5>
            <h6 style="color:#ed3131">(주의 : 무통장 입금 시 신청 후 24시간 이내에 입금을 하셔야 플랜을 구입이 완료됩니다.)</h6>
          </td>
        </tr>
        <tr>
          <td style="width: 30%">
            <input type="radio" class="form-control" name="purchase_method" value="무통장" id="mutong">
            <label for="mutong">무통장 입금</label>
          </td>
          <td style="width: 70%">
            <input type="radio" class="form-control" value="kakao" name="purchase_method" id="kakaopay">
            <label for="kakaopay">카카오페이</label>
          </td>
        </tr>
        <tr class="hid">
          <td colspan="2" class="hid">
            <!-- <h5>입금 계좌<span style="color:red">*</span></h3> -->
            <select class="form-control" name="account" id="account">
              <option>-입금계좌를 선택해 주세요-</option>
              <option>농협 123-10-1234567</option>
              <option>신한 12-2424-23232</option>
              <option>국민 13-123-1313-31</option>
              <option>하나 123-10-1234567</option>
              <option>우리 12-2424-23232</option>
              <option>외환 13-123-1313-31</option>
              <option>기업 123-10-1234567</option>
              <option>신한 12-2424-23232</option>
              <option>우체국 13-123-1313-31</option>
              <option>수협 123-10-1234567</option>
            </select>
        </tr>
        <tr>
          <td colspan="2">
            <input type="button" class="form-control" value="결제" id="plan_purchase_button">
          </td>
        </tr>
        </form>
      </tbody>
    </table>
    <br><br><br>

  </div>

  <style media="screen">
  .div_container .title {
    border-bottom: 1px solid black;
    padding: 0.5rem;
  }

  .hid,
  .hidden {
    display: none;
  }

  .div_container {
    width: 900px;
    margin: 0 auto;
    user-select: none;
  }

  .table td {
    border-top: 0;
  }

  #plan_purchase_button {
    background-color: rgb(133, 198, 241);
    border-radius: 10px;
    color: white;
    margin-top: 5rem;
  }

  input[type="radio"] {
    display: inline-block;
    width: 20px;
  }

  label {
    vertical-align: top;
    line-height: 35px;
  }

  .table {
    width: 80%;
    margin: 0 auto;
  }
  </style>

  <script>
  //nav active 활성화
  document.querySelectorAll('.nav-item').forEach(function(data, idx) {
    data.classList.remove('active');

    if (idx === 4) {
      data.classList.add('active');
    }
  });
  </script>
</body>

</html>