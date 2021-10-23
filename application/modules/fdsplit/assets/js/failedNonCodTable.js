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
    
    getFailedNonCodTable();

});


async function getFailedNonCodTable(){
    $.ajax({
        type: "GET",
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
