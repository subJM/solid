<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solid</title>
    <style>
    table {
        border-top: 1px solid #444444;
        border-collapse: collapse;
    }

    tr {
        border-bottom: 1px solid #444444;
        padding: 10px;
    }

    td {
        border-bottom: 1px solid #efefef;
        padding: 10px;
    }

    table .even {
        background: #efefef;
    }

    .text {
        text-align: center;
        padding-top: 20px;
        color: #000000
    }

    .text:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    a:link {
        color: #57A0EE;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    td:hover {
        cursor: pointer;
    }

    button {
        font-size: 15px;
    }
    </style>
</head>

<body>

    <h1 align=center>공지사항</h1>
    <table align="center">
        <thead align="center">
            <tr>
                <td width="50" align="center">번호</td>
                <td width="500" align="center">제목</td>
                <td width="100" align="center">작성자</td>
                <td width="200" align="center">날짜</td>
                <td width="50" align="center">조회수</td>
            </tr>

            <tr>
                <td width="50" align="center">1</td>
                <td width="500" align="center">Solid Coin</td>
                <td width="100" align="center">이성일</td>
                <td width="200" align="center">2021.11.20</td>
                <td width="50" align="center">0</td>
            </tr>

            <tr>
                <td width="50" align="center">2</td>
                <td width="500" align="center">거래소 현황</td>
                <td width="100" align="center">손종민</td>
                <td width="200" align="center">2021.11.20</td>
                <td width="50" align="center">513</td>
            </tr>
        </thead>

        <tbody>
        </tbody>
    </table>

    <div class=text>
        <button onClick="location.href='./typing.html'">글쓰기</button>
    </div>
</body>

</html>