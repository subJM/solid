<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, maximum-scale=1.0, minimum-scale=1, user-scalable=yes,initial-scale=1.0" />
    <title>Document</title>
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <link rel="stylesheet" href="./CSS/exchange.css">
</head>

<body>
    <div class="coinData-div">
        <ul>
            <li><img src="" alt="즐겨찾기"></li>
            <li><img src="" alt="코인이미지"></li>
            <li>
                <h1>ETH-KOR</h1>
            </li>
            <li>
                <p>Ethereum Perpetual Futures</p>
            </li>
            <li><span>현재가격</span></li>
            <li><span>상승률</span></li>
            <li>
                <p>Index Price</p> <span>현재가격</span>
            </li>
            <li>
                <p>Predicted Funding Rate</p> <span>예상 펀딩레이트</span> <span>시간</span>
            </li>
            <li>
                <p>Open Interest</p> <span>미결제 약정</span>
            </li>
            <li>
                <p>24h volume</p><span>24시간 거래내역</span>
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
                    "symbol": "BITHUMB:BTCKRW",
                    "interval": "D",
                    "timezone": "Etc/UTC",
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
                    <caption><p>Orderbook</p>
                    <span><img src="" alt="">price</span></caption>
                    <tr>
                        <th>Bid Size</th>
                        <th>Bid Size</th>
                        <th>Bid Size</th>
                        <th>Bid Size</th>
                    </tr>
                        <script type="text/javascript">
                        for (let j = 0; j < 15; j++) {
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
                <div id="tradeSelect-tab">
                        <ul>
                            <li><a href="">BUY COIN</a></li>
                            <li><a href="">SELL COIN</a></li>
                        </ul>
                </div>
                <div id="trade_form">
                    <form name="trade_form" action="" method="post">
                        <input autocomplete="off" type="number" id="amount" name="amount" placeholder="갯수"> <br>
                    </form>
                    <span class="coinTotalPrice">1개당가격*갯수</span>
                    <div class="trade_button">
                        <a href="#" onclick="check_input()">
                            <p>거래</p>
                        </a>
                    </div>
                </div>


                </div>


            <div class="section marketTradesTable-div">
                <table>
                    <caption>Market Trades</caption>
                    <tr>
                        <th>Bid Size</th>
                        <th>Bid Size</th>
                        <th>Bid Size</th>

                    </tr>
                    <script>
                    async function getTransactionHistory(coin, callbackFunc) {
                        let transactionHistoryUrl = "https://api.bithumb.com/public/transaction_history/" +
                            coin;
                        let transactionHistoryResult
                        await fetch(transactionHistoryUrl, {
                                cache: "no-store"
                            })
                            .then(response => {
                                response.json().then((coin) => {
                                    callbackFunc(coin.data)
                                    console.log(coin.data)

                                })
                            })

                    }

                    function setTransactionHistoryData(array) {
                        const section = document.querySelectorAll(".marketTradesTable-div td")
                        let count = 19
                        for (let i = 0; i < section.length; i++) {
                            section[i].innerText = ""
                            if (i % 3 === 0) {
                                section[i].innerText = array[count].price
                            }

                            if (i % 3 === 1) {
                                section[i].innerText = array[count].total
                            }

                            if (i % 3 === 2) {
                                section[i].innerText = array[count--].transaction_date.substring(11, 19)

                            }
                        }
                    }
                    </script>

                    <script type="text/javascript">
                    let txt1 = 1
                    for (var j = 0; j < 20; j++) {
                        document.write("<tr>");
                        document.write("<td>" + txt1 + "</td>");
                        document.write("<td>" + txt1 + "</td>");
                        document.write("<td>" + txt1 + "</td>");
                    } //end for j
                    document.write("</tr>");
                    setInterval(() => {
                        getTransactionHistory("BTC", setTransactionHistoryData)
                    }, 1000);
                    </script>
                </table>
            </div>
            <div class="section coinTransactionDataTable-div">
                <table>
                    <caption>data</caption>
                    <tr>
                        <th>data</th>
                        <th>data</th>
                    </tr>



                </table>

            </div>

        </div>
    </div>
</body>

</html>
