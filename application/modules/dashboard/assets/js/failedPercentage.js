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
    
    getFailedPercentage(FailedPercentageChart, 'All', 'All');

});


async function getFailedPercentage(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/failed_percentage',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.failed_vol;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getFailedPercentage(FailedPercentageChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getFailedPercentage(FailedPercentageChart, area_id, this.value);
});