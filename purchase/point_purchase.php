<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_statement.php";


  $sql="select * from purchase where member_id='".$_SESSION['user_id']."'
  ORDER BY num DESC;";
  $result_purchase=mysqli_query($con,$sql);
  $numrow_purchase = mysqli_num_rows($result_purchase);
   //행(ROW) 수 만큼
    for($i=0; $i<$numrow_purchase; $i++){
        // mysql_fetch_array를 반복합니다.
        $row_purchase[$i]=mysqli_fetch_array($result_purchase);
    }
    $sql="select * from recruit_plan";
    $result=mysqli_query($con,$sql);
    $numrow = mysqli_num_rows($result);
     //행(ROW) 수 만큼
      for($i=0; $i<$numrow; $i++){
          // mysql_fetch_array를 반복합니다.
          $row[$i]=mysqli_fetch_array($result);
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.4">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.4">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.4">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/purchase/css/point_purchase.css?.asd5a">
  <link rel="stylesheet" href="http://cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <script type="text/javascript">
  $(function() {
    $('#option1_0').click(function() {
      $('input[name=options]').val();
    });
    $('#plan_buy').click(function() {
      location.href = "http://<?= $_SERVER['HTTP_HOST'] ?>/solid/purchase/kakaopay.php?plan=" + $(
          'input[name="options"]:checked').val() +
        "&id=<?=$_SESSION['user_id']?>";
    });
  });

  function select_plan(label) {
    const radio_array = document.querySelectorAll('input[type="radio"]');
    radio_array.forEach(function(radio) {
      radio.nextElementSibling.nextElementSibling.style.display = "none";
    });

    const check_sign = label.nextElementSibling;
    const radio = label.control;

    check_sign.style.display = "inline";

  }
  </script>
</head>

<body>
  <div class="container">
    <header>
      <?php include "../header.php"; ?>
    </header>
    <section id="manage_plan">
      <form action="purchase_form.php">
        <input type="hidden" name="id" value="<?=$_SESSION['user_id']?>">
        <?php
              for ($i=0; $i < $numrow; $i++) {
                if($i==0){
                  $sec="checked";
                }else{
                  $sec="";
                }
                  echo "
                  <div class='col-sm-5 plan_item'>
                  <input type='radio' autocomplete='off'
                  ".$sec." name='recruit_plan' value='".$row[$i]['num']."' id='input_".$i."'/>
                  <label for='input_".$i."' onclick='select_plan(this);'>
                    <p class='plan_name' id='span_".$i."'>".$row[$i]['name']."</p>
                    <img class='plan_point' src='../img/point.png'>
                    <p class='plan_count'>포인트 ".$row[$i]['count']." 점</p>
                    <p class='plan_price'>".$row[$i]['price']."원</p>
                  </label>
                  </div>
                  ";
                }
                ?>
        <div id="buy_button">
          <input type="submit" class="btn btn-primary btn-block" id="purchase_plan" value="구매하기">
        </div>
  </div>
  </form>
  </section>
  <footer>
    <?php include "../footer.php"; ?>
  </footer>
</body>

</html>