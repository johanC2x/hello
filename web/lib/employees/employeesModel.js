var employeesModel = function () {
    
    var self = {
        listPayment : []
    };
    
    self.deleteEmployee = function(id){
        $("#employee_delete").val(id);
        $("#modal_delete_employees").modal("show");
    };
    
    self.save = function(){
        var msg = "";
        var data_employee = self.getData();
        $("#data_employee").val(JSON.stringify(data_employee));
        $.ajax({
            type: 'POST',
            data: $("#frm_employees_pay").serialize(),
            url: $("#frm_employees_pay").attr('action'),
            success: function (response) {
                var data = JSON.parse(response);
                if(!data.success){
                    msg = getMessagesDanger(data.response);
                    $("#messages").html(msg);
                }else{
                    msg = getMessagesSuccess(data.response);
                    $("#messages").html(msg);
                    location.reload();
                }
            }
        });
    };
    
    self.getData = function(){
        var data_employee = {};
        data_employee.ruc = $("#cbo_entity").attr("data-ruc");
        data_employee.bank = $("#cbo_entity").val();
        data_employee.number = $("#number_account").val();
        data_employee.number_length = $("#number_account").attr("data-number");
        var payment = {};
        payment.account = $("#cbo_entity_account").val();
        payment.pay_sol = $("#payment_sol").val();
        payment.pay_dol = $("#payment_dol").val();
        payment.ret_val = $("#cbo_pay_ret").val();
        payment.ret_name = $("#cbo_pay_ret option:selected").attr("data-name");
        data_employee.payment = payment;
        var data_list = JSON.parse($("#data_employee").val());
        if(data_list.payment_account !== undefined){
            self.listPayment = data_list.payment_account;
        }
        self.listPayment.push({
            "account":$("#cbo_entity_account").val(),
            "year":$("#cbo_year").val(),
            "month":$("#cbo_month").val(),
            "ret_val":$("#cbo_pay_ret").val(),
            "ret_name":$("#cbo_pay_ret option:selected").attr("data-name"),
            "pay_sol":$("#payment_sol").val(),
            "pay_dol":$("#payment_dol").val(),
            "pay_dscto":$("#payment_dscto").val()
        });
        data_employee.payment_account = self.listPayment;
        return data_employee;
    };
    
    self.deleteEmployeeData = function(index){
        var msg = "";
        var data_list = JSON.parse($("#data_employee").val());
        if(data_list.payment_account !== undefined){
            self.listPayment = data_list.payment_account;
        }
        self.listPayment.splice(index, 1);
        data_list.payment_account = self.listPayment;
        $("#data_employee").val(JSON.stringify(data_list));
        $.ajax({
            type: 'POST',
            data: $("#frm_employees_pay").serialize(),
            url: $("#frm_employees_pay").attr('action'),
            success: function (response) {
                var data = JSON.parse(response);
                if(!data.success){
                    msg = getMessagesDanger(data.response);
                    $("#messages").html(msg);
                }else{
                    msg = getMessagesSuccess(data.response);
                    $("#messages").html(msg);
                    location.reload();
                }
            }
        });
    };
    
    self.getListPayment = function(){
        var MyRows = $('table#tbl_employees_payment').find('tbody').find('tr');
        for (var i = 0; i < MyRows.length; i++) {
            console.log(MyRows[i].find("data-year"));
        }
    };
    
    return self;
}(jQuery);