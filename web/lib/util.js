function getMessagesDanger(messages) {
    var msg = "";
    msg += '<div class="alert alert-danger alert-dismissable fade in">';
        msg += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        msg += '<strong>'+ messages +'</strong>';
    msg += '</div>';
    return msg;
}

function getMessagesSuccess(messages) {
    var msg = "";
    msg += '<div class="alert alert-success alert-dismissable fade in">';
        msg += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        msg += '<strong>'+ messages +'</strong>';
    msg += '</div>';
    return msg;
}

 function getCurrentDay() {
    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = addZero(today.getMonth() + 1);
    var dd = addZero(today.getDate());
    var h = addZero(today.getHours());
    var m = addZero(today.getMinutes());
    var s = addZero(today.getSeconds());
    today = yyyy + '-' + mm + '-' + dd + ' ' + h + ":" + m + ":" + s;
    return today;
}

function addZero(obj) {
    if (obj < 10) {
        obj = "0" + obj;
    }
    return obj;
}
