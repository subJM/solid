let closing_price;
let currentPrice;
let totalPrice;

async function getTickerData(coinName, callbackFunc) {
    let orderBookUrl = "./getData/getTicker.php"
    await fetch(orderBookUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then(coinData=>{
                callbackFunc(coinData.data[coinName]);
            })
        })
}
function setTickerData(coinData) {
    let section = document.querySelectorAll(".coinTransactionDataTable-div td")
    let count=0
    for (let key in coinData) {
        if (count % 2 === 0) {
            section[count++].innerText = key
        }

        if (count % 2 === 1) {
            section[count++].innerText = coinData[key]
        }
    }

    closing_price=coinData['closing_price']
}



async function getOrderBook(coinName,  callbackFunc) {
    let orderBookUrl = "./getData/getOrderBook.php?name="+coinName
    await fetch(orderBookUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then(coinData=>{
                callbackFunc(coinData.data)
            })
        })
}

function setOrderBookData(array) {
    const section = document.querySelectorAll(".orderbook-div td")
    let count = 29
    for (let i = 0; i < section.length; i++) {
        section[i].innerText = ""
        if (i % 4 === 0) {
            section[i].innerText = array['bids'][count].quantity
        }

        if (i % 4 === 1) {
            section[i].innerText = array['bids'][count].price
        }

        if (i % 4 === 2) {
            section[i].innerText = array['bids'][count].price
        }
         if (i % 4 === 3) {
            section[i].innerText = array['bids'][count--].quantity
        }
    }
}

async function getTransactionHistory(coinName, callbackFunc) {
    let transactionHistoryUrl =  "./getData/getTransaction.php?name="+coinName;
    await fetch(transactionHistoryUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then((coin) => {
                callbackFunc(coin.data)
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

    if (array.length!=0) {
        
    const currentPrice_span = document.querySelectorAll("span")
    currentPrice = array[0].price
    changeAmount()

    currentPrice_span[1].innerText= currentPrice
    let rate = parseInt(closing_price/currentPrice*100)/100
    let ascent_rate = rate>0 ? '+'+rate : '-'+rate
    currentPrice_span[2].innerText= ascent_rate+'%'
  
    }

    



}

function changeAmount() {
    const coinTotalPrice = document.querySelectorAll(".coinTotalPrice")
    const coinAmount = document.querySelectorAll("#amount")
    totalPrice=coinAmount[0].value*currentPrice
    coinTotalPrice[0].innerText=totalPrice
}