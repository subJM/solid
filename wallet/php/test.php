 <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

    $sql = "SELECT * FROM coin_info";
    $result = mysqli_query($con, $sql);
    while ($row = @mysqli_fetch_assoc($result))
        print_r($row)
    ?>