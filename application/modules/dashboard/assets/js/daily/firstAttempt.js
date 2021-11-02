var ctxFirstAttempt = $("#chart-first-attempt");
var FirstAttemptChart = new Chart(ctxFirstAttempt, {
    type: 'bar',
    
    data: {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Percentage',
                data:[],
                borderColor: "#FFC300",
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
                label: "1st Attempt",
                borderColor: "#FFC300",
                fill: true,
                backgroundColor: '#FFC300',
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
    
    getFirstAttempt(FirstAttemptChart, 'All', 'All', 'All', 'All', 'All');

});


async function getFirstAttempt(chart, area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/first_attempt',
        data: "group=handover_date&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.label;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.data.datasets[1].data = parsed.data.del_vol; // or you can iterate for multiple datasets
            chart.data.datasets[2].data = parsed.data.first;
            
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
    getFirstAttempt(FirstAttemptChart, area, area2, province, city, payment);
});