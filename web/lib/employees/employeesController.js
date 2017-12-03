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
    
    $('#tbl_employees_payment').DataTable();

    $("#code").attr("disabled",true);
    
    $("#code_generate").prop("checked",true);

    $("#btn_modal_employees").click(function () {
        $("#modal_employees").modal("show");
    });
    
    $("#ck_prueba").prop("checked",false);
    
    $("#ck_prueba").change(function(){
        if($("#ck_prueba").prop("checked")){
            $("#flg_prueba").val(1);
        }else{
            $("#flg_prueba").val(0);
        }
    });
    
    $("#btn_delete_employee").click(function(){
        $("#frm_delete_employees").submit();
    });
    
    $("#cbo_entity").change(function(){
        var number = $("#cbo_entity option:selected").attr("data-number");
        $("#number_account").attr("data-number",number);
        $("#number_account").attr("maxlength",number);
        
        var account = JSON.parse($("#cbo_entity option:selected").attr("data-account"));
        $('#cbo_entity_account option').remove();
        $('#cbo_entity_account').append($("<option></option>").attr("value","").text("Seleccionar"));
        if(account.length > 0){
            for (var i = 0;i < account.length; i++) {
                $('#cbo_entity_account').append($("<option></option>").attr("value",account[i].value.account).text(account[i].value.account + "-" +account[i].value.name.toUpperCase()));
            }
        }
    });
    
    $("#type_document").change(function(){
        var number = $("#type_document option:selected").attr("data-length");
        $("#person_id").attr("maxlength",number);
    });
    
    $("#code_generate").change(function(){
        if($("#code_generate").prop("checked")){
            $("#code").val($("#code").attr("data-code"));
            $("#code").attr("disabled",true);
        }else{
            $("#code").val("");
            $("#code").attr("disabled",false);
        }
    });
    
    $("#btn_export").click(function(){
        self.exportPayment();
    });
    
    $("#frm_employees_pay").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            cbo_entity_account: {
                validators: {
                    notEmpty: {message: "El campo cuenta banco es requerido"}
                }
            },
            payment_sol: {
                validators: {
                    notEmpty: {message: "El campo pago soles es requerido"}
                }
            },
            cbo_pay_ret: {
                validators: {
                    notEmpty: {message: "El campo retenciones es requerido"}
                }
            },
            cbo_month: {
                validators: {
                    notEmpty: {message: "El campo mes es requerido"}
                }
            },
            cbo_year: {
                validators: {
                    notEmpty: {message: "El campo año es requerido"}
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        self.save();
    });
    
    $('#frm_employees').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            type_document:{
                validators: {
                    notEmpty: {message: "El tipo de documento es requerido"}
                }
            },
            person_id: {
                validators: {
                    notEmpty: {message: "El campo dni es requerido"}
                }
            },
            code: {
                validators: {
                    notEmpty: {message: "El campo código es requerido"}
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
            date_start:{
                validators: {
                    notEmpty: {message: "El campo fecha de inicio es requerido"}
                }
            },
            date_end:{
                validators: {
                    notEmpty: {message: "El campo fecha de finalización es requerido"}
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
            number_account: {
                validators: {
                    notEmpty: {message: "El campo número de cuenta es requerido"}
                },
                stringLength: {
                    min: $("#number_account").attr("maxlength"),
                    message: 'Son necesarios '+$("#number_account").attr("maxlength")+" caractéres."
                }
            },
            cbo_entity: {
                validators: {
                    notEmpty: {message: "El campo banco es requerido"}
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        var msg = "";
        var data_employee = {};
        data_employee.ruc = $("#cbo_entity").val();
        data_employee.bank = $("#cbo_entity option:selected").text();
        data_employee.number = $("#number_account").val();
        data_employee.number_length = $("#cbo_entity option:selected").attr("data-number");
        data_employee.date_ini = $("#date_start").val();
        data_employee.date_end = $("#date_end").val();
        
        var entity = {};
        entity.ruc = $("#cbo_entity").val();
        entity.name = $("#cbo_entity option:selected").text();
        entity.desc = $("#cbo_entity option:selected").attr("data-short");
        data_employee.entity = entity;
        
        $("#data_employee").val(JSON.stringify(data_employee));
        $.ajax({
            type: 'POST',
            data: $("#frm_employees").serialize(),
            url: $("#frm_employees").attr('action'),
            success: function (response) {
                console.log(response);
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