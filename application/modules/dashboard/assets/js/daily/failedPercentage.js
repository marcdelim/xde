var ctxFailedPercentage = $("#chart-failed-percentage");
var FailedPercentageChart = new Chart(ctxFailedPercentage, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Percentage',
                data:[],
                borderColor: "#C70039",
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
                label: "Failed Volume",
                borderColor: "#C70039",
                fill: true,
                backgroundColor: '#C70039',
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
                type: 'linear',
                position: 'right',
                gridLines:{
                    display: false,
                }
            }],
            
        }
    },
    legend: { display: true }
});


$(document).ready(function() {
    
    getFailedPercentage(FailedPercentageChart, 'All', 'All', 'All', 'All', 'All');

});


async function getFailedPercentage(chart,area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/failed_percentage',
        data: "group=handover_date&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.failed_vol;
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
    getFailedPercentage(FailedPercentageChart, area, area2, province, city, payment);
});