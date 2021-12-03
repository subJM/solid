function check_input() {
    if (!document.board_form.subject.value) {
        alert("제목을 입력하세요!");
        document.board_form.subject.focus();
        return;
    }
    if (!document.board_form.content.value) {
        alert("내용을 입력하세요!");
        document.board_form.content.focus();
        return;
    }
    if (!document.board_form.read_pw.value){
        alert("비밀번호를 입력하세요!");
        document.board_form.read_pw.focus();
        return;
    }else {
        var exp = /[0-9]{4}/;
        if(!exp.test(document.board_form.read_pw.value)){
            alert("비밀번호는 0~9 까지 숫자만 가능합니다!");
            document.board_form.read_pw.focus();
            return;
        }
    }
    document.board_form.submit();
}
