<!DOCTYPE html>

<html lang="kr">

<head>
  <title>CSS Website Layout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../wallet/css/wallet.css.?sdfawefas">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css?.2">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css?.2">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css?.2">
</head>

<body>
  <header>
    <?php include "../../header.php"; ?>
  </header>
  <div class="row">
    <div class="row_container">
      <div class="column_side">
        <div class="side_list_container">
          <ul>
            <li class="walletList"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/wallet.php">수익현황</a>
            </li>
            <li class="walletList"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/wallet/php/purchasehistory.php?.asdfakjl">거래내역</a>
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
              <div class="overall_1_2">0 원</div>
            </div>
            <div class="overall_2">
              <div class="overall_2_1">
                <div class="overall_2_1_1">
                  <div class="tag_1">보유 원화</div>
                  <div class="value_1">0원</div>
                </div>
                <div>
                  <div class="tag_1">보유 가상자산</div>
                  <div class="value_1">0원</div>
                </div>
              </div>
              <div class="overall_2_1">
                <div>
                  <div class="tag_2">총 매수금액</div>
                  <div class="value_2">0원</div>
                </div>
                <div>
                  <div class="tag_2">평가 손익</div>
                  <div class="value_2">0원</div>
                </div>
                <div>
                  <div class="tag_2">수익률</div>
                  <div class="value_3">0.00%</div>
                </div>
              </div>
            </div>
          </div>
          <div class="table_comment">매수평균가, 평가금액, 평가손익, 수익률은 모두 KRW로 환산한 추정 값으로 참고용입니다</div>
          <div>
            <table class="table">
              <thead class="table-light">
                <tr class="tr_name">
                  <th class="col">코인명</th>
                  <th class="col_r">보유수량</th>
                  <th class="col_r">매수 평균가</th>
                  <th class="col_r">매수 금액</th>
                  <th class="col_r">평가 금액</th>
                  <th class="col_r">수익률</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

                $totalAmount;
                $asd;
                $buyPrice;
                $sql = "SELECT * FROM coin_info";
                $result = mysqli_query($con, $sql);

                $coinName = "SELECT DISTINCT coinName FROM coin_info";
                $coinNameResult = mysqli_query($con, $coinName);

                while ($row = @mysqli_fetch_array($coinNameResult)) {

                  $totalAmount = 0;
                  $asd = 0;
                  $buyPrice = 0;
                  $coinSql = "SELECT*FROM coin_info WHERE coinName = '$row[coinName]'";
                  $coinData = mysqli_query($con, $coinSql);

                  while ($row1 = mysqli_fetch_array($coinData)) {

                    if ($row1['transaction'] == "buy") {
                      $totalAmount = $totalAmount + $row1['amount'];
                    } else {
                      $totalAmount = $totalAmount - $row1['amount'];
                    }

                  }

                ?>
                  <tr class="trtr">
                    <td class="td_l"><?= $row['coinName'] ?></td>
                    <td><?= $totalAmount ?></td>
                    <td><?= $row['transaction'] ?></td>
                    <td><?= $row['price'] ?>원</td>
                    <td><?= $row['amount'] ?>%</td>
                    <td><?= $row['totalPrice'] ?>원</td>
                  </tr>
                <?php
                } ?>
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