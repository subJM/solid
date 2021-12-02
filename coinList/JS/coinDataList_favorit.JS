
let coinNameCount=20;
let coin_price_map = new Map();
let closing_price_map = new Map();


async function getTickerList_favoritData() {
    let tickerUrl = "../coin/getData/getTicker.php"
    await fetch(tickerUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then(coinData=>{
                setCoinList_favoritTicker(coinData.data);
            })
        })
}

function setCoinList_favoritTicker(coinData) {
    const section = document.querySelectorAll(".coinList-div td")
    let count=0
    
    for(let i=0; i<section.length; i++){
        if (i % 4 === 0) {
            section[i].innerText = favorit_coinName[count];
        }

        if (i % 4 === 1) {
            closing_price_map.set(favorit_coinName[count], coinData[favorit_coinName[count]]['prev_closing_price']);
            section[i].innerText = coinData[favorit_coinName[count++]]['units_traded_24H'];
        }
    }

    getTransaction_favorit()
    const section_tr = document.querySelectorAll(".coinList-div tr")
    for (let i = 1; i < section_tr.length; i++) {
        section_tr[i].addEventListener('click', function() {
            location.href = "../coin/coin.php?coinName="+favorit_coinName[i-1];
        })
    }                  
}

function getTransaction_favorit() {
    for (let i=0; i < favorit_coinName.length; i++){
        getTransactionHistory_favorit(favorit_coinName[i])
    }
}

async function getTransactionHistory_favorit(favorit_coinName) {
    let transactionHistoryUrl =  "../coin/getData/getTransaction.php?name="+favorit_coinName;
    await fetch(transactionHistoryUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then((coinData) => {
                if (coinData.data!=null){
                    coin_price_map.set(favorit_coinName, coinData.data[0].price)
                }
                setTransactionHistory_favoritData()
            })
        })
}


function setTransactionHistory_favoritData() {
    const section = document.querySelectorAll(".coinList-div td")
    let count=0;
    for (let i = 0; i < section.length; i++) {

        if (i % 4 === 2) {
            section[i].innerText=coin_price_map.get(favorit_coinName[count])
        }

        if (i % 4 === 3) {
            let closing_price=closing_price_map.get(favorit_coinName[count]);
            let currentPrice = coin_price_map.get(favorit_coinName[count++])

            let rate =  parseInt(((closing_price - currentPrice) / closing_price) * 10000)/100
            let ascent_rate = rate>0 ? '+'+rate : rate
            section[i].innerText= ascent_rate+'%'
        }
    }
}


