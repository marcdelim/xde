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
    
    getFailedAreaCodTable('All', 'All');

});


async function getFailedAreaCodTable(province, city){
    $.ajax({
        type: "GET",
        url: 'fdsplit/failed_area_cod',
        data: "province="+province+"&city="+city,
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#failed-area-cod tbody').empty();
            $('#failed-area-cod thead').empty();
            let table = document.querySelector("#failed-area-cod");
            let header = Object.keys(queryData[0]);
            generateTable(table, queryData);
            generateTableHead(table, header);
        }
   });
}

$( ".selectpicker" ).change(function() {
  //var id = $(this).attr("id");
  var province = $("#province_id").find(":selected").text();
  var city = $("#city_id").find(":selected").text();
  getFailedAreaCodTable( province, city);
});
