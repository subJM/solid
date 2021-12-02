let coinName=0;
let coin_price_map = new Map();
let closing_price_map = new Map();
let count=0;
async function getTickerListData() {
    let tickerUrl = "../coin/getData/getTicker.php"
    await fetch(tickerUrl, {
            cache: "no-store",
            headers: {
                 'Content-Type': 'application/json; charset=utf-8'
             }
        })
        .then(response => {
            response.json().then(coinData=>{
                setCoinListTicker(coinData.data);
                
            })
        })
}

function setCoinListTicker(coinData) {
    const section = document.querySelectorAll("#coinListTable td")
    let count=0
    console.log(section+'?');
    coinName = Object.keys(coinData);  
  
    for(let i=0; i<section.length; i++){
     
        if (i % 4 === 0) {
           
            section[i].innerText = coinName[count]
           
        }

        if (i % 4 === 1) {
           
            closing_price_map.set(coinName[count], coinData[coinName[count]]['prev_closing_price']);
            section[i].innerText = coinData[coinName[count++]]['units_traded_24H'];
        }
    }

    getTransaction()
    const section_tr =  document.querySelectorAll("#coinListTable tr")
    for (let i = 1; i < section_tr.length; i++) {
        section_tr[i].addEventListener('click', function() {
            console.log(coinName[i-1]);
            location.href = "../coin/coin.php?coinName="+coinName[i-1];
        })
    }                  
}

function getTransaction() {
    for (let i=0; i < coinName.length/3; i++){
        getTransactionHistory(coinName[i])
    }
}

async function getTransactionHistory(coinName) {
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
                if (count==20||count==60) {
                    setTransactionHistoryData()
                    count=0;
                }
            })
        })
}


function setTransactionHistoryData() {
    const section =  document.querySelectorAll("#coinListTable td")
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





