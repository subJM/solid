$(".my_page").on("click", function () {
    location.href = "member_mypage.php";
});

$member_num = $("#member_num").val();
// =============  예약조회  =========================
$("#select_date").on("click", function () {
    $("#appointment_list").load("member_appointment_list.php", {
        date_1: $("#date_1").val(), date_2: $("#date_2").val(), period_mode: "select_date",member_num:$member_num
    }, function (data, statusTxt, xhr) {
    });

})
$("#all_date").on("click", function () {
    $("#appointment_list").load("member_appointment_list.php", {member_num:$member_num}, function (data, statusTxt, xhr) {
        $("#date_1").val("");
        $("#date_2").val("")
    });

})


//==================================리뷰작성=======================================
// $("#date_2").val(new Date().toISOString().slice(0,10));
const $content = $("#popup_content");
let $hospital_id = "";
let $appointment_num = "";
const $review_content = "<div><h4>리뷰 작성 </h4></div>" +
    "<div class=\"hospital_info\">" +
    "<div><h1 id=\"review_hospital_name\">병원이름</h1>" +
    "<p id=\"review_appointment_date\">진료일</p></div>" +
    "</div>" +
    "<p id=\"star_grade\">" +
    "<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></p>" +
    "<div><h2>친절</h2>" +
    "<input type=\"radio\" name=\"kindness\" id=\"radio0\" class=\"checkbox\" value=\"1\">" +
    "<label for=\"radio0\" class=\"input-label radio\">불친절해요</label>" +
    "<input type=\"radio\" name=\"kindness\" id=\"radio1\" class=\"checkbox\" value=\"2\">" +
    "<label for=\"radio1\" class=\"input-label radio\">친절해요</label>" +
    "<input type=\"radio\" name=\"kindness\" id=\"radio2\" class=\"checkbox\" value=\"3\">" +
    "<label for=\"radio2\" class=\"input-label radio\">최고에요</label>" +
    "</div>" +
    "<div><h2>대기 시간</h2>" +
    "<input type=\"radio\" name=\"wait_time\" id=\"radio3\" class=\"checkbox\" value=\"1\">" +
    "<label for=\"radio3\" class=\"input-label radio\">오래걸려요</label>" +
    "<input type=\"radio\" name=\"wait_time\" id=\"radio4\" class=\"checkbox\" value=\"2\">" +
    "<label for=\"radio4\" class=\"input-label radio\">보통이에요</label>" +
    "<input type=\"radio\" name=\"wait_time\" id=\"radio5\" class=\"checkbox\" value=\"3\">" +
    "<label for=\"radio5\" class=\"input-label radio\">빨라요</label></div>" +
    "<div><h2>진료비</h2>" +
    "<input type=\"radio\" name=\"expense\" id=\"radio6\" class=\"checkbox\" value=\"1\">" +
    "<label for=\"radio6\" class=\"input-label radio\">비싸요</label>" +
    "<input type=\"radio\" name=\"expense\" id=\"radio7\" class=\"checkbox\" value=\"2\">" +
    "<label for=\"radio7\" class=\"input-label radio\">보통이에요</label>" +
    "<input type=\"radio\" name=\"expense\" id=\"radio8\" class=\"checkbox\" value=\"3\">" +
    "<label for=\"radio8\" class=\"input-label radio\">저렴해요</label></div>" +
    "<p>" +
    "<textarea cols=\"50\" rows=\"10\" id=\"review_pop_comment\" name=\"review_pop_comment\"" +
    "          placeholder=\"리뷰를 작성해주세요!\"></textarea>" +
    "</p>";
// +"<div id='popup_btn'>\n" +
// "    <button id='cancel' class='cancel'>예약취소</button>\n" +
// "    <button id='popup_detail'> 관리</button>\n" +
// "    <button id='popup_write'> 등록</button>\n" +
// "    <button id='close'>취소</button>\n" +
// "</div>";


