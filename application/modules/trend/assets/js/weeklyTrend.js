var ctx = $("#chart-trend");
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
       labels: [], // responsible for how many bars are gonna show on the chart
       // create 12 datasets, since we have 12 items
       // data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
       // put 0, if there is no data for the particular bar
       datasets: [
        {
            type: 'line',
            label: 'Volume',
            data:[],
            borderColor: "#00FF00",
            stacked: false,
            fill: false,
        },
        {
            type: 'line',
            label: 'Daily Ave',
            data:[],
            borderColor: "#00008b",
            stacked: false,
            fill: false,
        },
        {
          label: 'GMA',
          data: [],
          backgroundColor: '#ADD8E6',
          stack: 'Stack 0',
       }, {
          label: 'N-Luzon',
          data: [],
          backgroundColor: '#FFA500',
          stack: 'Stack 0',
       }, {
          label: 'S-Luzon',
          data: [0, 1],
          backgroundColor: '#808080',
          stack: 'Stack 0',
       }, {
          label: 'Visayas',
          data: [5, 2],
          backgroundColor: '#FFFF00',
          stack: 'Stack 0',
       }, {
          label: 'Mindanao',
          data: [0, 1],
          backgroundColor: '#0000FF',
          stack: 'Stack 0',
       }]
    },
    options: {
       responsive: true,
       legend: {
          position: 'bottom' // place legend on the right side of chart
       },
       scales: {
          xAxes: [{
             stacked: true // this should be set to make the bars stacked
          }]
       }
    }
 });

 $(document).ready(function() {
    
    getWeeklyVolume(chart);

});


async function getWeeklyVolume(chart){
    $.ajax({
        type: "GET",
        url: 'trend/weekly_trend',
        success: function(response){
            var parsed = JSON.parse(response);
            chart.data.labels = parsed.week_no;
            chart.data.datasets[0].data = parsed.data.volume;
            chart.data.datasets[1].data = parsed.data.ave;
            chart.data.datasets[2].data = parsed.data.gma;
            chart.data.datasets[3].data = parsed.data.north;
            chart.data.datasets[4].data = parsed.data.south;
            chart.data.datasets[5].data = parsed.data.visayas;
            chart.data.datasets[6].data = parsed.data.mindanao;
            chart.update(); // finally update our chart
        }
   });
}