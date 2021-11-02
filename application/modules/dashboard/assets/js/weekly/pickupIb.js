var ctxPickupIb = $("#chart-pickup-ib");
var PickupIbChart = new Chart(ctxPickupIb, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Average',
                data:[],
                borderColor: "#458af7",
                yAxisID: 'B',
                fill: false,

                
            },
            {
                data: [],
                label: "Ship Volume",
                borderColor: "#00FF00",
                backgroundColor: '#00FF00',
                fill: false,
               
            }
            
        ]
    },
    options: {
        scaleShowValues: true,
       scales: {
            yAxes: [{
                id: 'A',
                type: 'linear',
                position: 'left',
            }, {
                id: 'B',
                position: 'right',
                gridLines:{
                    display: false,
                }
            },
        ],
            
            
        }
    },
    legend: { display: true }
});


$(document).ready(function() {
    
    getPickupIb(PickupIbChart, 'All', 'All', 'All', 'All', 'All');

});


async function getPickupIb(chart, area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/pickup_ib',
        data: "group=week_no&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.ave;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$( ".selectpicker" ).change(function() {
    //var id = $(this).attr("id");
    var area = $("#area_id").find(":selected").text();
    var area2 = $("#area2_id").find(":selected").text();
    var province = $("#province_id").find(":selected").text();
    var city = $("#city_id").find(":selected").text();
    var payment = $("#payment_id").find(":selected").text();
    getPickupIb(PickupIbChart, area, area2, province, city, payment);
});