$(document).on("click", ".review_write", function () {
    $("#popup_content").html($review_content);
    $("#popup_content").find("h4").html("리뷰 작성");
    $("#popup_detail").hide();
    $("#popup_write").show();
    $("#cancel").hide();
    const $item = $(this).parent();

    const $hospital_name = $item.children("h3").text();
    const $date = $item.children("p").first().text();
    $hospital_id = $item.children(".hospital_id").val();
    $appointment_num = $item.find(".appointment_num").val();
    $("input[type=radio]").attr("disabled", false);
    // $("input[type=radio]").prop("checked", false);
    $("#review_pop_comment").attr("readonly", false);
    popup_open();
    $content.find("#review_hospital_name").html($hospital_name);
    $content.find("#review_appointment_date").html($date);
    // $content.find("#review_hospital_logo").attr("src", $img_src);


    $('#star_grade span').click(function () {
        $(this).parent().children("span").removeClass("on");  /* 별점의 on 클래스 전부 제거 */
        $(this).addClass("on").prevAll("span").addClass("on"); /* 클릭한 별과, 그 앞 까지 별점에 on 클래스 추가 */
        return false;
    });

})

$(document).on("click", "#popup_write", function () {
    $.ajax({
        type   : "POST",
        url    : "review_data.php",
        data   : {
            mode           : "insert",
            hospital_id    : $hospital_id,
            appointment_num: $appointment_num,
            member_num     : $member_num,
            star_rating    : $("#star_grade").find(".on").length,
            kindness       : $("input[name=kindness]:checked").val(),
            wait_time      : $("input[name=wait_time]:checked").val(),
            expense        : $("input[name=expense]:checked").val(),
            comment        : $("#review_pop_comment").val()
        },
        success: function (data) {
            if (data === "success") {
                alert("등록이 완료되었습니다.")
                popup_close();
                location.reload();
            } else {
                alert("모든 항목을 입력하세요");
                console.log(data)
            }
        }
    })
})

//팝업창 닫기
$(document).on("click", "#close", function () {
    popup_close();
});

//리뷰삭제
$(document).on("click", ".review_delete", function () {
    const $this_span = $(this).parent().parent();
    const $review_id = $this_span.find(".review_no").val();
    if (confirm("리뷰를 삭제하시겠습니까?") === true) {
        $.ajax({
            type   : "POST",
            url    : "review_data.php",
            data   : {
                mode     : "delete",
                review_no: $review_id
            },
            success: function (data) {
                if (data === "success") {
                    alert("삭제되었습니다.")
                    $this_span.remove();
                    location.reload();
                }
            }
        })
    }
})

//작성한 리뷰 보기
$(document).on("click", ".review_detail", function () {
    $("#popup_content").html($review_content);
    $("#popup_content").find("h4").html("작성한 리뷰 보기");
    $("#popup_write").hide();
    $("#popup_detail").show();
    $("#cancel").hide();
    $("#popup_detail").on("click", function () {
        location.href = "member_review.php";
    })
    const $item = $(this).parent();
    const $hospital_name = $item.children("h3").text();
    const $date = $item.children("p").first().text();
    const $review_no = $item.children(".review_no").val();

    $content.find("#review_hospital_name").html($hospital_name);
    $content.find("#review_appointment_date").html($date);

    $("input[type=radio]").attr("disabled", true);
    $("#review_pop_comment").attr("readonly", true);
    $("#star_grade").children("span").removeClass("on");
    $.ajax({
        type   : "POST",
        url    : "review_data.php",
        data   : {
            mode     : "detail",
            review_no: $review_no
        },
        success: function (data) {
            const $result = jQuery.parseJSON(data);
            // console.dir($result)

            $("#review_pop_comment").val($result['comment']);

            const $star = $("#star_grade").children("span");
            let k = 0;
            $star.each(function (i) {
                if (k < $result['star_rating'])
                    $($star[i]).addClass("on");
                k++;
            })
            switch ($result['kindness']) {
                case '1':
                    $("#radio0").prop('checked', true);
                    break;
                case '2':
                    $("#radio1").prop('checked', true);
                    break;
                case '3':
                    $("#radio2").prop('checked', true);
                    break;
            }
            switch ($result['wait_time']) {
                case '1':
                    $("#radio3").prop('checked', true);
                    break;
                case '2':
                    $("#radio4").prop('checked', true);
                    break;
                case '3':
                    $("#radio5").prop('checked', true);
                    break;
            }
            switch ($result['expense']) {
                case '1':
                    $("#radio6").prop('checked', true);
                    break;
                case '2':
                    $("#radio7").prop('checked', true);
                    break;
                case '3':
                    $("#radio8").prop('checked', true);
                    break;
            }
        }
    })

    popup_open();

})
//예약내용 자세히 보기
$(document).on("click", ".detail", function () {

    $("#popup_write").hide();
    $("#popup_detail").hide();
    $("#cancel").show();
    $("#popup_detail").on("click", function () {
        location.href = "member_review.php";
    })
    const $item = $(this).parent();
    const $appointment_num = $item.children(".appointment_num").val();
    const $hospital_name = $item.children("h3").text();
    const $date = $item.children("p").first().text();
    const $apend_input = "<input type='hidden' class='appointment_num' value='" + $appointment_num + "'>";
    $("#popup_btn").append($apend_input);
    $content.find("#review_hospital_name").html($hospital_name);
    $content.find("#review_appointment_date").html($date);

    $("#popup_content").load("appointment_data.php", {
        mode           : "detail",
        appointment_num: $appointment_num
    }, function (data, statusTxt, xhr) {
    });
    popup_open();

})

