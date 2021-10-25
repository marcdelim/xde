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
    
    getPackagePercent(myPieChart);

});


async function getPackagePercent(chart){
    $.ajax({
        type: "GET",
        url: 'trend/package_percentage',
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.package;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

