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
    
    getPackageTable('All', 'All', 'All');

});


async function getPackageTable(province, city, payment){
    $.ajax({
        type: "GET",
        data: "group=handover_date&province="+province+"&city="+city+"&payment="+payment,
        url: 'trend/package_table',
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#package-table tbody').empty();
            $('#package-table thead').empty();
            let table = document.querySelector("#package-table");
            let header = Object.keys(queryData[0]);
            generateTable(table, queryData);
            generateTableHead(table, header);
        }
   });
}

$( ".selectpicker" ).change(function() {
  var province = $("#province_id").find(":selected").text();
  var city = $("#city_id").find(":selected").text();
  var payment = $("#payment_id").find(":selected").text();
  getPackageTable(province, city, payment);
});
