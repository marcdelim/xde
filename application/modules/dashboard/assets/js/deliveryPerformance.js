function generateTableHead(table, data) {
    let thead = table.createTHead();
    let row = thead.insertRow();
    for (let key of data) {
      let th = document.createElement("th");
      let text = document.createTextNode(key);
      th.appendChild(text);
      row.appendChild(th);
    }
  }
  
  function generateTable(table, data) {
    for (let element of data) {
      let row = table.insertRow();
      for (key in element) {
        let cell = row.insertCell();
        let text = document.createTextNode(element[key]);
        cell.appendChild(text);
      }
    }
  }
  
  

  $(document).ready(function() {
    
    getDeliveryPerformance(PickupIbChart, 'All', 'All');

});


async function getDeliveryPerformance(chart,area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/delivery_performance',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#delivery-performance tbody').empty();
            $('#delivery-performance thead').empty();
            let table = document.querySelector("#delivery-performance");
            let header = Object.keys(queryData[0]);
            generateTable(table, queryData);
            generateTableHead(table, header);
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getDeliveryPerformance(PickupIbChart, this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getDeliveryPerformance(PickupIbChart, area_id, this.value);
});