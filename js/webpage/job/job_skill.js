//Loader Start
 jQuery(document).ready(function ($) {
// site preloader -- also uncomment the div in the header and the css style for #preloader
        $(window).load(function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        });
    });
//Loader End

//Validation Start
 $.validator.addMethod("regx", function(value, element, regexpr) {          
     if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
}, "only space, only number and only special characters are not allow");
// validation js

$.validator.addMethod("regx1", function(value, element, regexpr) {          
     if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
}, "only space, only number and only special characters are not allow");

 $("#jobseeker_regform").validate({

        
         rules: {

                industry: {

                    required: true,
                 
                },
               job_title: {

                    required: true,
                     regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,       
                },
                
                skills: {
                    required: true,
                     regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,

                }, 
                 cities: {

                    required: true,
                     regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                  
                 },             
            },

            messages: {

                industry: {

                    required: "industry Is Required.",

                },

                job_title: {

                    required: "job title Is Required.",

                },

                skills: {

                    required: "skill Is Required.",
                   
                },
               
                cities: {

                    required: "city Is Required.",

                },           
            },

        });
//Validation End

//job title script start
  $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#job_title" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON(base_url +"general/get_jobtitle", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#job_title").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
//job title script end

//new script for cities start
 $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#cities2" ).bind( "keydown", function( event ) {
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
            select: function( event, ui ) {
             
                var text =this.value;
                var terms = split( this.value );
                 
                text = text == null || text == undefined ? "" : text;
                var checked = (text.indexOf(ui.item.value + ', ') > -1 ? 'checked' : '');
               if (checked == 'checked') {
      
                    terms.push( ui.item.value );
                    this.value = terms.split( ", " );
               }//if end

              else {
                if(terms.length <= 10) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
                }else{
                    var last = terms.pop();
                    $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                    $(this).effect("highlight", {}, 1000);
                    $(this).attr("style","border: solid 1px red;");
                    return false;
                }
             }//else end 
            }

        });
    });
//new script for cities end

//new script for skill start

$(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) { 
            return split( term ).pop();
        }
        
        $( "#skills2" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON(base_url +"general/get_skill", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
               
                var text =this.value;
                var terms = split( this.value );
                 
                text = text == null || text == undefined ? "" : text;
                var checked = (text.indexOf(ui.item.value + ', ') > -1 ? 'checked' : '');
               if (checked == 'checked') {
      
                    terms.push( ui.item.value );
                    this.value = terms.split( ", " );
               }//if end

              else {
                if(terms.length <= 10) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
                }else{
                    var last = terms.pop();
                    $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                    $(this).effect("highlight", {}, 1000);
                    $(this).attr("style","border: solid 1px red;");
                    return false;
                }
                }//else end
            }
 
        });
    });
//new script for skill end