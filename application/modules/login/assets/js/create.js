$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var costWrapper = $('.cost-wrapper');
    var x = 1; //Initial field counter is 1
    
    var startDiv = '<div><div class="panel-body" style="border-style:groove;">';
    var startCost =  '<div id="div_cost"><div class="panel-body" style="border-style:groove;">';
    var removeBill = '<a href="javascript:void(0);" class="remove_button" title="Delete"><img src="https://icon-library.net/images/delete-icon-transparent-background/delete-icon-transparent-background-7.jpg" style="width:30px; height:30px;"/></a>';
    var billRef = '<div class="row"><div class="form-group col-md-12"><label for="bill_ref[]">Billing Reference</label><input type="text" class="form-control" id="bill_ref[]" name="bill_ref[]"></div></div';
    var invoiceDate = '<div class="row"><div class="form-group col-md-6"><label for="invoice_date">Invoice Date</label><input required="required" type="date" class="form-control" id="invoice_date" name="invoice_date[]"></div>';
    var invoiceReceiveDate = '<div class="form-group col-md-6"><label for="invoice_receive_date">Invoice Receive Date</label><input required="required" type="date" class="form-control" id="invoice_receive_date" name="invoice_receive_date[]"></div></div>';
    var dueDate = '<div class="row"><div class="form-group col-md-6"><label for="due_date">Due Date</label><input type="date" class="form-control" id="due_date" name="due_date"></div>';
    var amount = '<div class="form-group col-md-6"><label for="amount">Amount</label><input type="text" class="form-control" id="amount" name="amount[]"></div></div>';
    var naturePayment ='<div class="row"><div class="form-group col-md-12"><label for="nature_payment">Nature of Payment</label><select required="required" class="form-control" id="nature_payment'+x+'" name="nature_payment[]"><option value="" selected>Select your option</option></select></div>';
    var attachment = '<div class="form-group col-md-12"><label for="file_name">Attachment</label><input type="file" class="form-control" id="file_name" name="file_name[]"></div>';
    var particular = '<div class="form-group col-md-12"><label for="particular">Particular</label><textarea class="form-control" name="particular[]" id="particular"></textarea></div>';
    var addAnother = '<div class="col-md-12"><a href="javascript:void(0);" class="add_buttons1" title="Add"><img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/add-circle-blue-512.png" style="width:30px; height:30px;"/>Add Billing Reference</a></div>';
    var endDiv = '</div></div>'
    
    var addButton = $('.add_button'); //Add button selector
    var addCost = $('.add_cost');
    var fieldHTML = startDiv + removeBill + billRef + invoiceDate + invoiceReceiveDate + dueDate + amount + naturePayment + attachment + particular + addAnother + endDiv;
    
    var removeCost = '<a href="javascript:void(0);" class="remove_cost" title="Delete"><img src="https://icon-library.net/images/delete-icon-transparent-background/delete-icon-transparent-background-7.jpg" style="width:30px; height:30px;"/></a>';
    var costCenter='<div class="row"><div class="form-group col-md-6"><label for="cost_center">Cost Center</label><select required="required" class="form-control" id="cost_center'+x+'" name="cost_center[]"><option value="" selected>Select your option</option></select></div>';
    var costAmount='<div class="form-group col-md-6"><label for="cost_amount">Cost Amount</label><input type="text" required="required" class="form-control" id="cost_amount" name="cost_amount[]"></div></div>';
    var costAdd = '<a href="javascript:void(0);" class="add_costs1" style="margin-top:100%;" title="Add"><img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/add-circle-blue-512.png" style="width:30px; height:30px;"/>Add Cost Center</a>';
    
    var costHTML = startCost + removeCost + costCenter + costAmount + costAdd + endDiv;
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            var naturePayment ='<div class="row"><div class="form-group col-md-12"><label for="nature_payment">Nature of Payment</label><select required="required" class="form-control" id="nature_payment'+x+'" name="nature_payment[]"><option value="" selected>Select your option</option></select></div>';
            var fieldHTML = startDiv + removeBill + billRef + invoiceDate + invoiceReceiveDate + dueDate + amount + naturePayment + attachment + particular + addAnother + endDiv;
    
            $(wrapper).append(fieldHTML); //Add field html

            sum_function();
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        
                        $("#nature_payment"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });

           
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(wrapper).on('click', '.add_buttons1', function(e){
        if(x < maxField){ 
            x++; //Increment field counter
            var naturePayment ='<div class="row"><div class="form-group col-md-12"><label for="nature_payment">Nature Payment</label><select required="required" class="form-control" id="nature_payment'+x+'" name="nature_payment[]"><option value="" selected>Select your option</option></select></div>';
            
            var fieldHTML = startDiv + removeBill + billRef + invoiceDate + invoiceReceiveDate + dueDate + amount + naturePayment + attachment + particular + addAnother + endDiv;
    
            $(wrapper).append(fieldHTML); //Add field html
            sum_function();
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        
                        $("#nature_payment"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });
        }
    });

    $(addCost).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            var costCenter='<div class="row"><div class="form-group col-md-6"><label for="cost_center">Cost Center</label><select class="form-control" id="cost_center'+x+'" name="cost_center[]"><option value="" selected>Select your option</option></select></div>';
           
            var costHTML = startCost + removeCost + costCenter + costAmount + costAdd + endDiv;
            $(costWrapper).append(costHTML); //Add field html
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        
                        $("#cost_center"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });
        }
    });

    $(costWrapper).on('click', '.add_costs1', function(e){
        if(x < maxField){ 
            x++; //Increment field counter
            var costCenter='<div class="row"><div class="form-group col-md-6"><label for="cost_center">Cost Center</label><select class="form-control" id="cost_center'+x+'" name="cost_center[]"><option value="" selected>Select your option</option></select></div>';
           
            var costHTML = startCost + removeCost + costCenter + costAmount + costAdd + endDiv;
            $(costWrapper).append(costHTML); //Add field html
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        //$("#cost_center").append(new Option(data.rfp_number, data.payment_id));
                        
                        $("#cost_center"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });
        }
    });

    $(costWrapper).on('click', '.remove_cost', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


    $('#shared_cost').change(function(){
        
        myFunction();
    });

    sum_function();

    

});




function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("shared_cost");
    // Get the output text
    var div_cost = document.getElementById("div_cost");
  
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      div_cost.style.display = "block";
    } else {
      div_cost.style.display = "none";
    }
}

//Function to sum the values and assign it to the last input field

function sum_function(){
    var elements = document.getElementsByName("amount[]");
    var element_array = Array.prototype.slice.call(elements);
    for(var i=0; i < element_array.length; i++){
        element_array[i].addEventListener("keyup", sum_values);
    }

    function sum_values(){
        var sum = 0;
        for(var i=0; i < element_array.length; i++){

           if(isNaN(parseInt(element_array[i].value, 10))){
               sum += 0;
           }else{

               sum += parseInt(element_array[i].value, 10);
           }

        }
        if(isNaN(sum)){

            document.getElementsByName("total_amount")[0].value = '';
        }else{
            document.getElementsByName("total_amount")[0].value = sum;
        }
    }
}
