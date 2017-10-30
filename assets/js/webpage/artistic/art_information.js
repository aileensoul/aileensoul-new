jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");


$.validator.addMethod("regx", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Only space and only number are not allow.");

            $(document).ready(function () { 

                $("#artinfo").validate({ 
  
                  ignore: '*:not([name])',
                    rules: {

                        "skills[]": {

                    required: true,

                },                       
                    },

                    messages: {

                         "skills[]": {

                    required: "Skill is required.",
                   
                    },
                },

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
       var strUser = $('#skills').val();
       var strUser =  "'" + strUser + "'";
       var n = strUser.includes(17);
        if(n == true){ 
            document.getElementById('other_category').style.display = "block";
        }else{ 
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
       var strUser = $('#skills').val();
       var strUser =  "'" + strUser + "'";
       var n = strUser.includes(17);

        var other_category = document.getElementById("othercategory").value;
       var category_trim = other_category.trim();

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
                 url: base_url + "artistic/check_category",
                 data: 'category=' + category_trim,
                 success: function (data) { 
                  if(data == 'true'){ 
                  $("#othercategory").addClass("othercategory_require");
                 $('<span class="error" id="othercategory_error" style="float: right;color: red; font-size: 13px;">Art category already exists in art category field. </span>').insertAfter('#othercategory');
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
}


jQuery(document).ready(function($) {  
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});

textarea.onkeyup = function(evt) {
    this.scrollTop = this.scrollHeight;
}

function checkvalue() {
                           
        var searchkeyword =$.trim(document.getElementById('tags').value);
        var searchplace =$.trim(document.getElementById('searchplace').value);
                           
           if (searchkeyword == "" && searchplace == "") {
                                return false;
                            }
 }

  function check() {

                 var keyword = $.trim(document.getElementById('tags1').value);
                 var place = $.trim(document.getElementById('searchplace1').value);
                 if (keyword == "" && place == "") {
                    return false;
                }
}


$(document).ready(function () {
var input = $("#skills2");
var len = input.val().length;
input[0].focus();
input[0].setSelectionRange(len, len);
 });
$(".alert").delay(3200).fadeOut(300);