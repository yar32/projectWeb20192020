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
function unbannedUser(url,userId) {
    $.ajax({
        url:url,
        method:"post",
        data:{"userId":userId}
    }).done(function (msg) {
        console.log(msg);
        $("#banedUsermodal .modal-dialog .modal-content").html(msg);
    });
}
function searchuser(url) {
    var search = $("#search_user").val();
    $.ajax({
        url:url,
        method:"post",
        data:{"username":search}
    }).done(function (msg) {
        console.log(msg);
        $("#allusers tbody").html(msg);
    });
}

function edituser(url) {
    $.ajax({
        url:url,
        method:"post",
        data: $("#formEditUser").serialize()
    }).done(function (msg) {
        $("#closeModalEditUser").click();
        $("#notify").html(msg);
        if($("#notify div").hasClass("alert-success")){
            window.location.reload();
        }
    });
}