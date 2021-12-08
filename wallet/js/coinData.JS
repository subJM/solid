let coin_price_map = new Map();
let count = 0;

function getTransactions(coinName) {
  for (let i = 0; i < coinName.length; i++) {
    getTransactionHistory(coinName[i]);
  }
}

async function getTransactionHistory(coinName) {
  let transactionHistoryUrl =
    "../../coin/getData/getTransaction.php?name=" + coinName;
  await fetch(transactionHistoryUrl, {
    cache: "no-store",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
  }).then((response) => {
    response.json().then((coinData) => {
      if (coinData.data != null) {
        coin_price_map.set(coinName, coinData.data[0].price);
      }

      count++;
      setTransactionHistoryData();
      if (count == 20) {
        count = 0;
      }
    });
  });
}

function setTransactionHistoryData() {
  const section = document.querySelectorAll("table td");
  let coinName = 0;
  let amount = 0;
  let avgPrice = 0;
  let totalValue1 = 0;
  var totalValue = new Array();

  for (let i = 0; i < section.length; i++) {
    if (i % 5 === 0) {
      coinName = section[i].innerText;
    }
    if (i % 5 === 1) {
      amount = section[i].innerText;
    }
    if (i % 5 === 2) {
      avgPrice = section[i].innerText;
    }
    if (i % 5 === 3) {
      section[i].innerText = amount * coin_price_map.get(coinName);
      totalValue[i] = i;
      totalValue[i] = parseInt(section[i].innerText);
      totalValue1 += totalValue[i];
      document.getElementById("totalValue").innerHTML = AddComma(
        totalValue1 + "원"
      );
    }
    if (i % 5 === 4) {
      avgPrice = avgPrice.replace(/,/g, "");
      console.log(avgPrice + "///" + coin_price_map.get(coinName));
      section[i].innerText =
        parseInt(
          ((amount * coin_price_map.get(coinName) - avgPrice * amount) /
            avgPrice) *
            1000
        ) /
          100 +
        "%";
    }
  }
}

function AddComma(num) {
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  return num.toString().replace(regexp, ",");
}
