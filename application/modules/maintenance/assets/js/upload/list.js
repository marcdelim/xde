var table;
$(document).ready(function () {
    data_list();
});

function data_list(){
    table = $('#tbl-maintenance').DataTable({
        "scrollX": false,
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "searching": true,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        buttons : [
            { extend: 'excel',
              title: 'Maintenance Data',
              exportOptions: {
                columns: ":not(.not-export-column)"
             }
            },
        ],
        "ajax": {
            "url": urls.ajax_url,
            "type": "post",
            "dataType" : "json",
            "data" : function(d){
                d.mod = "maintenance|maintenance_api|list";
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                console.log(arrData);
                for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                    arrData[i]['edit'] = '<input type="checkbox" >';
                }
                return arrData;
            }
        },"columns": [
            { "data": "port"},
            { "data": "area_1" },
            { "data": "area_2" },
            { "data": "area_3" },
            { "data": "del_sla" },
            { "data": "rts_sla" },
            { "data": "client" },
            { "data": "del_sla_point" },
            { "data": "rts_sla_point" },
            { "data": "xde_wh" },
        ]
    });

    $('#btn-export').on("click", function() {
        table.button('.buttons-excel').trigger();
    });
}