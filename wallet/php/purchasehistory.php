<!DOCTYPE html>
<html lang="ko-kr">

<head>
  <title>CSS Website Layout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../solid/WebContents/css/bootstrap.css">
  <script type=" text/javascript" src="/WebContents/js/bootstrap.js">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="/resource/js/bootstrap.js"></script>
  <style>
  @import url('https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css');

  * {
    box-sizing: border-box;
    font-family: NanumSquare, sans-serif;
  }

  body {
    line-height: normal;
    font-family: spoqa han sans, noto sans kr, noto sans kr ie, apple sd gothic neo, 맑은 고딕, malgun gothic, sans-serif;
    font-size: 14px;
    color: #18191c;
    margin: 0;

  }

  /* Style the top navigation bar */
  .topnav {
    overflow: visible;
    background-color: #333;
    height: 60px;
    line-height: 60px;
  }

  /* Style the topnav links */
  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 0px 16px;
    text-decoration: none;
  }

  /* Change color on hover */
  .topnav a:hover {
    background-color: #ddd;
    color: black;
  }

  .footer {
    background-color: #f1f1f1;
    padding: 10px;
    text-align: center;
  }

  .row {
    display: block;
    height: 100%;
    margin-left: 80px;
    margin-right: 80px;
    padding-top: 16px;
    padding-bottom: 32px;
    margin-top: 50px;
  }

  .row_container {
    display: flex;
    width: 1280px;
    height: 1240px;
    margin: 0 auto;
  }

  .column_side {
    width: 200px;
    border-right: 1px solid #e6e6e6;
  }

  .column_middle {
    width: 1080px;
    min-width: 1080px;
  }

  .middle_container {
    width: 1025px;
    height: 100%;
    margin-left: 5%;
  }

  ul {
    padding: 0;
    list-style: none;
  }

  li {
    font-size: 20px;
    font-family: sans-serif;
    font-weight: bold;
    color: grey;
    margin-bottom: 30px;
  }

  li:hover {
    color: black;

  }

  .side_list_container {
    width: 200px;
  }

  button {
    background-color: transparent;
    border: transparent;
    font-size: 20px;
    font-family: sans-serif;
    font-weight: bold;
    padding: 0;
    color: #b3b3b3;
  }

  button:hover {
    color: black;
  }

  button:focus {
    color: rgb(0, 89, 255);
  }

  .middle_overall {
    width: 1025px;
    min-width: 1025px;
    height: 120px;
    display: flex;
    align-items: center;
    border-top: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 50px;
  }

  .overall_1 {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 360px;
    height: 65px;
  }

  .overall_1_2 {
    font-size: 36px;
    font-weight: 500;
  }

  .overall_2 {
    width: 720px;
    height: fit-content;
    display: flex;
    padding: 0;
    align-items: center;
  }

  .overall_2_1 {
    width: 360px;
    height: 65px;
    text-align: center;
    display: flex;
    flex-direction: column;
    padding-left: 20px;
    padding-right: 20px;
    justify-content: space-between;
  }

  .overall_2_1_1 {
    padding: 0;
    margin-bottom: 7px;
  }

  .tag_1 {
    float: left;
    font-size: 15px;
  }

  .tag_2 {
    float: left;
  }

  .value_1 {
    float: right;
    font-size: 23px;
  }

  .value_2 {
    float: right;
  }

  .value_3 {
    float: right;
  }

  .main_name {
    font-weight: bolder;
    font-family: sans-serif;
    margin-bottom: 20px;
  }

  .middle_container_name {
    margin-bottom: 40px;
  }

  .table_comment {
    margin-bottom: 10px;
    font-size: 13px;
  }

  td {
    text-align: right;
    color: #18191c;
  }

  .col_r {
    text-align: right;
  }

  .td_l {
    text-align: left;
  }
  </style>
</head>

<body>
  <header class="header">
    <div class="topnav">
      <a href="#">Link</a>
      <a href="#">Link</a>
      <a href="#">Link</a>
    </div>
  </header>
  <div class="row">
    <div class="row_container">
      <div class="column_side">
        <div class="side_list_container">
          <ul>
            <li><button>수익현황</button></li>
            <li><button>이용내역</button></li>
          </ul>
        </div>
      </div>
      <div class=" column_middle">
        <div class="middle_container">
          <div class="middle_container_name">
            <h2 class="main_name">이용내역</h2>
          </div>
          <div class="table_comment">매수평균가, 평가금액, 평가손익, 수익률은 모두 KRW로 환산한 추정 값으로 참고용입니다</div>
          <div>
            <table class="table">
              <thead class="table-light">
                <tr>
                  <th scope="col">시간</th>
                  <th class="col_r">마켓</th>
                  <th class="col_r">코인</th>
                  <th class="col_r">거래</th>
                  <th class="col_r">주문 및 체결</th>
                  <th class="col_r">체결량</th>
                  <th class="col_r">체결가</th>
                  <th class="col_r">거래금액</th>
                  <th class="col_r">수수료</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="td_l"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="td_l"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="td_l"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="footer">
    <p>Footer</p>
  </div>

</body>

</html>