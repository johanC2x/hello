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
