<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
$sql = "SELECT * FROM purchase";
$result = mysqli_query($con, $sql);
$row = @mysqli_fetch_array($result);


$sql2 = "SELECT SUM(totalPrice) as tpb FROM coin_info WHERE transaction in ('buy')";
$result2 = mysqli_query($con, $sql2);
$row2 = @mysqli_fetch_array($result2);
$sql3 = "SELECT SUM(totalPrice) as tps FROM coin_info WHERE transaction in ('sell')";
$result3 = mysqli_query($con, $sql3);
$row3 = @mysqli_fetch_array($result3);
?>
<!DOCTYPE html>

<html lang="kr">

<head>
  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../wallet/css/wallet.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css">
  <script src="../js/coinData.JS?12"></script>
</head>
<script>

</script>

<body>
  <header>
    <?php
    include_once "../../header.php";
    $totalPrice = 0;
    ?>
  </header>
  <div class="row">
    <div class="row_container">
      <div class="column_side">
        <div class="side_list_container">
          <ul>
            <li class="walletList"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/wallet.php">수익현황</a>
            </li>
            <li class="walletList"><a
                href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/purchasehistory.php?.asdfakjl">거래내역</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="column_middle">
        <div class="middle_container">
          <div class="middle_container_name">
            <h2 class="main_name">수익현황</h2>
          </div>
          <div class="middle_overall">
            <div class="overall_1">
              <div class="overall_1_1">총 보유자산</div>
              <div class="overall_1_2"><span id=overallValue></span>원</div>
            </div>
            <div class=" overall_2">
              <div class="overall_2_1">
                <div class="overall_2_1_1">
                  <div class="tag_1">보유 원화</div>
                  <div class="value_1">
                    <span id="KRWValue"><?= $row['available_count'] ?></span>원
                  </div>
                </div>
                <div>
                  <div class="tag_1">보유 가상자산</div>
                  <div class="value_1"><span id="totalValue"></span>원</div>
                </div>
              </div>
              <div class="overall_2_1">
                <div>
                  <div class="tag_2">총 매수금액</div>
                  <div class="value_2"><span id="totalBuy"><?= $row2['tpb'] - $row3['tps'] ?></span>원</div>
                </div>
                <div>
                  <div class="tag_2">평가 손익</div>
                  <div class="value_2"><span id="evaluationPL"></span>원</div>
                </div>
                <div>
                  <div class="tag_2">수익률</div>
                  <div class="value_3"><span id="totalPercent"></span>%</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="table_comment">매수평균가, 평가금액, 평가손익, 수익률은 모두 KRW로 환산한 추정 값으로 참고용입니다</div>

          <div class="wallet-div">
            <table class="table">
              <thead class="table-light">
                <tr class="tr_name">
                  <th class="col">코인명</th>
                  <th class="col_r">보유수량</th>
                  <th class="col_r">매수 평균가</th>
                  <th class="col_r">평가 금액</th>
                  <th class="col_r">수익률</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $totalAmount;
                $asd;
                $buyPrice;
                $coinNameArray = array();
                if (!isset($_SESSION["user_id"])) {
                  echo "
                                <script>
                                alert('로그인이 필요합니다.');
                                </script>";
                  exit();
                }

                $user_id = $_SESSION['user_id'];
                $coinName = "SELECT DISTINCT coinName FROM coin_info";
                $coinNameResult = mysqli_query($con, $coinName);

                while ($row = @mysqli_fetch_array($coinNameResult)) {

                  $totalAmount = 0;
                  $buyPrice = 0;
                  $buyAmount = 0;
                  $totalValue = 1;
                  $coinSql = "SELECT*FROM coin_info WHERE coinName = '$row[coinName]'";
                  $coinData = mysqli_query($con, $coinSql);
                  $coinNameArray[] = $row['coinName'];
                  while ($row1 = mysqli_fetch_array($coinData)) {

                    if ($row1['transaction'] == "buy") {
                      $totalAmount = $totalAmount + $row1['amount'];
                      $buyPrice += $row1['totalPrice'];
                      $buyAmount += $row1['amount'];
                      $totalValue += $totalAmount * '현재가격';
                    } else {
                      $totalAmount = $totalAmount - $row1['amount'];
                    }
                  }

                ?>
                <tr class="trtr">
                  <td class="td_l"><span><?= $row['coinName'] ?></span></td>
                  <td><span><?= $totalAmount ?></span><a class="cName"></a></td>
                  <td><span><?= floor($buyPrice / $buyAmount) ?></span>원</td>
                  <td><span></span>원</td>
                  <td><span></span>%</td>
                </tr>
                <?php
                }
                ?>
                <script>
                getTransactions(<?= json_encode($coinNameArray) ?>);
                </script>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <footer>
    <?php include "../../footer.php"; ?>
  </footer>
</body>

</html>