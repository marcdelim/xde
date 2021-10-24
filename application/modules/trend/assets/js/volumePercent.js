var ctx = $("#chart-volume-percent");
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
                    '#FFFF00'
                ]
            }]
    }
});


$(document).ready(function() {
    
    getVolumePercent(myPieChart);

});


async function getVolumePercent(chart){
    $.ajax({
        type: "GET",
        url: 'trend/volume_percentage',
        success: function(response){
            var parsed = JSON.parse(response);
            console.log(parsed);
            chart.data.labels = parsed.area;
            chart.data.datasets[0].data = parsed.data.percentage;
            chart.update(); // finally update our chart
        }
   });
}

