let tradeStatus='buy';
const tab_li=document.querySelectorAll(".tradeSelect-tab li")
console.log(tab_li)
const colorCode = 'CCCCFF'
function buy_coin() {
    tradeStatus='buy';
    console.log(tab_li[0])
    tab_li[0].style.backgroundColor = colorCode
    tab_li[1].style.backgroundColor = white
}


function sell_coin() {
    tradeStatus='sell';
    console.log(tradeStatus)
    tab_li[0].style.backgroundColor = white
    tab_li[1].style.backgroundColor = colorCode
}

function trade() {
    if (tradeStatus===buy) {
        //db에무언가?
    }else{

    }
}

