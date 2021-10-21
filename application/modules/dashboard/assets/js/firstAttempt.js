var ctxFirstAttempt = $("#chart-first-attempt");
var FirstAttemptChart = new Chart(ctxFirstAttempt, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                data: [],
                label: "Delivery Volume",
                borderColor: "#458af7",
                backgroundColor: '#458af7',
                fill: false,
               
            }, 
            {
                data: [],
                label: "1st Attempt",
                borderColor: "#FFC300",
                fill: true,
                backgroundColor: '#FFC300',
            }, 
            {
                type: 'line',
                label: 'Percentage',
                data:[],
                borderColor: "#FFC300",
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
    
    getFirstAttempt(FirstAttemptChart, 'All', 'All');

});


async function getFirstAttempt(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/first_attempt',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.del_vol; // or you can iterate for multiple datasets
            chart.data.datasets[1].data = parsed.data.first;
            chart.data.datasets[2].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getFirstAttempt(FirstAttemptChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getFirstAttempt(FirstAttemptChart, area_id, this.value);
});