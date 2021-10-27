$(document).ready(function () {
    $('#chkBox-select-all').on('click', function(){
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    $('#btn-delete').click(function(){
        var arrData = [];
        var trs = $("input:checked").closest("tbody tr");
        var indexes = $.map(trs, function(tr) { return $(tr).index(); });
        $.each(indexes,function(index,value){
            arrData.push(table.row(value).data());
        });
        if(arrData.length > 0){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F9354C',
                cancelButtonColor: '#41B314',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(){
                OpenSalesDelete.submit(arrData);
            }).catch(swal.noop);
        }
    });
});

var OpenSalesDelete = {
    submit : function(data){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "maintenance_data|item_master_api|delete",
                data : data
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
}