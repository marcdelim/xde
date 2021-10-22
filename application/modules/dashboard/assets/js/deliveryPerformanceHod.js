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
    
    getDeliveryPerformanceHod('All', 'All');

});


async function getDeliveryPerformanceHod(area_id, area2_id){
    $.ajax({
        type: "GET",
        url: 'dashboard/delivery_performance_hod',
        data: "area_id="+area_id+"&area2_id="+area2_id,
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#delivery-performance-hod tbody').empty();
            $('#delivery-performance-hod thead').empty();
            let table = document.querySelector("#delivery-performance-hod");
            let header = Object.keys(queryData[0]);
            generateTable(table, queryData);
            generateTableHead(table, header);
        }
   });
}

//area 1 on change
$('#area_id').on('change', function() {
    var area2_id = $("#area2_id").find(":selected").text(); //getting value of area 2
    getDeliveryPerformanceHod(this.value, area2_id);
});

//area 2 on change
$('#area2_id').on('change', function() {
    var area_id = $("#area_id").find(":selected").text(); //getting value of area
    getDeliveryPerformanceHod(area_id, this.value);
});