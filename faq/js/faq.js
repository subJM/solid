function faq_input() {
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
    document.board_form.submit();
}

function faq_insert() {
    if (!document.board_form.subject.value) {
        alert("내용을 입력하세요!");
        document.board_form.subject.focus();
        return;
    }
    document.board_form.submit();
}

