var table;
$(document).ready(function () {
    data_list();
});

function data_list(){
    table = $('#tbl-raw-data').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "searching": true,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        buttons : [
            { extend: 'excel',
              title: 'Raw Data',
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
                d.mod = "raw_data|raw_data_api|list";
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
            { "data": "client"},
            { "data": "tracking_number" },
            { "data": "status" },
            { "data": "payment_type" },
            { "data": "total_price" },
            { "data": "declared_value" },
            { "data": "package_length" },
            { "data": "package_width" },
            { "data": "package_height" },
            { "data": "package_weight" },
            { "data": "shipping_type" },
            { "data": "first_attempt_status" },
            { "data": "first_attempt_date" },
            { "data": "first_attempt_description" },
            { "data": "second_attempt_description" },
            { "data": "third_attempt_description" },
            { "data": "transfer_date" },
            { "data": "last_status_date" },
            { "data": "picked_date" },
            { "data": "last_delivery_date" },
            { "data": "handover_date" },
            { "data": "location" },
            { "data": "created_at" },
            { "data": "consignee_province" },
            { "data": "consignee_city"},
            { "data": "consignee_barangay" },
            { "data": "port" },
            { "data": "area" },
            { "data": "area2" },
            { "data": "lh" },
            { "data": "sla" },
            { "data": "plus_sla" },
            { "data": "total_sla" },
            { "data": "volume" },
            { "data": "delivered" },
            { "data": "lt" },
            { "data": "otp" },
            { "data": "first_attempt_within_lt" },
            { "data": "first_attempt_dispatch_vol" },
            { "data": "transfer" },
            { "data": "fd" },
            { "data": "fd_reason" },
            { "data": "open" },
            { "data": "claims" },
            { "data": "pickup_to_ho_lt" },
            { "data": "lh_lt" },
            { "data": "lm_dispatch_lt" },
            { "data": "week_no" },
            { "data": "handover_date2" },
            { "data": "month" },
            { "data": "year" },
            { "data": "m_and_y" },

        ]
    });

    // $('#btn-export').on("click", function() {
    //     table.button('.buttons-excel').trigger();
    // });
}