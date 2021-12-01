<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./JS/coinDataList.JS"></script>
    <script>


        getTickerListData();
        getTransaction();


         setInterval(() => {
            getTickerListData();
            getTransaction();
         }, 6000);



    </script>
</head>
<body>
   <div class="coinList-div">
       <table>
           <tr>
                <th>Name</th>
                <th>24h Volume</th>
                <th>Price</th>
                <th>Daily Change</th>

                <script type="text/javascript">
                        for (let j = 0; j < 180; j++) {
                            let txt = 1;
                            document.write("<tr>");
                            document.write("<td>" + txt + "</td>");
                            document.write("<td>" + txt + "</td>");
                            document.write("<td>" + txt + "</td>");
                            document.write("<td>" + txt + "</td>");
                            document.write("</tr>");
                        }


                </script>

           </tr>
       </table>
   </div>
</body>
</html>
