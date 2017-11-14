$(document).ready(function(){ 
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url: base_url + "artist/ajax_data",
                //url:'<?php echo base_url() . "artist/ajax_data"; ?>',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url: base_url + "artist/ajax_data",
                //url:'<?php echo base_url() . "artist/ajax_data"; ?>',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});



// multiple skill start

$(function(){
        $('#skills').multiSelect();
    });
    
// other category input open start

$('#skills').change(function other_category(){
        // var e = document.getElementById("skills");
        // var strUser = e.options[e.selectedIndex].value;
       var strUser1 = $('#skills').val();
       var strUser =  "'" + strUser1 + "'";
       var n = strUser.includes(26);
      
        if(n == true){ 

            $("span").removeClass("custom-mini-select");
            var active = document.querySelector(".multi-select-container");        
            active.classList.remove("multi-select-container--open");
            document.getElementById('other_category').style.display = "block";
        }else if(strUser1 == ''){
          $("span").addClass("custom-mini-select");
        }

        else{ 
            $("span").removeClass("custom-mini-select");
            document.getElementById('other_category').style.display = "none"; 
        }
    });

function removevalidation(){

   $("#othercategory").removeClass("othercategory_require");
   $('#othercategory_error').remove();    
}

function validation_other(event){ 
  
  $('#othercategory_error').remove(); 
       event.preventDefault();
       var strUser1 = $('#skills').val();
       var strUser =  "'" + strUser1 + "'";

       var length_ele = strUser.split(',');
       var n = strUser.includes(26);
        var other_category = document.getElementById("othercategory").value;
       var category_trim = other_category.trim();

    if(strUser1 != ''){ 
      if(length_ele.length <= 10){
          if(n == true){     
        if(category_trim == ''){
       $("#othercategory").addClass("othercategory_require");
       $('<span class="error" id="othercategory_error" style="float: right;color: red; font-size: 13px;">Other art category required. </span>').insertAfter('#othercategory');
        return false;
        event.preventDefault();
         } 
         else{ 
          if(category_trim){
                $.ajax({                
                   type: 'GET',
                   url: base_url + "artist/check_category",
                   data: 'category=' + category_trim,
                   success: function (data) { 
                    if(data == 'true'){ 
                    $("#othercategory").addClass("othercategory_require");
                   $('<span class="error" id="othercategory_error" style="float: right;color: red; font-size: 13px;">This category already exists in art category field. </span>').insertAfter('#othercategory');
                   } else{ 
                     $("#artinfo")[0].submit();                  
                   }                 
                   }
               });
           }
         }
       }else if((n == false && category_trim != '') || n == false && category_trim == ''){ 
         $("#artinfo")[0].submit();     
       }
   }else{
       $("#skills").addClass("othercategory_require");
       $('<span class="error" id="othercategory_error" style="float: right;color: red; font-size: 13px;">You can select at max 10 Art category. </span>').insertAfter('#skills');
        return false;
        event.preventDefault();
   }
 }else{ 
      return false;
        event.preventDefault();
   }
}

jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");

$.validator.addMethod("regx", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Only space and only number are not allow.");


            $(document).ready(function () { 

                $("#artist_regform").validate({

                   ignore: '*:not([name])',
                    rules: {

                        firstname: {

                            required: true,
                            regx: /^[a-zA-Z\s]*[a-zA-Z]/,
                            noSpace: true
                        },


                        lastname: {

                            required: true,
                            regx: /^[a-zA-Z\s]*[a-zA-Z]/,
                            noSpace: true
                        },


                        email: {
                            required: true,
                            email: true,
                        },

                        phoneno: {

                            number: true,
                             minlength: 8,
                           maxlength:15
                           
                            
                        },

                        country: {

                            required: true,
                         
                        },

                         state: {

                            required: true,
                            
                          
                        },
                        city: {

                            required: true,
                            
                          
                        },

                        "skills[]": {

                    required: true,

                },          

                    },

                    messages: {

                        firstname: {

                            required: "First name is required.",
                            
                        },

                        lastname: {

                            required: "Last name is required.",
                            
                        },

                        email: {
                            required: "Email id is required",
                            email: "Please enter valid email id",
                            remote: "Email already exists"
                        },

                         country: {

                            required: "Country is required.",
                            
                        },

                        state: {

                            required: "State is required.",
                            
                        },
                        city: {

                            required: "City is required.",
                            
                        },

                         "skills[]": {

                        required: "Skill is required.",
                   
                    },
                        
                    },

                });
                   });