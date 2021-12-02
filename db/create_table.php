<?php
function create_table($con, $table_name)
{
    $flag = false;
    $sql = "show tables from solid";
    $result = mysqli_query($con, $sql) or die('Error' . mysqli_error($con));

    //반복문을 통해서 레코드셋에서 한 레코드씩 가져와서 첫번째 필드내용을 조사해서 해당된 테이블명이 있는지 확인한다.
    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] === "$table_name") {
            $flag = true;
            break;
        }
    }

    //해당된 테이블이 없으면 해당 테이블명을 찾아서 테이블 쿼리문을 작성한다.
    if ($flag === false) {
        switch ($table_name) {
            case 'members':
                $sql = "CREATE TABLE `members` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `password` char(100) NOT NULL,
                    `name` char(10) NOT NULL,
                    `phone` char(13) NOT NULL,
                    `email` char(80) DEFAULT NULL,
                    `address` char(50) DEFAULT NULL,
                    `regist_day` char(20) NOT NULL,
                    `level` int(11) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;";
                break;
            case 'deleted_members':
                $sql = "CREATE TABLE `deleted_members` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `password` char(100) NOT NULL,
                    `name` char(10) NOT NULL,
                    `phone` char(13) NOT NULL,
                    `email` char(80) DEFAULT NULL,
                    `address` char(50) DEFAULT NULL,
                    `regist_day` char(20) NOT NULL,
                    `level` int(11) DEFAULT NULL,
                    `deleted_date` date,
                    PRIMARY KEY (`num`)
                  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;";
                break;
                //코인 데이타
            case 'coin_info':
                  $sql = "CREATE TABLE `coin_info` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `coinName` char(15) NOT NULL,
                    `trTime` char(15) NOT NULL,
                    `transaction` char(20) NOT NULL,
                    `price` int(20) NOT NULL,
                    `amount` int(20) DEFAULT NULL,
                    `totalPrice` int(20) DEFAULT NULL,
                    `bank` int(20) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  break;
                  //포인트 결제내역
                  case 'recruit_plan' :
                    $sql = "CREATE TABLE `recruit_plan` (
                      `num` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                      `count` int(10) unsigned NOT NULL,
                      `price` int(7) NOT NULL,
                      PRIMARY KEY (`num`),
                      UNIQUE KEY `name` (`name`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
                    break;
                  //포인트 구매
                  case 'purchase' :
                    $sql = "CREATE TABLE `purchase` (
                      `num` int(11) NOT NULL AUTO_INCREMENT,
                      `date` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                      `member_id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                      `plan_num` tinyint(3) NOT NULL,
                      `plan_name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                      `available_count` int(10) unsigned NOT NULL,
                      `price` int(7) NOT NULL,
                      `method` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                      PRIMARY KEY (`num`)
                      ) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
                    break;      
                  //코인 즐겨찾기
            case 'favorite_coin':
                  $sql = "CREATE TABLE `favorite_coin` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `coinName` char(15) NOT NULL,
                    PRIMARY KEY (`num`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  break;
                   //즐겨찾기
            case 'notice':
                $sql = "CREATE TABLE `notice` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `name` char(10) NOT NULL,
                    `subject` char(200) NOT NULL,
                    `content` text NOT NULL,
                    `regist_day` char(20) NOT NULL,
                    `hit` int(11) NOT NULL,
                    `file_name` char(40) DEFAULT NULL,
                    `file_type` char(40) DEFAULT NULL,
                    `file_copied` char(40) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            //종목 게시판  코인 종목마다 게시판    
            case 'review':
                $sql = "CREATE TABLE `review` (
                  `no` int(11) NOT NULL AUTO_INCREMENT,
                  `hospital_id` char(10) NOT NULL,
                  `member_num` int(11) NOT NULL,
                  `star_rating` int(1) NOT NULL,
                  `kindness` int(1) NOT NULL,
                  `wait_time` int(1) NOT NULL,
                  `expense` int(1) NOT NULL,
                  `comment` text NOT NULL,
                  `regist_day` char(20) NOT NULL,
                  PRIMARY KEY (`no`)
                ) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;";
                break;
            
                //자유게시판
            case 'free':
                $sql = "CREATE TABLE `free` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `subject` char(200) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) NOT NULL,
                  `hit` int(11) NOT NULL,
                  `file_name_0` char(40) DEFAULT NULL,
                  `file_type_0` char(40) DEFAULT NULL,
                  `file_copied_0` char(40) DEFAULT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                //자유게시판 리플 테이블
            case 'free_ripple':
                $sql = "CREATE TABLE `free_ripple` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `parent` int(11) NOT NULL,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) DEFAULT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                //faq 테이블
            case 'faq':
                $sql = "CREATE TABLE `faq` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `subject` char(200) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) NOT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                //faq 리플테이블
            case 'faq_ripple':
                $sql = "CREATE TABLE `faq_ripple` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `parent` int(11) NOT NULL,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) DEFAULT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                //질문자 게시판
            case 'question':
                $sql = "CREATE TABLE `question` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `subject` char(200) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) NOT NULL,
                  `hit` int(11) NOT NULL,
                  `file_name_0` char(40) DEFAULT NULL,
                  `file_type_0` char(40) DEFAULT NULL,
                  `file_copied_0` char(40) DEFAULT NULL,
                  `read_pw` int(4) NOT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                //질문자 게시판 리플 테이블
            case 'question_ripple':
                $sql = "CREATE TABLE `question_ripple` (
                  `num` int(11) NOT NULL AUTO_INCREMENT,
                  `parent` int(11) NOT NULL,
                  `id` char(15) NOT NULL,
                  `name` char(10) NOT NULL,
                  `content` text NOT NULL,
                  `regist_day` char(20) DEFAULT NULL,
                  PRIMARY KEY (`num`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
            case 'memo':
                $sql = "CREATE TABLE IF NOT EXISTS 'memo' (
                  me_id int(11) NOT NULL AUTO_INCREMENT,
                  me_recv_mb_id varchar(20) NOT NULL DEFAULT '',
                  me_send_mb_id varchar(20) NOT NULL DEFAULT '',
                  me_send_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  me_read_datetime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  me_memo text NOT NULL,
                  PRIMARY KEY (me_id),
                  KEY me_recv_mb_id (me_recv_mb_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
            
            default:
                echo "<script>alert('해당테이블명이 없습니다. 점검요망!');</script>";
                break;
        } //end of switch
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('{$table_name} 테이블이 생성되었습니다.');</script>";
        } else {
            // echo "테이블 생성 실패원인" . mysqli_error($con);
        }
    } //end of if($flag)
}
?>