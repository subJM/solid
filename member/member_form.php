<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";

    // 카카오 로그인버튼 누른 후 회원가입 폼으로 들어온것인지 판별
    if (isset($_POST["hidden_kakao_name"])) {
        $hidden_kakao_name = $_POST["hidden_kakao_name"];
    } else {
        $hidden_kakao_name = "";
    }

    if (isset($_POST["hidden_kakao_email"])) {
        $hidden_kakao_email = $_POST["hidden_kakao_email"];
        $hidden_kakao_email = explode("@", $hidden_kakao_email);
        $hidden_kakao_email_one = $hidden_kakao_email[0];
        $hidden_kakao_email_two = $hidden_kakao_email[1];
    } else {
        $hidden_kakao_email = "";
    }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>No.1 가상자산 플랫폼, Solid</title>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css?sad">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXfooter.css?a">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXheader.css?asd">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/css/member.css">
    <script src="./js/member_form.js" charset="utf-8"></script>
    <link rel="stylesheet" href="./css/member.css?asd">
    <!-- <link rel="stylesheet" href="./css/mypage.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <script src="./js/mypage.js" defer></script>
    <!-- 우편번호 api 참조 스크립트 -->
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <!-- 네이버 아이디로 로그인 api 참조 스크립트 -->
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8">
    </script>

    <script>
    //전화번호 최대길이
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength) {
            object.value = object.value.slice(0, object.maxLength);
        }
    }

    // 우편번호 api
    function address_input() {
        new daum
            .Postcode({
                oncomplete: function(data) {
                    document
                        .getElementById("address_one")
                        .value = data.zonecode;
                    document
                        .getElementById("address_two")
                        .value = data.roadAddress;
                }
            })
            .open();
    }

    // 이메일 주소 선택시 세팅해주기
    function mail_address_setting(e) {
        document
            .getElementById("email_two")
            .value = e.value;
        document
            .getElementById("email_two")
            .focus();
    }

    // 가입버튼 눌렀을 때
    function action_signup() {
        alert("가입번튼");
        document.member_form.action = "member_data.php";
        document.member_form.submit();
    }

    function action_update() {
        document.member_form.action = "member_data.php?type=update";
        document
            .member_form
            .submit();
    }

    function signup_duplicate_check() {
        console.log("signup_duplicate_check");
        var input_name = $("#input_name"),
            email_one = $("#email_one"),
            email_two = $("#email_two");

        var name_value = input_name.val(),
            email_one_value = email_one.val();
        email_two_value = email_two.val();

        $.ajax({
                url: '../login/forgot_id_pw_check.php',
                type: 'POST',
                data: {
                    "find_type": "signup_duplicate_check",
                    "input_name": name_value,
                    "email_one": email_one_value,
                    "email_two": email_two_value
                },
                success: function(data) {
                    console.log(data);
                    if (data === "ok") {} else {
                        console.log("function");
                        alert("이미 가입하신 내용이 있습니다. 아이디는 " + data + " 입니다.");
                        document.member_form.action = "../login/kakao_login.php?id=" + data;
                        document
                            .member_form
                            .submit();
                    }
                }
            })
            .done(function() {
                console.log("done");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    }
    </script>
    <script type="text/javascript">
    var naver_id_login = new naver_id_login("kqhyCKEnsQrOw5wB5Tob",
        "http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php");
    // 접근 토큰 값 출력 alert(naver_id_login.oauthParams.access_token); 네이버 사용자 프로필 조회
    if (naver_id_login.is_callback == true) {
        naver_id_login.get_naver_userprofile("naverSignInCallback()");
    }

    // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
    function naverSignInCallback() {
        // alert(naver_id_login.getProfileData('email'));
        // alert(naver_id_login.getProfileData('name'));

        var naver_name = naver_id_login.getProfileData('name');
        var naver_email = naver_id_login.getProfileData('email');
        var naver_email_arr = naver_email.split('@');

        document
            .getElementById("input_name")
            .value = naver_name;
        document
            .getElementById("input_name")
            .focus();
        document
            .getElementById("email_one")
            .value = naver_email_arr[0];
        document
            .getElementById("email_one")
            .focus();
        document
            .getElementById("email_two")
            .value = naver_email_arr[1];
        document
            .getElementById("email_two")
            .focus();

        console.log("signup_duplicate_check");

        var name_value = naver_name,
            email_one_value = naver_email_arr[0];
        email_two_value = naver_email_arr[1];

        $.ajax({
                url: '../login/forgot_id_pw_check.php',
                type: 'POST',
                data: {
                    "find_type": "signup_duplicate_check",
                    "input_name": name_value,
                    "email_one": email_one_value,
                    "email_two": email_two_value
                },
                success: function(data) {
                    console.log(data);
                    if (data === "ok") {} else {
                        alert("이미 가입하신 내용이 있습니다. 아이디는 " + data + " 입니다.");
                        document.member_form.action = "../login/kakao_login.php?id=" + data;
                        document
                            .member_form
                            .submit();
                    }
                }
            })
            .done(function() {
                console.log("done");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        history.pushState(null, null, "http://<?= $_SERVER['HTTP_HOST'] ?>/solid/member/member_form.php");
    })
    </script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
    </header>
    <section id="member_section">
        <?php
                // 내 정보 수정인지 판별
                if (isset($_GET["mode"])) {
                    $mode = $_GET["mode"];

                    $sql = "select * from members where id='$userid'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                    $name = $row["name"];
                    $password = $row["password"];

                    $phone = $row["phone"];
                    $phone = explode("-", $row["phone"]);
                    $phone1 = (int)$phone[0];
                    $phone2 = (int)$phone[1];
                    $phone3 = (int)$phone[2];

                    $email = explode("@", $row["email"]);
                    $email1 = $email[0];
                    $email2 = $email[1];

                    $address = $row["address"];
                    $address = explode("$", $row["address"]);
                    $address1 = $address[0];
                    $address2 = $address[1];
                    $address3 = $address[2];

                    $_POST['mode'] = 'modify';
                    $_POST['category'] = 'member';
                    
                } else {
                    $mode = "";
                }
                if ($mode === "") {
                    if ($userid) {
                        // alert_back("잘못된 접근입니다");
                    }
                    ?>
        <div id="title_member">
            <h1>회원가입</h1>
        </div>
        <?php
                } else {
                    ?>
        <div class="content_title">
            <h1> 내 정보 수정</h1>
        </div>
        <?php
                }
            ?>
        <div id="member_main_content">
            <div id="member_form">
                <form name="member_form" id="input_member_form" method="post">
                    <?php
                            if ($mode === "") {
                                ?>
                    <input autocomplete="off" type="text" name="id" id="input_id" placeholder=" 아이디 입력 ">
                    <br>
                    <p id="input_id_confirm"></p>
                    <input type="password" name="password" id="input_password" placeholder=" 비밀번호 입력 ">
                    <br>
                    <p id="input_password_confirm"></p>
                    <input type="password" id="input_password_check" placeholder=" 비밀번호 재입력 ">
                    <br>
                    <p id="input_password_check_confirm"></p>
                    <?php
                            } else {
                                ?>
                    <input autocomplete="off" type="text" name="id" id="input_id" value="<?= $userid ?>"
                        readonly="readonly">
                    <br>
                    <p id="input_id_confirm"></p>
                    <input type="password" name="password" id="input_password" value="<?= $password ?>">
                    <br>
                    <p id="input_password_confirm"></p>
                    <input type="password" id="input_password_check" value="<?= $password ?>">
                    <br>
                    <p id="input_password_check_confirm"></p>
                    <?php
                            }
                        ?>

                    <?php
                            if ($hidden_kakao_name) {
                                ?>
                    <input autocomplete="off" type="text" name="name" id="input_name" value=<?= $hidden_kakao_name ?>
                        readonly>
                    <br>
                    <?php
                            } else if ($mode) {
                                ?>
                    <input autocomplete="off" type="text" name="name" id="input_name" value="<?= $name ?>">
                    <br>
                    <?php
                            } else {
                                ?>
                    <input autocomplete="off" type="text" name="name" id="input_name" placeholder=" 이름 입력 ">
                    <br>
                    <?php
                            }
                        ?>
                    <p id="input_name_confirm"></p>

                    <div id="phone">
                        <div id="phone_input">
                            <?php
                                    if ($mode === "") {
                                        ?>
                            <select name="phone_one" id="phone_one">
                                <option value="010" selected="selected">010</option>
                                <option value="011">011</option>
                            </select>
                            -
                            <input autocomplete="off" type="text" name="phone_two" id="phone_two" placeholder=" 0000 "
                                maxlength="4" oninput="maxLengthCheck(this);">
                            -
                            <input autocomplete="off" type="text" name="phone_three" id="phone_three"
                                placeholder=" 0000 " maxlength="4" oninput="maxLengthCheck(this);">
                            <?php
                                    } else {
                                        ?>
                            <select name="phone_one" id="phone_one" value="<?= $phone1 ?>">
                                <option value="010">010</option>
                                <option value="011">011</option>
                            </select>
                            -
                            <input autocomplete="off" type="text" name="phone_two" id="phone_two" maxlength="4"
                                onkeyup="max_length_check(this)" value="<?= $phone2 ?>">
                            -
                            <input autocomplete="off" type="text" name="phone_three" id="phone_three" maxlength="4"
                                onkeyup="max_length_check(this)" value="<?= $phone3 ?>">
                            <?php
                                    }
                                ?>
                        </div>

                        <div id="email">
                            <div id="email_input">
                                <?php
                                    if ($hidden_kakao_email) {
                                        ?>
                                <input autocomplete="off" type="text" name="email_one" id="email_one"
                                    value="<?= $hidden_kakao_email_one ?>" readonly>
                                @
                                <input autocomplete="off" type="text" name="email_two" id="email_two"
                                    value="<?= $hidden_kakao_email_two ?>" readonly>
                                <script type="text/javascript">
                                signup_duplicate_check();
                                </script>
                                <?php
                                        } else if ($mode) {
                                    ?>
                                <input autocomplete="off" type="text" name="email_one" id="email_one"
                                    value="<?= $email1 ?>">
                                @
                                <input autocomplete="off" type="text" name="email_two" id="email_two"
                                    value="<?= $email2 ?>">
                                <?php
                                    } else {
                                        ?>
                                <input autocomplete="off" type="text" name="email_one" id="email_one"
                                    placeholder=" 이메일 입력 ">
                                @
                                <input autocomplete="off" type="text" name="email_two" id="email_two">
                                <?php
                                    }
                                ?>
                                <select name="email_option" onchange="mail_address_setting(this);">
                                    <option value="" disabled selected>---선택하세요---</option>
                                    <option value="gmail.com">gmail.com</option>
                                    <option value="naver.com">naver.com</option>
                                    <option value="daum.net">daum.net</option>
                                    <option value="nate.com">nate.com</option>
                                    <option value="">직접 입력</option>
                                </select>
                                <br>
                                <p id="input_email_confirm"></p>
                            </div>
                        </div>
                        <?php
                            if ($mode === "") {
                                ?>
                        <div id="address">
                            <input autocomplete="off" type="text" name="address_one" id="address_one"
                                placeholder=" 우편번호 " onclick="address_input();">
                            <input autocomplete="off" type="text" name="address_two" id="address_two"
                                placeholder=" 주소 ">
                            <input autocomplete="off" type="text" name="address_three" id="address_three"
                                placeholder=" 상세주소 ">
                            <br>
                            <p id="input_address_confirm"></p>
                        </div>
                        <?php
                            } else {
                                ?>
                        <div id="address">
                            <input autocomplete="off" type="text" name="address_one" id="address_one"
                                value="<?= $address1 ?>" onclick="address_input();">
                            <input autocomplete="off" type="text" name="address_two" id="address_two"
                                value="<?= $address2 ?>" onclick="address_input();">
                            <input autocomplete="off" type="text" name="address_three" id="address_three"
                                value="<?= $address3 ?>">
                            <br>
                            <p id="input_address_confirm"></p>
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if ($mode === "") {
                                ?>
                        <div id="check_box">
                            <input type="checkbox" id="all_agree">
                            <span id="all_agree_span">
                                전체 동의 (필수, 선택 모두 포함)
                            </span><br>
                            <input type="checkbox" id="tou_one">
                            <span>
                                이용 약관 동의 (필수)
                            </span>
                            <a href="./terms_of_use.php?page=tou1" target="_blank">약관 보기</a>
                            <br>
                            <input type="checkbox" id="tou_two">
                            <span>
                                개인정보 수집 동의 (필수)
                            </span>
                            <a href="./terms_of_use.php?page=tou2" target="_blank">약관 보기</a>
                            <br>
                            <input type="checkbox" id="tou_three">
                            <span>
                                마케팅 수신 동의 (선택)
                            </span>
                            <a href="./terms_of_use.php?page=tou3" target="_blank">상세 보기</a>
                            <br>
                        </div>
                        <?php
                            }
                        ?>
                        <div id="button">
                            <div id="cancel">
                                <? if ($mode === "modify"){ ?>
                                <a href="../index.php">
                                    <? }else{ ?>
                                    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/index.php">
                                        <? } ?>
                                        <p>취 소</p>
                                    </a>
                            </div>
                            <?php
                                if ($mode === "") {
                                    ?>
                            <div id="signup">
                                <input type="submit" id="button_submit" value="가 입"  onclick="action_signup()"
                                 disabled="true">
                            </div>
                            <?php
                                } else {
                                    ?>
                            <div id="signup">
                                <input type="button" id="button_submit" value="수정완료" onclick="action_update()"
                                    disabled="true">
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                </form>
            </div>
            <?php
                    if ($mode !== "") {
                        ?>
            <div id="member_delete">회원탈퇴</div>
            <? } ?>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
    </footer>
</body>

</html>