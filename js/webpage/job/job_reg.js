
//validation start
 $(document).ready(function () {
 $.validator.addMethod("lowercase", function(value, element, regexpr) {          
          return regexpr.test(value);
      }, "email Should be in Small Character");
      
      
       $.validator.addMethod("regx2", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
          //alert(value);
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      //alert(value);
                      return regexpr.test(value);
      
                      //return false;
                  }
           // return regexpr.test(value);
      },"special character and space not allow in the beginning");
      
      $.validator.addMethod("regx_digit", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
          //alert(value);
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      //alert(value);
                      return regexpr.test(value);
      
                      //return false;
                  }
           // return regexpr.test(value);
      },"digit is not allow");
      
      $.validator.addMethod("regx1", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                        return regexpr.test(value);
                  }
           // return regexpr.test(value);
      }, "only space, only number and only special characters are not allow");
      
      
       $("#jobseeker_regform").validate({
      
                 ignore: '*:not([name])',
              
               rules: {
      
                      first_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                          //noSpace: true
      
                      },
      
                      last_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                          //noSpace: true
      
                      },
                      
                      cities: {
      
                          required: true,
                        //  regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                          //noSpace: true
      
                      },
      
                      email: {
      
                          required: true,
                          email: true,
                          lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                         remote: {
                             url: base_url +"job/check_email",
                             //async is used for double click on submit avoid
                             async:false,
                             type: "post",
                             // data: {
                             //     email: function () {
      
                             //         return $("#email").val();
                             //     },
                              
                           //  },
                         },
                      },
      
                      fresher: {
      
                          required: true,
      
                      },
                      
                       job_title: {
      
                          required: "#test2:checked",
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                      //    regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                       //   noSpace: true
                       },
                       
                       industry: {
      
                          required: true,
                         // regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                         // noSpace: true
                       },
                       
                       cities: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                      //    regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                        //  noSpace: true
                       },
                       
                       skills: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                  //required:true 
                      },
                     
                  },
      
                  messages: {
      
                      first_name: {
      
                          required: "first name Is Required.",
      
                      },
      
                      last_name: {
      
                          required: "last name Is Required.",
      
                      },
      
                      email: {
      
                          required: "email Address Is Required.",
                          email: "please Enter Valid Email Id.",
                          remote: "email already exists"
                      },
                     
                      fresher: {
      
                          required: "fresher Is Required.",
      
                      },
                      
                      industry: {
      
                          required: "industry Is Required.",
      
                      },
                      
                      cities: {
      
                          required: "city Is Required.",
      
                      },
                      
                      job_title: {
      
                          required: "job title Is Required.",
      
                      },
                      
                       skills: {
      
                           required: "skill Is Required.",
      
                      }
      
                  },
      
              });
  });

// job title script start
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
                     $.getJSON(base_url + "general/get_jobtitle", { term : extractLast( request.term )},response);
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
                 
                  var terms = split( this.value );
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
                 
                  var terms = split( this.value );
                  if(terms.length <= 20) {
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
              }
      
      
      
          });
      });
//new script for skill end