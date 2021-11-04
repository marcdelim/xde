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
    
    getFailedNonCodTable('All', 'All');

});


async function getFailedNonCodTable(province, city){
    $.ajax({
        type: "GET",
        data: "group=handover_date&province="+province+"&city="+city,
        url: 'fdsplit/failed_non_cod_tbl',
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#failed-non-cod tbody').empty();
            $('#failed-non-cod thead').empty();
            let table = document.querySelector("#failed-non-cod");
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
  getFailedNonCodTable( province, city);
});
