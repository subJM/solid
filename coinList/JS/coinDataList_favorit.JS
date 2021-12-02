
let coinNameCount=20;
let coin_price_map = new Map();
let closing_price_map = new Map();
let count=0


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
    console.log(section);
    let count=0
    for(let i=0; i<section.length; i++){
        if (i % 4 === 0) {
            section[i].innerText = coinName[count]
        }

        if (i % 4 === 1) {
            closing_price_map.set(coinName[count], coinData[coinName[count]]['prev_closing_price']);
            section[i].innerText = coinData[coinName[count++]]['units_traded_24H'];
        }
    }

    getTransaction_favorit()
    const section_tr = document.querySelectorAll(".coinList-div tr")
    for (let i = 1; i < section_tr.length; i++) {
        section_tr[i].addEventListener('click', function() {
            console.log(coinName[i-1]);
            location.href = "../coin/coin.php?coinName="+coinName[i-1];
        })
    }                  
}

function getTransaction_favorit() {
    for (let i=0; i < coinName.length; i++){
        getTransactionHistory_favorit(coinName[i])
    }
}

async function getTransactionHistory_favorit(coinName) {
    let transactionHistoryUrl =  "../coin/getData/getTransaction.php?name="+coinName;
    await fetch(transactionHistoryUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then((coinData) => {
                if (coinData.data!=null){
                    coin_price_map.set(coinName, coinData.data[0].price)
                }

                count++
                if (count==30||count==180) {
                    setTransactionHistory_favoritData()
                    count=0;
                }
            })
        })
}


function setTransactionHistory_favoritData() {
    const section = document.querySelectorAll(".coinList-div td")
    let count=0;
    for (let i = 0; i < section.length; i++) {

        if (i % 4 === 2) {
            section[i].innerText=coin_price_map.get(coinName[count])
        }

        if (i % 4 === 3) {
            let closing_price=closing_price_map.get(coinName[count]);
            let currentPrice = coin_price_map.get(coinName[count++])

            let rate =  parseInt(((closing_price - currentPrice) / closing_price) * 10000)/100
            let ascent_rate = rate>0 ? '+'+rate : rate
            section[i].innerText= ascent_rate+'%'

        }
    }
}





// async function getCoinName() {
//     let tickerUrl = "../coin/getData/getTicker.php"
//     await fetch(tickerUrl, {
//             cache: "no-store",
//             headers: {
//                  'Content-Type': 'application/json; charset=utf-8'
//              }
//         })
//         .then(response => {
//             response.json().then(coinData=>{
//                 coinName = Object.keys(coinData); 
//             })
//         })
// }

// async function getListdata() {
//     for (let i = 0; i < coinName.length; i++) {
//         let tickerUrl = "../coin/getData/getListData.php?name"+coinName[i]
//         await fetch(tickerUrl, {
//                 cache: "no-store",
//                 headers: {
//                      'Content-Type': 'application/json; charset=utf-8'
//                  }
//             })
//             .then(response => {
//                 response.json().then(coinData=>{
//                     console.log(coinData);
//                     coin_price_map.set(coinName, coinData)
//                 })
//             })
        
//     }
// }

// function setListData(coinData) {
    
// }