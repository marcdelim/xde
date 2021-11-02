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
    getDelOtpPercentage(DelOtpPercentageChart, 'All', 'All', 'All', 'All', 'All');

});

async function getDelOtpPercentage(chart, area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/del_otp_percentage',
        data: "group=handover_date&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.del_vol;
            chart.data.datasets[2].data = parsed.data.otp_vol;
           
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
    getDelOtpPercentage(DelOtpPercentageChart, area, area2, province, city, payment);
});