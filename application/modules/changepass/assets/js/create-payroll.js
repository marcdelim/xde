$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var payeeWrapper = $('.payee-wrapper');
    var x = 1; //Initial field counter is 1
    
    var startDiv = '<div id="div_cost"><div class="panel-body" style="border-style:groove;">';
    var endDiv = '</div></div>'
    
    var addPayee = $('.add_payee');
    
    var removePayee = '<a href="javascript:void(0);" class="remove_cost" title="Delete"><img src="https://icon-library.net/images/delete-icon-transparent-background/delete-icon-transparent-background-7.jpg" style="width:30px; height:30px;"/></a>';
    var payee='<div class="row"><div class="form-group col-md-6"><label for="payee">Payee</label><select required="required" class="form-control" id="payee'+x+'" name="payee[]"><option value="" selected>Select your option</option></select></div>';
    var payeeAmount='<div class="form-group col-md-6"><label for="payee_amount">Amount</label><input type="text" required="required" class="form-control" id="payee_amount" name="payee_amount[]"></div></div>';
    var payeeAdd = '<a href="javascript:void(0);" class="add_payee1" style="margin-top:100%;" title="Add"><img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/add-circle-blue-512.png" style="width:30px; height:30px;"/>Add Payee</a>';
    
    var payeeHTML = startDiv + removePayee + payee + payeeAmount + payeeAdd + endDiv;
    

    $(addPayee).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            var payee='<div class="row"><div class="form-group col-md-6"><label for="payee">Payee</label><select required="required" class="form-control" id="payee'+x+'" name="payee[]"><option value="" selected>Select your option</option></select></div>';
    
            var payeeHTML = startDiv + removePayee + payee + payeeAmount + payeeAdd + endDiv;
            $(payeeWrapper).append(payeeHTML); //Add field html
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        
                        $("#payee"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });
        }
    });

    $(payeeWrapper).on('click', '.add_payee1', function(e){
        if(x < maxField){ 
            x++; //Increment field counter
            var payee='<div class="row"><div class="form-group col-md-6"><label for="payee">Payee</label><select required="required" class="form-control" id="payee'+x+'" name="payee[]"><option value="" selected>Select your option</option></select></div>';
    
            var payeeHTML = startDiv + removePayee + payee + payeeAmount + payeeAdd + endDiv;
            $(payeeWrapper).append(payeeHTML); //Add field html
            $.ajax({
                type: "GET",
                url: "pays",
                async: false,
                dataType: "json",
                success: function(pays) {
                    
                    $.each( pays, function( key, data ) {
                        
                        $("#payee"+x).append(
                            $('<option></option>').val(data.payment_id).html(data.rfp_number)
                        );
                    });

                    
                }
            });
        }
    });

    $(payeeWrapper).on('click', '.remove_cost', function(e){
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
