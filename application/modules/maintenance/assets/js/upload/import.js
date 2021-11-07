$(document).ready(function () {
    $('#btn-import').click(function(){
        importFile.form();
    });
});

var importFile = {
    form : function(){
        swal({
            title: 'Select file',
            html: '<input type="file" class="swal2-file" id="import_file">',
        }).then(function(){
            swal({
                title: 'Current data will be delete. Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F9354C',
                cancelButtonColor: '#41B314',
                confirmButtonText: 'Yes!'
            }).then(function(){
                importFile.submit();
            }).catch(swal.noop);
        }).catch(swal.noop);
    },
    validate : function(){

    },
    submit : function(){
        swal({
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton: false,
            title: "Uploading...",
            onOpen: () => swal.showLoading()
        });
        var formData = new FormData();
        formData.append('file', $('#import_file')[0].files[0]);
        formData.append('mod', "maintenance|maintenance_api|upload");
        $.ajax({
            url : urls.ajax_url,
            type : "post",
            dataType : "json",
            processData : false,
            contentType : false,
            data : formData,
            success : function(response){
                console.log(response);
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == 'success'){
                    location.reload();
                }
            },error : function(response){
                swal({
                    type: "error",
                    title: "An error occurred!"
                });
            }
        });
    }
};