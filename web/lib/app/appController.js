$(document).on("ready", function () {
    var self = app;

    $(".sub-menu").click(function(){
        $("#main-menu").find(".active-menu").each(function() {
            $(this).removeClass("active-menu");
        });
    });
    
});