<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_statement.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDmain.css?.afkqder">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDfooter.css?.addd">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/Solid Css/SOLIDheader.css?.5dda">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/solid/coinList/css/coinlist.css">

  <script src="http://<?=$_SERVER['HTTP_HOST']?>/solid/coinList/JS/coinDataList.JS"></script>
  <script>
  getTickerListData();
  getTransaction();
  setInterval(() => {
    getTickerListData();
    getTransaction();
  }, 3000);
  </script>
</head>

<body>
  <div class="container">
    <header>
      <?php include "../header.php";?>
    </header>
    <section id="coinList">
      <div id="coinListTable">
        <div id="marketDiv">
          <span id="markets">거래소</span>
        </div>
        <table>
          <tr>
            <th>Name</th>
            <th>24h Volume</th>
            <th>Price</th>
            <th>Daily Change</th>

            <script type="text/javascript">
            for (let j = 0; j < 60; j++) {
              let txt = 1;
              document.write("<tr>");
              document.write("<td>" + j * 1000 + "</td>"); //name왼쪽
              document.write("<td>" + j * 1000 + "</td>");
              document.write("<td>" + j * 1000 + "</td>");
              document.write("<td>" + j * 1000 + "</td>");
              document.write("</tr>");
            }
            </script>
          </tr>
        </table>
      </div>
    </section>
    <footer>
      <?php include "../footer.php";?>
    </footer>
  </div>
</body>

</html>