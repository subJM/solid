<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        <?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/coinList/DB/favorit.php";?>
    </script>
    <script src="./JS/coinDataList_favorit.JS?1"></script>
    <script>
        getTickerList_favoritData();
        getTransaction_favorit();

        setInterval(() => {
            getTickerList_favoritData();
            getTransaction_favorit();
         }, 1000);
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
                        for (let j = 0; j < favorit_coinName.length; j++) {
                            let txt = 1;
                            document.write("<tr>");
                            document.write("<td>" + 1 + "</td>");
                            document.write("<td>" + 1 + "</td>");
                            document.write("<td>" + 1 + "</td>");
                            document.write("<td>" + 1 + "</td>");
                            document.write("</tr>");
                        }


                </script>

           </tr>
       </table>
   </div>
</body>
</html>
