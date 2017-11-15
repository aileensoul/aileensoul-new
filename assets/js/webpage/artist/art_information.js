jQuery(document).ready(function($) {  
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});



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

function validate(){

  $("#multidropdown").addClass("error");
  //alert("falguni123");
}

$('#skills').change(function other_category(){
        // var e = document.getElementById("skills");
        // var strUser = e.options[e.selectedIndex].value;
       $("#multidropdown").removeClass("error");
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

// textarea.onkeyup = function(evt) {
//     this.scrollTop = this.scrollHeight;
// }

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
 var strUser1 = $('#skills').val();
 if(strUser1 != ''){
  $("span").removeClass("custom-mini-select");
 }
 });

$(".alert").delay(3200).fadeOut(300);


function cursorpointer(){

   elem = document.getElementById('desc_art');
   elem.focus();
  setEndOfContenteditable(elem);
}

function setEndOfContenteditable(contentEditableElement)
{
    var range,selection;
    if(document.createRange)
    {
        range = document.createRange();//Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection();//get the selection object (allows you to change selection)
        selection.removeAllRanges();//remove any selections already made
        selection.addRange(range);//make the range you have just created the visible selection
    }
    else if(document.selection)
    { 
        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        range.select();//Select the range (make it the visible selection
    }
}


var _onPaste_StripFormatting_IEPaste = false;
            function OnPaste_StripFormatting(elem, e) { 
                if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                    e.preventDefault();
                    var text = e.originalEvent.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (e.clipboardData && e.clipboardData.getData) {                   
                    e.preventDefault();
                    var text = e.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (window.clipboardData && window.clipboardData.getData) {
                    if (!_onPaste_StripFormatting_IEPaste) {
                        _onPaste_StripFormatting_IEPaste = true;
                        e.preventDefault();
                        window.document.execCommand('ms-pasteTextOnly', false);
                    }
                    _onPaste_StripFormatting_IEPaste = false;
                }
            }



