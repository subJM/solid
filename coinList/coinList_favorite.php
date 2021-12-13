<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/img/solid_icon.svg">
  <link rel="stylesheet" href="./css/coinlist.css">
  <title>No.1 가상자산 플랫폼, Solid</title>
  <script>
  <?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/solid/coinList/DB/favorite.php";?>
  </script>
  <script src="./JS/coinDataList_favorite.JS"></script>
  <script>
  getTickerList_favoriteData();
  getTransaction_favorite();

  setInterval(() => {
    getTickerList_favoriteData();
    getTransaction_favorite();
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
        for (let j = 0; j < favorite_coinName.length; j++) {
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