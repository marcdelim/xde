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
    
    getDeliveryPerformance('All', 'All', 'All', 'All', 'All');

});


async function getDeliveryPerformance(area, area2, province, city, payment){
    $.ajax({
        type: "GET",
        url: 'dashboard/delivery_performance',
        data: "group=month&area="+area+"&area2="+area2+"&province="+province+"&city="+city+"&payment="+payment,
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

$( ".selectpicker" ).change(function() {
  //var id = $(this).attr("id");
  var area = $("#area_id").find(":selected").text();
  var area2 = $("#area2_id").find(":selected").text();
  var province = $("#province_id").find(":selected").text();
  var city = $("#city_id").find(":selected").text();
  var payment = $("#payment_id").find(":selected").text();
  getDeliveryPerformance(area, area2, province, city, payment);
});