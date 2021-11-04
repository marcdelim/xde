var ctxFailedNonCod = $("#chart-failed-non-cod");
var FailedNonCodChart = new Chart(ctxFailedNonCod, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'FD %',
                data:[],
                borderColor: "#FF0000",
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
                borderColor: "#FF0000",
                fill: true,
                backgroundColor: '#FF0000',
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
                ticks: {
                    max: 100,
                    min: 0
                },
                gridLines:{
                    display: false,
                }
            }],
            
        }
    },
    legend: { display: true }
});


$(document).ready(function() {
    
    getFailedNonCod(FailedNonCodChart, 'All', 'All');

});


async function getFailedNonCod(chart, province, city){
    $.ajax({
        type: "GET",
        data: "group=handover_date&province="+province+"&city="+city,
        url: 'fdsplit/failed_non_cod',
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.failed;
            chart.update(); // finally update our chart
        }
   });
}

$( ".selectpicker" ).change(function() {
    //var id = $(this).attr("id");
    var province = $("#province_id").find(":selected").text();
    var city = $("#city_id").find(":selected").text();
    getFailedCod(FailedNonCodChart, province, city);
});
