//$(document).bind("contextmenu",function(e){
//    return false;
//});
//
//$(document).keydown(function(event){
//    if(event.keyCode === 123){
//        return false;
//   }else if(event.ctrlKey && event.shiftKey && event.keyCode === 73){        
//        return false;
//   }
//});

$(document).on("ready", function () {
    var self = employeesModel;

    $('#tbl_employees').DataTable();

    $("#btn_modal_employees").click(function () {
        $("#modal_employees").modal("show");
    });
    
    $("#btn_delete_employee").click(function(){
        $("#frm_delete_employees").submit();
    });

    $('#frm_employees').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            person_id: {
                validators: {
                    notEmpty: {message: "El campo dni es requerido"}
                }
            },
            first_name: {
                validators: {
                    notEmpty: {message: "El campo nombre es requerido"}
                }
            },
            last_name: {
                validators: {
                    notEmpty: {message: "El campo apellidos es requerido"}
                }
            },
            email: {
                validators: {
                    notEmpty: {message: "El campo email es requerido"}
                },
                emailAddress: {
                    message: 'El formato no es el correcto'
                }
            },
            phone_number: {
                validators: {
                    notEmpty: {message: "El campo teléfono es requerido"}
                }
            },
            address_1: {
                validators: {
                    notEmpty: {message: "El campo dirección es requerido"}
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        var msg = "";
        $.ajax({
            type: 'POST',
            data: $("#frm_employees").serialize(),
            url: $("#frm_employees").attr('action'),
            success: function (response) {
                var data = JSON.parse(response);
                if(!data.success){
                    msg = getMessagesDanger(data.response);
                    $("#messages").html(msg);
                }else{
                    msg = getMessagesSuccess(data.response);
                    $("#messages").html(msg);
                }
            }
        });
    });
    
});