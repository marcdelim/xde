$(document).ready(function () {
    $('#btn-create').click(function(){
        PostedSalesCreate.form();
    });
});

var PostedSalesCreate = {
    form : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "maintenance_data|item_master_api|create_form"
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Add Data',
                    className: "add-data",
                    size : "medium",
                    buttons: {
                        "cancel": {
                            label: "Cancel",
                            className: "btn-default cancelBtn",
                            callback: function() {
                                
                            }
                        },
                        "go": {
                            label: 'Submit',
                            className: "btn-danger",
                            callback: function() {
                                if(PostedSalesCreate.validate()){
                                    swal({
                                        title: 'Are you sure?',
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#F9354C',
                                        cancelButtonColor: '#41B314',
                                        confirmButtonText: 'Yes!'
                                    }).then(function(){
                                        PostedSalesCreate.submit();
                                    }).catch(swal.noop);
                                }
                                return false;
                            }
                        }
                    }
                });
            },error : function(response){
                console.log(response);
            }
        });
    },
    validate : function(){
        return $('#add-data-form').valid();
    },
    submit : function(){
        var formData = $('#add-data-form').serializeArray();
        var data = new Array();
        $.each(formData,function(key,val){
            data[val.name] = val.value;
        });
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "maintenance_data|item_master_api|create",
                data : $.extend({}, data)
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == "success"){
                    location.reload();
                }
            },error : function(response){
                console.log(response);
            }
        });
    }
};