//예약취소
$(document).on("click", ".cancel", function () {
    const $item = $(this).parent();
    const $appointment_num = $item.children(".appointment_num").val();
    if (confirm("예약을 취소하시겠습니까?")) {
        $.ajax({
            type   : "POST",
            url    : "appointment_data.php",
            data   : {
                mode           : "cancel",
                appointment_num: $appointment_num
            },
            success: function (data) {
                if (data === "success") {
                    alert("예약이 취소되었습니다.")
                    location.reload();
                }
            }
        })
    }


})

//댓글 일괄 삭제
$(document).on("click", "#delete_ripple", function () {
    let $check_array = [];

    $("input:checkbox[name=ripple_check]").each(function () {
        if ($(this).is(":checked") === true) {
            $check_array.push($(this).parent().parent().children(".ripple_num").val());
        }
    });

    if (confirm("댓글을 삭제하시겠습니까?")) {
        $.ajax({
            type   : "POST",
            url    : "ripple_data.php",
            data   : {
                ripple_num_array: $check_array
            },
            success: function (data) {
                alert("선택하신 댓글이 삭제되었습니다.")
                location.reload();
            }
        })
    }


})

//댓글관리 페이지 전체선택 이벤트
$(document).on("change", "#all_check", function () {
    if ($(this).is(":checked"))
        $("input:checkbox[name=ripple_check]").prop("checked", true);
    else
        $("input:checkbox[name=ripple_check]").prop("checked", false);
})


function popup_open() {
    $("body").css("overflow", "hidden");
    $("body").append("<div id='backgroundSmsLayer'></div>");
    $("#backgroundSmsLayer").css({
        "position"        : "fixed",
        "top"             : "0px",
        "left"            : "0px",
        "width"           : "100%",
        "height"          : "100%",
        "background-color": "#000",
        "z-index"         : "-1",
        "opacity"         : "0.3"

    });

    $("input[type=radio]").prop("checked", false);
    $("#popup").fadeIn();
}

function popup_close() {
    $("#star_grade").children("span").removeClass("on");

    $content.find("textarea").val("");

    $("body").css("overflow", "auto");
    $("#backgroundSmsLayer").remove();
    $("#popup").fadeOut();
}


//==========================관심병원 조회-=====================

