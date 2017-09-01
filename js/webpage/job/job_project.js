//Loader start
 jQuery(document).ready(function($) {  
   
   // site preloader -- also uncomment the div in the header and the css style for #preloader
   $(window).load(function(){
   $('#preloader').fadeOut('slow',function(){$(this).remove();});
   });
   });
//Loader End

//Validation Start
 $(document).ready(function () { 
 
   $.validator.addMethod("regx1", function(value, element, regexpr) {          
   if(!value) 
   {
    return true;
   }
   else
   {
      return regexpr.test(value);
   }
   }, "Only space, only number and only special characters are not allow");
   
   
   $.validator.addMethod("regx2", function(value, element, regexpr) {          
   if(!value) 
   {
    return true;
   }
   else
   {
      return regexpr.test(value);
   }
   },"space are not allow in the begining");
   
   $.validator.addMethod("regdigit", function(value, element, regexpr) {          
   if(!value) 
   {
    return true;
   }
   else
   {
      return regexpr.test(value);
   }
   },"Only digit allowed");
   
   
                $("#jobseeker_regform").validate({
   
                    rules: {
   
                        project_name:{
                            regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                            regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                        },
   
                        project_description:{
                          regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                        },
                        project_duration:{
                    
                            regdigit:/^[0-9]*$/,
                        },
                        training_as:{
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                            regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                        },
                        training_duration:{
                          regdigit:/^[0-9]*$/,
                        },
                        training_organization:{
                          regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                           regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                        },
   
                    },
       
                });
            });
   
//validation End

//new script for jobtitle,company and skill start
 $(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( ".tags" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url + "job/get_alldata", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $(".tags").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
          // window.location.href = ui.item.value;
      },
    
       });
   });
//new script for jobtitle,company and skill end

//new script for cities start
 $(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( ".searchplace" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url +"general/get_location", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $(".searchplace").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
          // window.location.href = ui.item.value;
      },
    
       });
   });
//new script for cities end

//for search validation start
 function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
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
//for search validation end

//disable spacebar js start
  $(window).load(function(){
   $("#project_duration").on("keydown", function (e) {
   return e.which !== 32;
   });
   }); 
   
   $(window).load(function(){
   $("#training_duration").on("keydown", function (e) {
   return e.which !== 32;
   });
   }); 
//disable spacebar js end

//THIS FUNCTION IS USED FOR PASTE SAME DESCRIPTION THAT COPIED START
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
           // Stop stack overflow
           if (!_onPaste_StripFormatting_IEPaste) {
               _onPaste_StripFormatting_IEPaste = true;
               e.preventDefault();
               window.document.execCommand('ms-pasteTextOnly', false);
           }
           _onPaste_StripFormatting_IEPaste = false;
       }
   }
//THIS FUNCTION IS USED FOR PASTE SAME DESCRIPTION THAT COPIED END

 $(".formSentMsg").delay(3200).fadeOut(300);