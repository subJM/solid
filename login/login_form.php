<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>No.1 가상자산 플랫폼, Solid :: 회원가입</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solid/FTXcss/FTXmain.css">
    <link
        href="https://fonts.googleapis.com/css?family=Gothic+A1:400,500,700|Nanum+Gothic+Coding:400,700|Nanum+Gothic:400,700,800|Noto+Sans+KR:400,500,700,900&display=swap&subset=korean"
        rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#id").keydown(function(key) {
            if (key.keyCode == 13) {
                check_input();
            }
        });
        $("#password").keydown(function(key) {
            if (key.keyCode == 13) {
                check_input();
            }
        });
    })

    function check_input() {
        if (!document.login_form.id.value) {
            alert("아이디를 입력하세요");
            document.login_form.id.focus();
            return;
        }

        if (!document.login_form.password.value) {
            alert("비밀번호를 입력하세요");
            document.login_form.password.focus();
            return;
        }
        document.login_form.submit();
    }
    </script>
    <!-- 네이버 로그인 -->
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8">
    </script>

    <!-- 카카오톡 로그인 -->
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/header.php"; ?>
        </header>
        <section>
            <div id="login_main_content">
                <div id="title_login">
                    <h1>로그인</h1>
                </div>
                <div id="login_form">
                    <form name="login_form" action="login.php" method="post">
                        <input autocomplete="off" type="text" id="id" name="id" placeholder=" 아이디 입력 "> <br>
                        <input type="password" id="password" name="password" placeholder=" 비밀번호 입력 "> <br>
                        <div id="login_button">
                            <a href="#" onclick="check_input()">
                                <p>로그인</p>
                            </a>
                        </div>
                    </form>
                    <form id="hidden_kakao_login_form" action="../member/member_form.php" method="post">
                        <input type="hidden" id="hidden_kakao_name" name="hidden_kakao_name">
                        <input type="hidden" id="hidden_kakao_email" name="hidden_kakao_email">
                    </form>
                </div>
                <div id="find_info">
                    <script type="text/javascript">
                    // 팝업창을 화면 가운데에 띄워주기 위한 변수 선언
                    var popup_x = ((screen.availWidth - 470) / 2);
                    var popup_y = ((screen.availHeight - 400) / 2);

                    function find_id_popup() {
                        window.open('forgot_id_pw.php?page=id', '아이디찾기', 'width=470, height=400, top=' + popup_y +
                            ', left=' + popup_x + ', menubar=no, status=no, toolbar=no');
                    }

                    function find_password_popup() {
                        window.open('forgot_id_pw.php?page=password', '비밀번호찾기', 'width=470, height=400, top=' +
                            popup_y + ', left=' + popup_x + ', menubar=no, status=no, toolbar=no');
                    }
                    </script>
                    <a href="#" onclick="find_id_popup();" style="font-size: 16px;">아이디 찾기</a>
                    <a href="#" onclick="find_password_popup();" style="font-size: 16px;">비밀번호 찾기</a>
                </div>
                <div id="sns_login">
                    <div id="kakao_login">
                        <a id="kakao-login-btn"></a>
                        <script type='text/javascript'>
                        //<![CDATA[
                        // 사용할 앱의 JavaScript 키를 설정해 주세요.
                        Kakao.init('72e2975282d34283bb8453212a4d8ee4');
                        // 카카오 로그인 버튼을 생성합니다.
                        Kakao.Auth.createLoginButton({
                            container: '#kakao-login-btn',
                            success: function(authObj) {
                                // 로그인 성공시, API를 호출합니다.
                                Kakao.API.request({
                                    url: '/v2/user/me',
                                    success: function(res) {
                                        console.log(JSON.stringify(res));
                                        console.log(JSON.stringify(res));
                                        console.log(JSON.stringify(authObj));

                                        var kakao_name = res["kakao_account"]["profile"][
                                        "name"];
                                        var kakao_email = res["kakao_account"]["email"];
                                        if (kakao_name !== "undefined" && kakao_email !==
                                            "undefined") {
                                            $("#hidden_kakao_name").val(kakao_name);
                                            $("#hidden_kakao_email").val(kakao_email);
                                            $("#hidden_kakao_login_form").submit();
                                        } else {
                                            alert("카카오톡 로그인 오류입니다!")
                                        }

                                        $("#hidden_kakao_name").val(JSON.stringify(res
                                            .properties.name));
                                        $("#hidden_kakao_email").val(JSON.stringify(res
                                            .kakao_account.email));
                                        console.log(JSON.stringify(res.properties.name));
                                        console.log(JSON.stringify(res.kakao_account.email));

                                        $.ajax({
                                                url: './kakao_check.php',
                                                type: 'POST',
                                                data: {
                                                    kakao_name: JSON.stringify(res
                                                        .properties.name),
                                                    kakao_email: JSON.stringify(res
                                                        .kakao_account.email)
                                                }
                                            })
                                            .done(function(result) {
                                                console.log(result);
                                                result = result.split("#");
                                                console.log(result[0]);
                                                console.log(result[1]);
                                                $("#hidden_kakao").val("kakao");
                                                $("#hidden_kakao_name").val(result[0]);
                                                $("#hidden_kakao_email").val(result[1]);
                                                $('#hidden_kakao_login_form').submit();
                                            })
                                            .fail(function() {
                                                console.log("error");
                                            })
                                            .always(function() {
                                                console.log("complete");
                                            });

                                    },
                                    fail: function(error) {
                                        alert(JSON.stringify(error));
                                    }
                                });
                            },
                            fail: function(err) {
                                alert(JSON.stringify(err));
                            }
                        });
                        //]]>
                        </script>
                    </div>
                    <div id="naver_id_login"></div>
                    <!-- //네이버아이디로로그인 버튼 노출 영역 -->
                    <script type="text/javascript">
                    var naver_id_login = new naver_id_login("kqhyCKEnsQrOw5wB5Tob",
                        "http://127.0.0.1/solid/member/member_form.php");
                    var state = naver_id_login.getUniqState();
                    naver_id_login.setButton("green", 3, 43);
                    naver_id_login.setDomain("./login_form.php");
                    naver_id_login.setState(state);
                    naver_id_login.init_naver_id_login();
                    </script>
                </div>
                <div id="member_form">
                    <a href="../member/member_form.php">
                        <p>회원가입</p>
                    </a>
                </div>
            </div>
    </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/solid/footer.php"; ?>
    </footer>
    </section>
    </div>
</body>

</html>