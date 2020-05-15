function showUserInformation(url,userId) {

    $.ajax({
        url:url,
        method:"post",
        data:{"userId":userId}
    }).done(function (msg) {
        console.log(msg);
        $("#infoUser .modal-dialog .modal-content").html(msg);
    });
}
function bannedUser(url,userId) {
    $.ajax({
        url:url,
        method:"post",
        data:{"userId":userId}
    }).done(function (msg) {
        console.log(msg);
        $("#banedUsermodal .modal-dialog .modal-content").html(msg);
    });
}