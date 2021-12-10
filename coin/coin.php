<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, maximum-scale=1.0, minimum-scale=1, user-scalable=yes,initial-scale=1.0" />
  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <link rel="stylesheet" href="./CSS/exchange.css">
  <link rel="stylesheet" href="./CSS/exchange_mobile.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDmain.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDfooter.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/Solid Css/SOLIDheader.css">
  <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
  <script src="./JS/coinData.JS?123123131"></script>
  <script src="./JS/trade.JS"></script>
  <style>
  /* .container {
    height: auto;
  } */
  </style>
  <script>
  const imgTag = document.querySelectorAll(".favorite_img");
  console.log(imgTag[0]);

  <?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
error_reporting(E_ALL ^ E_NOTICE);
$id = $_POST['id'];
$favorite_img;
if (isset($_GET["coinName"])) {
    $coinName = mysqli_real_escape_string($con, $_GET["coinName"]);
    if (empty($coinName)) {
        exit();
    } else {
        echo "const coinName = '$coinName';";
        $sql = "SELECT * FROM favorite_coin WHERE coinName ='$coinName' AND id='$id'";
        $result = mysqli_query($con, $sql) or die("검색 ERROR" . mysqli_error($con));
        $result_record = mysqli_num_rows($result);
        if ($result_record) {
          $favorite_img = "./img/star1.png";
          // echo "console.log('왜 여기만안됨?')";
          } else {
            $favorite_img = "./img/star2.png";
        }
    }
}
?>

  setInterval(() => {
    getTransactionHistory(coinName, setTransactionHistoryData)
    getOrderBook(coinName, setOrderBookData)
    getTickerData(coinName, setTickerData)
  }, 2000);
  </script>
</head>

<body>
  <header>
    <?php include "../header.php"; ?>
  </header>
  <div class="coinData-div">
    <ul>
      <li>
        <form name="favorite_form" action="./DB/favorite.php" method="post">
          <input type="hidden" name="coinName" value="<?=$coinName?>">
          <button type="submit"><img src="<?= $favorite_img ?>" class="favorite_img"></button>

        </form>
      </li>
      <li>
        <?=$coinName?>-KRW
      </li>
      <li>
        <span>현재 가격&nbsp;</span><span> </span>&nbsp;<span>0%</span>
      </li>
    </ul>
  </div>

  <div class="main-div">
    <div class="chart-div">
      <!-- TradingView Widget BEGIN -->
      <div class="tradingview-widget-container">
        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
        <script type="text/javascript">
        let width = document.getElementsByClassName("chart-div")[0].clientWidth
        let height = document.getElementsByClassName("chart-div")[0].clientHeight

        let tradingview = new TradingView.widget({
          "width": width,
          "height": height,
          "symbol": "BITHUMB:" + coinName + "KRW",
          "interval": "D",
          "timezone": "BTC/KRW",
          "style": "1",
          "locale": "kr",
          "toolbar_bg": "#f1f3f6",
          "enable_publishing": false,
          "allow_symbol_change": true,
          "container_id": "tradingview_53242"
        });
        </script>
      </div>
      <!-- TradingView Widget END -->
      </script>
    </div>

    <div class="flexTable-div">

      <div class="section orderbook-div">
        <div class="orderbookTable-div">
          <table>
            <caption>
              <p>Orderbook</p>
              <span><img src="" alt="">price</span>
            </caption>
            <tr>
              <th>Bid Size</th>
              <th>Bid Price</th>
              <th>Ask Price</th>
              <th>Ask Size</th>
            </tr>

            <script type="text/javascript">
            for (let j = 0; j < 30; j++) {
              let txt = 1;
              document.write("<tr>");
              document.write("<td>" + txt + "</td>");
              document.write("<td>" + txt + "</td>");
              document.write("<td>" + txt + "</td>");
              document.write("<td>" + txt + "</td>");
              document.write("</tr>");
            }
            </script>
          </table>
        </div>
      </div>

      <div class="section transactionTable-div">
        <div class="tradeSelect-tab">
          <ul>
            <li><a href="#a" onClick='buy_coin()'>BUY COIN</a></li>
            <li><a href="#a" onClick='sell_coin()'>SELL COIN</a></li>
          </ul>
        </div>

        <p class='price-p'>price</p>

        <span class="coinTotalPrice"> </span>

        <p class='amount-p'>Amount</p>
        <div id="trade_form">
          <form name="trade_form" action="./DB/trade.php" method="post">
            <input type="hidden" name="transaction">
            <input type="hidden" name="price">
            <input type="hidden" name="totalPrice">
            <input type="hidden" name="name" value="<?=$coinName?>">
            <input autocomplete="off" type="number" id="amount" name="amount" placeholder="갯수" value='1'
              onClick='changeAmount()' min='1'> <br>


            <button type="submit" onClick='trade()' class='trade_button'>
              <div>
                거래
              </div>
            </button>
          </form>
        </div>
      </div>
      <div class="section marketTradesTable-div">
        <table>
          <caption>Market Trades</caption>
          <tr>
            <th>Price</th>
            <th>Size</th>
            <th>Time</th>
          </tr>
          <script type="text/javascript">
          let txt1 = 1
          for (var j = 0; j < 20; j++) {
            document.write("<tr>");
            document.write("<td>" + txt1 + "</td>");
            document.write("<td>" + txt1 + "</td>");
            document.write("<td>" + txt1 + "</td>");
            document.write("</tr>");
          } //end for j
          </script>
        </table>
      </div>
      <div class="section coinTransactionDataTable-div">
        <table>
          <script type="text/javascript">
          let txt2 = 1
          for (var j = 0; j < 11; j++) {
            document.write("<tr>");
            document.write("<td>" + txt2 + "</td>");
            document.write("<td>" + txt2 + "</td>");
            document.write("</tr>");
          } //end for j
          </script>
        </table>

      </div>

    </div>
  </div>
  <footer>
    <?php include "../footer.php";?>
  </footer>

</body>

</html>