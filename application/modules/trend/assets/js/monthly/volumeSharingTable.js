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
    
    getVolumeSharingTable('All', 'All', 'All' );

});


async function getVolumeSharingTable(province, city, payment){
    $.ajax({
        type: "GET",
        data: "group=month&province="+province+"&city="+city+"&payment="+payment,
        url: 'trend/volume_sharing_table',
        success: function(response){
            let queryData =  JSON.parse(response);
            $('#volume-sharing tbody').empty();
            $('#volume-sharing thead').empty();
            let table = document.querySelector("#volume-sharing");
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
  getVolumeSharingTable(province, city, payment);
});
