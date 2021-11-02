var ctx = $("#chart-volume-percent");
var myVolumePercent = new Chart(ctx,{
    type: 'pie',
    data: {
        labels: [],
        datasets: [
            {
                data: [],
                backgroundColor: [
                    "#ADD8E6",
                    "#0000FF",
                    "#FFA500",
                    '#808080',
                    '#FFFF00'
                ]
            }]
    }
});


$(document).ready(function() {
    
    getVolumePercent(myVolumePercent, 'All', 'All', 'All');

});


async function getVolumePercent(chart, province, city, payment){
    $.ajax({
        type: "GET",
        data: "province="+province+"&city="+city+"&payment="+payment,
        url: 'trend/volume_percentage',
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.area;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

$( ".selectpicker" ).change(function() {
    var province = $("#province_id").find(":selected").text();
    var city = $("#city_id").find(":selected").text();
    var payment = $("#payment_id").find(":selected").text();
    getVolumePercent(myVolumePercent, province, city, payment);
 });

