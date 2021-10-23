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
    
    getFailedAreaCodTable();

});


async function getFailedAreaCodTable(){
    $.ajax({
        type: "GET",
        url: 'fdsplit/failed_cod_area',
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