const cat1_num = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
const cat1_name = new Array('서울', '부산', '대구', '인천', '광주', '대전', '울산', '강원', '경기', '경남', '경북', '전남', '전북', '제주', '충남', '충북');
const cat2_num = new Array();
const cat2_name = new Array();
cat2_name[1] = new Array('강남구', '강동구', '강북구', '강서구', '관악구', '광진구', '구로구', '금천구', '노원구', '도봉구', '동대문구', '동작구', '마포구', '서대문구', '서초구', '성동구', '성북구', '송파구', '양천구', '영등포구', '용산구', '은평구', '종로구', '중구', '중랑구');
cat2_name[2] = new Array('강서구', '금정구', '남구', '동구', '동래구', '부산진구', '북구', '사상구', '사하구', '서구', '수영구', '연제구', '영도구', '중구', '해운대구', '기장군');
cat2_name[3] = new Array('남구', '달서구', '동구', '북구', '서구', '수성구', '중구', '달성군');
cat2_name[4] = new Array('계양구', '남구', '남동구', '동구', '부평구', '서구', '연수구', '중구', '강화군', '옹진군');
cat2_name[5] = new Array('광산구', '남구', '동구', '북구', '서구');
cat2_name[6] = new Array('대덕구', '동구', '서구', '유성구', '중구');
cat2_name[7] = new Array('남구', '동구', '북구', '중구', '울주군');
cat2_name[8] = new Array('강릉시', '동해시', '삼척시', '속초시', '원주시', '춘천시', '태백시', '고성군', '양구군', '양양군', '영월군', '인제군', '정선군', '철원군', '평창군', '홍천군', '화천군', '횡성군');
cat2_name[9] = new Array('고양시 덕양구', '고양시 일산구', '과천시', '광명시', '광주시', '구리시', '군포시', '김포시', '남양주시', '동두천시', '부천시 소사구', '부천시 오정구', '부천시 원미구', '성남시 분당구', '성남시 수정구', '성남시 중원구', '수원시 권선구', '수원시 장안구', '수원시 팔달구', '시흥시', '안산시 단원구', '안산시 상록구', '안성시', '안양시 동안구', '안양시 만안구', '오산시', '용인시', '의왕시', '의정부시', '이천시', '파주시', '평택시', '하남시', '화성시', '가평군', '양주군', '양평군', '여주군', '연천군', '포천군');
cat2_name[10] = new Array('거제시', '김해시', '마산시', '밀양시', '사천시', '양산시', '진주시', '진해시', '창원시', '통영시', '거창군', '고성군', '남해군', '산청군', '의령군', '창녕군', '하동군', '함안군', '함양군', '합천군');
cat2_name[11] = new Array('경산시', '경주시', '구미시', '김천시', '문경시', '상주시', '안동시', '영주시', '영천시', '포항시 남구', '포항시 북구', '고령군', '군위군', '봉화군', '성주군', '영덕군', '영양군', '예천군', '울릉군', '울진군', '의성군', '청도군', '청송군', '칠곡군');
cat2_name[12] = new Array('광양시', '나주시', '목포시', '순천시', '여수시', '강진군', '고흥군', '곡성군', '구례군', '담양군', '무안군', '보성군', '신안군', '영광군', '영암군', '완도군', '장성군', '장흥군', '진도군', '함평군', '해남군', '화순군');
cat2_name[13] = new Array('군산시', '김제시', '남원시', '익산시', '전주시 덕진구', '전주시 완산구', '정읍시', '고창군', '무주군', '부안군', '순창군', '완주군', '임실군', '장수군', '진안군');
cat2_name[14] = new Array('서귀포시', '제주시', '남제주군', '북제주군');
cat2_name[15] = new Array('공주시', '논산시', '보령시', '서산시', '아산시', '천안시', '금산군', '당진군', '부여군', '서천군', '연기군', '예산군', '청양군', '태안군', '홍성군');
cat2_name[16] = new Array('제천시', '청주시 상당구', '청주시 흥덕구', '충주시', '괴산군', '단양군', '보은군', '영동군', '옥천군', '음성군', '진천군', '청원군');

function cat1_change(key, sel) {
    if (key == '') return;
    const name = cat2_name[key];
    const val = cat2_name[key];

    for (let i = sel.length - 1; i >= 0; i--)
        sel.options[i] = null;
    sel.options[0] = new Option('전체', '', '', 'true');
    for (let i = 0; i < name.length; i++) {
        sel.options[i + 1] = new Option(name[i], val[i]);
    }
}

//검색 조건 설정후 확인 버튼 클릭시 위치별 병원목록 로딩 ajax
$("#btn").on("click", function () {
    $.ajax({
        type   : "POST",
        url    : "interest_data.php",
        data   : {
            area_1    : $('#h_area1 option:selected').attr('value2'),
            area_2    : $('#h_area2 option:selected').attr('value'),
            member_num: $("#member_num").val()
        },
        success: function (data) {
            // console.log(data);
            $("#interest_list").html(data);
        }
    })
})

$("#all_btn").on("click", function () {
    $.ajax({
        type   : "POST",
        url    : "interest_data.php",
        data   : {
            member_num: $("#member_num").val()
        },
        success: function (data) {
            $('#h_area1').find('option:eq(0)').prop("selected", true);
            $('#h_area2').find('option:eq(0)').prop("selected", true);
            $("#interest_list").html(data);
        }
    })
})

