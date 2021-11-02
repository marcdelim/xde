var ctx = $("#chart-package-type");
var myPieChart = new Chart(ctx,{
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
                ]
            }]
    }
});


$(document).ready(function() {
    
    getPackagePercent(myPieChart, 'All', 'All', 'All');

});


async function getPackagePercent(chart, province, city, payment){
    $.ajax({
        type: "GET",
        data: "province="+province+"&city="+city+"&payment="+payment,
        url: 'trend/package_percentage',
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.package;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

$( ".selectpicker" ).change(function() {
    var province = $("#province_id").find(":selected").text();
    var city = $("#city_id").find(":selected").text();
    var payment = $("#payment_id").find(":selected").text();
    getPackagePercent(myPieChart, province, city, payment);
 });

