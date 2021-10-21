var ctxDelLeadtime = $("#chart-del-leadtime");
var DelLeadtimeChart = new Chart(ctxDelLeadtime, {
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
               
            }, 
            {
                data: [],
                label: "Delivery Volume",
                borderColor: "#458af7",
                fill: true,
                backgroundColor: '#458af7',
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
    
    getDelLeadtime(DelLeadtimeChart, 'All', 'All');

});


async function getDelLeadtime(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/del_leadtime',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.ave;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.del_vol;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getDelLeadtime(DelPercentageChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getDelLeadtime(DelPercentageChart, area_id, this.value);
});