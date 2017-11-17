var employeesModel = function () {
    
    var self = {};
    
    self.deleteEmployee = function(id){
        $("#employee_delete").val(id);
        $("#modal_delete_employees").modal("show");
    };
    
    return self;
}(jQuery);