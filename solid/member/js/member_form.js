var id_pass = false,
    pw_pass = false,
    pw_check_pass = false,
    name_pass = false,
    phone_two_pass = false,
    phone_three_pass = false,
    email_one_pass = false,
    email_two_pass = false,
    address_one_pass = false,
    address_two_pass = false,
    address_three_pass = false,
    phone_code_pass = false,

    tou_one_pass = false,
    tou_two_pass = false;

var phone_code = "";

$(document).ready(function () {
    var input_id = $("#input_id"),
        input_password = $("#input_password"),
        input_password_check = $("#input_password_check"),
        input_name = $("#input_name"),

        phone_two = $("#phone_two"),
        phone_three = $("#phone_three"),
        email_one = $("#email_one"),
        email_two = $("#email_two"),
        address_one = $("#address_one"),
        address_two = $("#address_two"),
        address_three = $("#address_three"),

        input_id_confirm = $("#input_id_confirm");
    input_password_confirm = $("#input_password_confirm");
    input_id_confinput_password_check_confirmirm = $("#input_password_check_confirm");
    input_name_confirm = $("#input_name_confirm");
    input_phone_confirm = $("#input_phone_confirm");
    input_email_confirm = $("#input_email_confirm");
    input_email_certification_confirm = $("#input_email_certification_confirm");
    input_address_confirm = $("#input_address_confirm");

    // 정보수정이거나 회원가입이거나 판별
    if (input_id.attr("readonly")) {
        input_id_confirm.html("<span style='color:green'>아이디는 변경할 수 없습니다.</span>");
        // 수정하지 않는 정보가 있을 수 있기때문에 일단 처음에 다 true를 주고 수정하는 칸이 블러되면 다시 거기서
        // false인지 true인지 판별.
        id_pass = true;
        pw_pass = true;
        pw_check_pass = true;
        name_pass = true;
        phone_two_pass = true;
        phone_three_pass = true;
        email_one_pass = true;
        email_two_pass = true;
        address_one_pass = true;
        address_two_pass = true;
        address_three_pass = true;
        phone_code_pass = true;
        tou_one_pass = true;
        tou_two_pass = true;
        isAllPass();

    } else {

        input_id.blur(function () {
            if (input_name.attr("readonly")) {
                name_pass = true;
                email_one_pass = true;
                email_two_pass = true;
            }

            var id_value = input_id.val();
            var exp = /^[a-z0-9]{5,20}$/;
            if (id_value === "") {
                console.log("id_pass1");
                input_id_confirm.html("<span style='color:red'>아이디를 입력해주세요.</span>");
                id_pass = false;
                isAllPass();
            } else if (!exp.test(id_value)) {
                console.log("id_pass2");
                input_id_confirm.html("<span style='color:red'>아이디는 5~20자의 영문 소문자와 숫자만 사용할 수 있습니다.</span>");
                id_pass = false;
                isAllPass();
            } else {
                $.ajax({
                    url    : './member_form_check.php',
                    type   : 'POST',
                    data   : {
                        "input_id": id_value
                    },
                    success: function (data) {
                        console.log(data);
                        if (data === "1") {
                            input_id_confirm.html("<span style='color:red'>이미 사용중인 아이디입니다. 다른 아이디를 입력해주세요.</span>");
                            id_pass = false;
                        } else if (data === "0") {
                            input_id_confirm.html("<span style='color:green'>사용 가능한 아이디입니다.</span>");
                            id_pass = true;
                        } else {
                            input_id_confirm.html("<span style='color:red'>오류입니다. 다시 확인해주세요.</span>");
                            id_pass = false;
                        }
                        console.log("id_pass3");
                        isAllPass();
                    }
                })
                    .done(function () {
                        console.log("success");
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        console.log("complete");
                    });
            }
        }); //input_id.blur end
    }

    input_password.blur(function () {
        var password_value = input_password.val();
        var exp = /^[a-z0-9]{5,20}$/;
        pw_pass = false;

        if (password_value === "") {
            input_password_confirm.html("<span style='color:red'>비밀번호를 입력해주세요.</span>");
        } else if (!exp.test(password_value)) {
            input_password_confirm.html("<span style='color:red'>비밀번호는 5~20자의 영문 소문자와 숫자만 사용할 수 있습니다.</span>");
        } else {
            input_password_confirm.html("<span style='color:green'>사용 가능한 비밀번호입니다.</span>");
            pw_pass = true;
        }
        console.log("pw_pass");
        isAllPass();
    }); //input_password.blur end

    input_password_check.blur(function () {
        var password_value = input_password.val();
        var password_check_value = input_password_check.val();
        pw_check_pass = false;
        if (password_check_value === "") {
            input_id_confinput_password_check_confirmirm.html("<span style='color:red'>비밀번호를 재입력해주세요.</span>");
        } else if (password_check_value !== password_value) {
            input_id_confinput_password_check_confirmirm.html("<span style='color:red'>비밀번호가 일치하지 않습니다.</span>");
        } else {
            input_id_confinput_password_check_confirmirm.html("<span style='color:green'>비밀번호와 일치합니다.</span>");
            pw_check_pass = true;
        }
        console.log("pw_check_pass");
        isAllPass();
    }); //input_password_check.blur end

    input_name.blur(function () {
        var name_value = input_name.val();
        var exp = /^[a-zA-Z가-힣]{2,10}$/;
        name_pass = false;
        if (name_value === "") {
            input_name_confirm.html("<span style='color:red'>이름을 입력해주세요.</span>");
        } else if (!exp.test(name_value)) {
            input_name_confirm.html("<span style='color:red'>이름은 2자 이상의 한글과 영문대소문자만 사용 할 수 있습니다.</span>");
        } else {
            input_name_confirm.html("");
            name_pass = true;
        }
        console.log("name_pass");
        isAllPass();
    }); //input_name.blur end

    phone_two.keyup(function () {
        var phone_two_value = phone_two.val();
        var exp = /^[0-9]{3,4}$/;
        phone_two_pass = false;
        if (phone_two_value === "") {
            input_phone_confirm.html("<span style='color:red'>번호를 입력해주세요.</span>");
        } else if (!exp.test(phone_two_value)) {
            input_phone_confirm.html("<span style='color:red'>번호는 3~4자의 숫자만 사용 할 수 있습니다.</span>");
        } else {
            input_phone_confirm.html("");
            phone_two_pass = true;
        }
        console.log("phone_two_pass");
        isAllPass();
    }); //phone_two.blur end

    phone_three.keyup(function () {
        var phone_three_value = phone_three.val();
        var exp = /^[0-9]{3,4}$/;
        phone_three_pass = false;
        if (phone_three_value === "") {
            input_phone_confirm.html("<span style='color:red'>번호를 입력해주세요.</span>");
        } else if (!exp.test(phone_three_value)) {
            input_phone_confirm.html("<span style='color:red'>번호는 3~4자의 숫자만 사용 할 수 있습니다.</span>");
        } else {
            input_phone_confirm.html("");
            phone_three_pass = true;
        }
        console.log("phone_three_pass");
        isAllPass();
    }); //phone_three.blur end

    email_one.blur(function () {
        var email_one_value = email_one.val();
        var exp = /^[a-z0-9]{2,20}$/;
        email_one_pass = false;
        if (email_one_value === "") {
            input_email_confirm.html("<span style='color:red'>이메일을 입력해주세요.</span>");
        } else if (!exp.test(email_one_value)) {
            input_email_confirm.html("<span style='color:red'>이메일은 2자 이상의 영문소문자와 숫자만 사용 할 수 있습니다.</span>");
        } else {
            input_email_confirm.html("<span style='color:green'></span>");
            email_one_pass = true;
        }
        console.log("email_one_pass");
        isAllPass();
    }); //email_one.blur end

    email_two.blur(function () {
        var email_two_value = email_two.val();
        email_two_pass = false;
        if (email_two_value === "") {
            input_email_confirm.html("<span style='color:red'>이메일 주소를 선택해주세요.</span>");
        } else if (email_two_value !== "") {
            input_email_confirm.html("");
            email_two_pass = true;
        }
        console.log("email_two_pass");
        isAllPass();
    }); //email_two.blur end

    address_one.blur(function () {
        var address_one_value = address_one.val();
        var address_two_value = address_two.val();
        address_one_pass = false;
        address_two_pass = false;

        if (address_one_value === "" || address_two_value === "") {
            input_address_confirm.html("<span style='color:red'>우편번호를 입력해주세요.</span>");
        } else {
            input_address_confirm.html("");
            address_one_pass = true;
            address_two_pass = true;
        }
        console.log("address_one_pass");
        console.log("address_two_pass");
        isAllPass();
    }); //address_one.blur end

    address_two.blur(function () {
        var address_one_value = address_one.val();
        var address_two_value = address_two.val();
        address_one_pass = false;
        address_two_pass = false;

        if (address_one_value === "" || address_two_value === "") {
            input_address_confirm.html("<span style='color:red'>주소를 입력해주세요.</span>");
        } else {
            input_address_confirm.html("");
            address_one_pass = true;
            address_two_pass = true;
        }
        console.log("address_one_pass2");
        console.log("address_two_pass2");
        isAllPass();
    }); //address_one.blur end

    address_three.blur(function () {
        var address_three_value = address_three.val();
        var exp = /^[a-zA-Z가-힣0-9-\s]{1,30}$/;
        address_three_pass = false;
        if (address_three_value === "") {
            input_address_confirm.html("<span style='color:red'>상세주소를 입력해주세요.</span>");
        } else if (!exp.test(address_three_value)) {
            input_address_confirm.html("<span style='color:red'>주소는 영문대소문자와 한글과 숫자와 - 기호만 사용 할 수 있습니다.</span>");
        } else {
            input_address_confirm.html("");
            address_three_pass = true;
        }
        console.log("address_three_pass");
        isAllPass();
    }); //address_three.blur end

    $("#phone_check").click(function () {
        var phone_one_value = $("#phone_one").val();
        var phone_two_value = $("#phone_two").val();
        var phone_three_value = $("#phone_three").val();
        if (phone_one_value !== "" && phone_two_pass && phone_three_pass) {
            $.ajax({
                url    : "./phone_certification.php",
                type   : 'POST',
                data   : {
                    "mode"       : "send",
                    "phone_one"  : phone_one_value,
                    "phone_two"  : phone_two_value,
                    "phone_three": phone_three_value
                },
                success: function (data) {
                    phone_code = data;
                    if (data === "발송 실패") {
                        alert("문자 전송 실패되었습니다.");
                    } else {
                        alert("문자가 전송 되었습니다.");
                    }
                }
            })
        } else {
            alert("휴대폰 번호가 제대로 입력되지 않았습니다!");
        }
    });

    $("#input_phone_certification_check").click(function () {
        phone_code_pass = false;
        if ($("#input_phone_certification").val() === "") {
            $("#input_phone_confirm").html("<span style='color:red'>인증번호를 입력해주세요.</span>");
        } else if ($("#input_phone_certification").val() === phone_code) {
            $("#input_phone_confirm").html("<span style='color:green'>인증에 성공하였습니다.</span>");
            phone_code_pass = true;
        } else if ($("#input_phone_certification").val() !== phone_code) {
            $("#input_phone_confirm").html("<span style='color:red'>인증에 실패하였습니다.</span>");
        } else {
            alert("문자 인증 오류입니다!");
        }
        console.log("phone_code_pass");
        isAllPass();
    });

    // 전체 선택 체크박스
    $("#all_agree").click(function () {
        if ($("#all_agree").prop("checked")) {
            $("input[type=checkbox]").prop("checked", true);
            tou_one_pass = true;
            tou_two_pass = true;
        } else {
            $("input[type=checkbox]").prop("checked", false);
            tou_one_pass = false;
            tou_two_pass = false;
        }
        console.log("all_agree");
        isAllPass();
    });

    $("#tou_one").click(function () {
        if ($("#tou_one").prop("checked")) {
            $("#tou_one").prop("checked", true);
            tou_one_pass = true;
        } else {
            $("#tou_one").prop("checked", false);
            tou_one_pass = false;
        }
        console.log("tou_one");
        isAllPass();
    });

    $("#tou_two").click(function () {
        if ($("#tou_two").prop("checked")) {
            $("#tou_two").prop("checked", true);
            tou_two_pass = true;
        } else {
            $("#tou_two").prop("checked", false);
            tou_two_pass = false;
        }
        console.log("tou_two");
        isAllPass();
    });
}); //document ready end

function isAllPass() {
    console.log("isAllPass()");
    if (id_pass && pw_pass && pw_check_pass && name_pass && phone_two_pass && phone_three_pass
        && email_one_pass && email_two_pass && address_one_pass && address_two_pass && address_three_pass
        && phone_code_pass && tou_one_pass && tou_two_pass) {
        $("#button_submit").attr("disabled", false);
    } else {
        $("#button_submit").attr("disabled", true);
    }
}

$("#cancel").on("click", function () {
    location.href = "./member_mypage.php"
})

$(document).on("click", "#member_delete", function () {
    if (confirm("회원 탈퇴를 하시겠습니까?")) {
        $.ajax({
            type   : "POST",
            url    : "member_data.php?type=delete",
            data   : {member_num: $("#member_num").val()},
            success: function () {
                location.href="../index.php";

            }
        })
    }
})