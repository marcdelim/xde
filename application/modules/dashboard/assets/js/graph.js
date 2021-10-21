var ctxDelPercentage = $("#chart-del-percentage");
var DelPercentageChart = new Chart(ctxDelPercentage, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                data: [],
                label: "Ship Volume",
                borderColor: "#00FF00",
                backgroundColor: '#00FF00',
                fill: false,
               
            }, 
            {
                data: [],
                label: "Delivery Volume",
                borderColor: "#458af7",
                fill: true,
                backgroundColor: '#458af7',
            }, 
            {
                type: 'line',
                label: 'Percentage',
                data:[],
                borderColor: "#458af7",
                yAxisID: 'B',
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
                type: 'linear',
                position: 'right',
                ticks: {
                    max: 100,
                    min: 0
                }
            }],
            
        }
    },
    legend: { display: true }
});

$(document).ready(function() {
    
    getDelPercentage(DelPercentageChart, 'All', 'All');

});


async function getDelPercentage(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/del_percentage',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.ship_vol; // or you can iterate for multiple datasets
            chart.data.datasets[1].data = parsed.data.del_vol;
            chart.data.datasets[2].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getDelPercentage(DelPercentageChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getDelPercentage(DelPercentageChart, area_id, this.value);
});