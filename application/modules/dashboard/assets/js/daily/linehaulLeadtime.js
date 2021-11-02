var ctxLineHaulLeadtime = $("#chart-linehaul-leadtime");
var LinehaulLeadtimeChart = new Chart(ctxLineHaulLeadtime, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Average of LH LT',
                data:[],
                borderColor: "#808080",
                yAxisID: 'B',
                fill: false,

                
            },
            {
                data: [],
                label: "Ship Volume",
                borderColor: "#00FF00",
                backgroundColor: '#00FF00',
                fill: false,
               
            },  
            {
                data: [],
                label: "Transfer Volume",
                borderColor: "#FFC300",
                backgroundColor: '#FFC300',
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
    
    getLinehaulLeadtime(LinehaulLeadtimeChart, 'All', 'All', 'All', 'All', 'All');

});


async function getLinehaulLeadtime(chart, area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/linehaul_leadtime',
        data: "group=handover_date&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.ave;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.trans_vol;
            chart.update(); // finally update our chart
        }
   });
}


$( ".selectpicker" ).change(function() {
    //var id = $(this).attr("id");
    var area = $("#area_id").find(":selected").text();
    var area2 = $("#area2_id").find(":selected").text();
    var province = $("#province_id").find(":selected").text();
    var city = $("#city_id").find(":selected").text();
    var payment = $("#payment_id").find(":selected").text();
    getLinehaulLeadtime(LinehaulLeadtimeChart, area, area2, province, city, payment);
});