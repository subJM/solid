async function getTickerData(coinName, callbackFunc) {
    let orderBookUrl = "getTicker.php"
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
}



async function getOrderBook(coinName,  callbackFunc) {
    let orderBookUrl = "getOrderBook.php?name="+coinName
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
    let transactionHistoryUrl =  "getTransaction.php?name="+coinName;
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
}

setInterval(() => {
    getTransactionHistory(coinName, setTransactionHistoryData)
    getOrderBook(coinName, setOrderBookData)
    getTickerData(coinName, setTickerData)
}, 1000);