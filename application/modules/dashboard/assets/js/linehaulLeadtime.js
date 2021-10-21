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
    
    getLinehaulLeadtime(LinehaulLeadtimeChart, 'All', 'All');

});


async function getLinehaulLeadtime(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/linehaul_leadtime',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.ave;
            chart.data.datasets[1].data = parsed.data.ship_vol;
            chart.data.datasets[2].data = parsed.data.trans_vol;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getLinehaulLeadtime(LinehaulLeadtimeChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getLinehaulLeadtime(LinehaulLeadtimeChart, area_id, this.value);
});