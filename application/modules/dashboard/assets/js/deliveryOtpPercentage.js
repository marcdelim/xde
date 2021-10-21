//delivery OTP Percentage
var ctxDelOtpPercentage = $("#chart-del-otp-percentage");
var DelOtpPercentageChart = new Chart(ctxDelOtpPercentage, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Percentage',
                data:[],
                borderColor: "#ff8c00",
                yAxisID: 'B',
                fill: false,
            },
            {
                data: [],
                label: "Delivery Volume",
                borderColor: "#458af7",
                backgroundColor: '#458af7',
                fill: false,
               
            }, 
            {
                data: [],
                label: "OTP Volume",
                borderColor: "#ff8c00",
                fill: true,
                backgroundColor: '#ff8c00',
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
    getDelOtpPercentage(DelOtpPercentageChart, 'All', 'All');

});

async function getDelOtpPercentage(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/del_otp_percentage',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.del_vol;
            chart.data.datasets[2].data = parsed.data.otp_vol;
           
            chart.update(); // finally update our chart
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getDelOtpPercentage(DelOtpPercentageChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getDelOtpPercentage(DelOtpPercentageChart, area_id, this.value);
});