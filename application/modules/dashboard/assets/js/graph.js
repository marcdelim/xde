$(document).ready(function() {
    var ctx = $("#chart-line");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    data: [],
                    label: "Ship Volume",
                    borderColor: "#458af7",
                    backgroundColor: '#458af7',
                    fill: false
                }, {
                    data: [],
                    label: "Delivery Volume",
                    borderColor: "#8e5ea2",
                    fill: true,
                    backgroundColor: '#8e5ea2'
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Delivery Percentage'
            }
        },
    });

    getDelPercentage(myLineChart)
   
    // var ctx = $("#chart-test");
    // var asia = [2822, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267];
    // var myLineChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
    //         datasets: [
    //             {
    //                 data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
    //                 label: "Africa",
    //                 borderColor: "#458af7",
    //                 backgroundColor: '#458af7',
    //                 fill: false
    //             }, {
    //                 data: asia,
    //                 label: "Asia",
    //                 borderColor: "#8e5ea2",
    //                 fill: true,
    //                 backgroundColor: '#8e5ea2'
    //             }, {
    //                 type: 'line',
    //                 label: 'Percentage',
    //                 data:[250, 350, 450, 550, 650, 850, 1250, 2450, 5000, 4200],
    //                 borderColor: "#000000",
    //                 fill: false,
    //                 scales: {
    //                     x: {
    //                         ticks: {
    //                             // Include a dollar sign in the ticks
    //                             callback: function(value, index, values) {
    //                                 return '$' + value;
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         ]
    //     },
    //     options: {
    //         title: {
    //             display: true,
    //             text: 'World population per region (in millions)'
    //         }
    //     },
    // });
});


async function getDelPercentage(chart){
    $.ajax({
        type: "POST",
        url: 'dashboard/del_percentage',
        data: "check",
        success: function(response){
            var parsed = JSON.parse(response);
            console.log(parsed);
            chart.data.labels = parsed.week_no;
            console.log(chart.data.labels);
            chart.data.datasets[0].data = parsed.data.ship_vol; // or you can iterate for multiple datasets
            chart.data.datasets[1].data = parsed.data.del_vol;
            chart.update(); // finally update our chart
        }
   });
}