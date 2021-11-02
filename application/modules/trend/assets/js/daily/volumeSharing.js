var ctxVolumeSharing = $("#chart-volume-sharing");
var chartVolumeSharing = new Chart(ctxVolumeSharing, {
    type: 'bar',
    data: {
       labels: [], // responsible for how many bars are gonna show on the chart
       // create 12 datasets, since we have 12 items
       // data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
       // put 0, if there is no data for the particular bar
       datasets: [
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
    
    getVolumeSharing(chartVolumeSharing, 'All', 'All', 'All');

});


async function getVolumeSharing(chart, province, city, payment){
   $.ajax({
       type: "GET",
       url: 'trend/trends',
       data: "group=handover_date&province="+province+"&city="+city+"&payment="+payment,
       success: function(response){
           var parsed = JSON.parse(response);
           chart.data.labels = parsed.label;
           chart.data.datasets[0].data = parsed.data.gma;
           chart.data.datasets[1].data = parsed.data.north;
           chart.data.datasets[2].data = parsed.data.south;
           chart.data.datasets[3].data = parsed.data.visayas;
           chart.data.datasets[4].data = parsed.data.mindanao;
           chart.update(); // finally update our chart
       }
  });
}

$( ".selectpicker" ).change(function() {
   var province = $("#province_id").find(":selected").text();
   var city = $("#city_id").find(":selected").text();
   var payment = $("#payment_id").find(":selected").text();
   getVolumeSharing(chartVolumeSharing, province, city, payment);
});