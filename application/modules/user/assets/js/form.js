$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation]
    var wrapper = $('.approver-wrapper');
    var x = 1; //Initial field counter is 1
    
    var startDiv =  '<div id="div_approver"><div class="panel-body" style="border-style:groove;">';
    var endDiv = '</div></div>'
    
    var add = $('.add_approver');
    
    var buttonRemove = '<a href="javascript:void(0);" class="remove" title="Delete"><img src="/rfp/assets/images/remove.jpeg" style="width:30px; height:30px;"/></a>';
    var buttonAdd = '<a href="javascript:void(0);" class="add_approver1" style="margin-top:100%;" title="Add"><img src="/rfp/assets/images/add.png" style="width:30px; height:30px;"/>Add Next Level Approver</a>';
    
    $(add).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            
            x++; //Increment field counter
            var approver ='<div class="row"><div class="form-group col-md-12"><label for="email">Approver Email Address</label><input class="form-control" type="text" name="email_address[]" id="email" required></div></div>';
           
            var approverHTML = startDiv + buttonRemove + approver + buttonAdd + endDiv;
            $(wrapper).append(approverHTML); //Add field html]
           
        }
    });

    $(wrapper).on('click', '.add_approver1', function(e){
        if(x < maxField){ 
            x++; //Increment field counter
            var approver ='<div class="row"><div class="form-group col-md-12"><label for="email">Approver Email Address</label><input class="form-control" type="text" name="email_address[]" id="email" required></div></div>';
           
            var approverHTML = startDiv + buttonRemove + approver + buttonAdd + endDiv;
            $(wrapper).append(approverHTML); //Add field html]
        }
    });

    $(wrapper).on('click', '.remove', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });



});





