<!DOCTYPE html>

<html lang="kr">

<head>
  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../wallet/css/purchasehistory.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDheader.css">
</head>

<body>
  <header>
    <?php include_once "../../header.php";?>
  </header>
  <div class="row">
    <div class="row_container">
      <div class="column_side">
        <div class="side_list_container">
          <ul>
            <li class="walletList"><a href="http://<?=$_SERVER['HTTP_HOST']?>/solid/wallet/php/wallet.php">수익현황</a>
            </li>
            <li class="walletList"><a
                href="http://<?=$_SERVER['HTTP_HOST']?>/solid/wallet/php/purchasehistory.php">거래내역</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="column_middle">
        <div class="middle_container">
          <div class="middle_container_name">
            <h2 class="main_name">거래내역</h2>
          </div>

          <div class="table_comment">매수평균가, 평가금액, 평가손익, 수익률은 모두 KRW로 환산한 추정 값으로 참고용입니다</div>
          <div>
            <table class="table">
              <thead class="table-light">
                <tr class="tr_name">
                  <th class="col">시간</th>
                  <th class="col_r">코인</th>
                  <th class="col_r">거래</th>
                  <th class="col_r">체결량</th>
                  <th class="col_r">체결가</th>
                  <th class="col_r">거래금액</th>
                </tr>
              </thead>
              <tbody>
                <?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

$sql = "SELECT * FROM coin_info";
$result = mysqli_query($con, $sql);
while ($row = @mysqli_fetch_assoc($result)) {
    ?>
                <tr class="trtr">
                  <td class="td_l"><?=$row['trTime']?></td>
                  <td><?=$row['coinName']?></td>
                  <td>
                    <?php
if ($row['transaction'] === "buy") {
        echo "매수";
    } else {
        echo "매도";
    }
    ?>
                  </td>
                  <td><?=$row['amount']?></td>
                  <td><?=$row['price']?>원</td>
                  <td><?=$row['totalPrice']?>원</td>
                </tr>
                <?php
}?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

    <footer>
      <?php include "../../footer.php";?>
    </footer>
</body>

</html>