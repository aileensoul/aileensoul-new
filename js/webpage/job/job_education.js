//new script for jobtitle,company and skill start
 $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
//new script for jobtitle,company and skill  end

//new script for jobtitle,company and skill start for mobile view
 $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
//new script for jobtitle,company and skill for mobile view end

//new script for cities start
 $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
//new script for cities end

//new script for cities start mobile view start
 $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
//new script for cities end mobile view end

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
  //for search validation End

  //validation primary start
 $().ready(function () {
   
   jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
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
   
   
       $("#jobseeker_regform_primary").validate({
   
           rules: {
   
               board_primary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_primary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_primary: {
   
                   required: true,
                   number:true,
                    pattern_primary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
               },
   
               pass_year_primary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_primary: {
   
                   required: "Board Is Required.",
   
               },
   
               school_primary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_primary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage",
                   
   
               },
   
               pass_year_primary: {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });

 //pattern validation at percentage start//
   $.validator.addMethod("pattern_primary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage Between 1-100 Only");
   
   //pattern validation at percentage end//
  //validation primary end

   //validation secondary start
    $().ready(function () {
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
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
   
   
       $("#jobseeker_regform_secondary").validate({
   
           rules: {
   
               board_secondary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_secondary: {
   
                   required: true,
                   number:true,
                    pattern_secondary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
               },
   
               pass_year_secondary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_secondary: {
   
                   required: "Board Is Required.",
   
               },
   
               school_secondary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_secondary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
               },
   
               pass_year_secondary: {
   
                   required: "Passing Year Is Required.",
   
               },
   
           }
   
       });
   });
   
   //pattern validation at percentage start//
   $.validator.addMethod("pattern_secondary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   
   //pattern validation at percentage end//
   //validation secondary end

   //validation higher secondary start
   $().ready(function () {
   
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
   $.validator.addMethod("regx1", function(value, element, regexpr) {         
   if(!value) 
   {
   return true;
   }
   else
   {
   return regexpr.test(value);
   }
   // return regexpr.test(value);
   }, "Only space, only number and only special characters are not allow");
   
   
       $("#jobseeker_regform_higher_secondary").validate({
   
           rules: {
   
               board_higher_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
               stream_higher_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_higher_secondary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_higher_secondary: {
   
                    required: true,
                
                   number:true,
                    pattern_higher_secondary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
                 
   
               },
   
               pass_year_higher_secondary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_higher_secondary: {
   
                   required: "Board Is Required.",
   
               },
               stream_higher_secondary: {
   
                   required: "Stream Is Required",
   
               },
   
               school_higher_secondary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_higher_secondary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
   
               },
   
               pass_year_higher_secondary: {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });
   
   //pattern validation at percentage start//
   $.validator.addMethod("pattern_higher_secondary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   
   //pattern validation at percentage end//
   //validation higher secondary end

   //validation degree start
  $().ready(function () {
   
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");

  
    $.validator.addMethod("valueNotEquals", function(value, element, arg){ 
      if(arg == value)
      { 
         if(($.fancybox.open()))
         {
                  
               if($('#input1 #university1').hasClass('error') )
               {
                     
             
                     $("#input1 .university").removeClass("error");
                     $('label.error').remove();
                    return true;     
                }

          
         }

         return false;
      }
      else
      {
         return true;
      }
 }, "Other Option Selection Is Not Valid");

   
   $.validator.addMethod("regx", function(value, element, regexpr) {          
  
   if(!value) 
   {
   return true;
   }
   else
   {
   return regexpr.test(value);
   }
  
   }, "This is not Proper Format of Grade");
   
       $("#jobseeker_regform").validate({
   
           rules: {
   
               'degree[]': {
   
                   required: true,
   
               },
   
               'stream[]': {
   
                   required: true,
   
               },
   
               'university[]': {
   
                   required: true,
                    valueNotEquals: 463,
                
               },
   
               'college[]': {
   
                   required: true,
                     regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
                'grade[]': {
   
                   regx:/^(?:[ABCD][+-]?|AB[+-]?|[ABCD][+][+]|[AW]?F)$/
               
                },
               'percentage[]': {
   
                   required: true,
                   number:true,
                    pattern_degree: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
               },
               'pass_year[]': {
   
                   required: true,
                   
               },
   
           },
   
           messages: {
   
               'degree[]': {
   
                   required: "Degree Is Required.",
   
               },
   
               'stream[]': {
   
                   required: "Stream Is Required.",
   
               },
   
               'university[]': {
   
                   required: "University Is Required.",
   
               },
   
               'college[]': {
   
                   required: "College Is Required.",
   
               },
              
               'percentage[]': {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
               },
               'pass_year[]': {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });
   
    //pattern validation at percentage start//
   $.validator.addMethod("pattern_degree", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   //pattern validation at percentage end//
   //validation degree end

   //Clone input type start
    $('#btnRemove').attr('disabled', 'disabled');
   
   $('#btnAdd').click(function () {
       var num = $('.clonedInput').length;
       var newNum = new Number(num + 1);
       //alert(newNum);
   
       if (newNum > 5)
       {
   
           $('#btnAdd').attr('disabled', 'disabled');
           alert("You Can add only 5 fields");
           return false;
   
       }
      
         
      var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
      var $clone = $('#input' + num).clone();
    
       newElem.children('.education_data').attr('id', 'education_data' + newNum).attr('name', 'education_data[]').attr('value', 'new');
       newElem.children('.degree').attr('id', 'degree' + newNum).attr('name', 'degree[]');
       newElem.children('.stream').attr('id', 'stream' + newNum).attr('name', 'stream[]');
       newElem.children('.university').attr('id', 'university' + newNum).attr('name', 'university[]');
       newElem.children('.college').attr('id', 'college' + newNum).attr('name', 'college[]');
       newElem.children('.grade').attr('id', 'grade' + newNum).attr('name', 'grade[]');
       newElem.children('.percentage').attr('id', 'percentage' + newNum).attr('name', 'percentage[]');
       newElem.children('.pass_year').attr('id', 'pass_year' + newNum).attr('name', 'pass_year[]');
       newElem.children('.certificate').attr('id', 'certificate' + newNum).attr('name', 'certificate[]');
   
       $('#input' + num).after(newElem);
       $('#btnRemove').removeAttr('disabled', 'disabled');
       $('#input' + newNum + ' #pass_year1').val('');   
       $('#input' + newNum + ' .degree').val(''); 
       $('#input' + newNum + ' .stream').val('');
       $('#input' + newNum + ' .university').val(''); 
       $('#input' + newNum + ' #percentage1').val(''); 
     
      $('#input' + newNum + '.certificate').replaceWith($("#certificate"+ newNum).val('').clone(true));
   
       $('#input' + newNum + ' .exp_data').val(''); 
       $('#input' + newNum + ' .hs-submit').remove();    
       $("#input" + newNum + ' img').remove();
        });
   
   
   $('#btnRemove').on('click', function () {
   
       var num = $('.clonedInput').length;
   
       if (num - 1 == <?php echo $predefine_data; ?>)
       {
   
           $('#btnRemove').attr('disabled', 'disabled');
   
   
       }
       $('.clonedInput').last().remove();
   
   });
  
   
   
   $('#btnAdd').on('click', function () {
   
       $('.clonedInput').last().add().find("input:text").val("");
   
   });
// Clone input type End

//stream change depend on degeree start
 $(document).on('change', '#input1 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input1 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
    $(document).on('change', '#input2 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input2 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
     $(document).on('change', '#input3 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input3 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
      $(document).on('change', '#input4 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input4 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
       $(document).on('change', '#input5 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input5 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
           
//stream change depend on degree End

 $(".alert").delay(3200).fadeOut(300);

 //Click on University other option process Start 

 $(document).on('change', '#input1 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');   

   $('.message #univer').on('click', function () {

      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><div class="fw text-center"><button data-fancybox-close="" class="btn">OK</button></div></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input1 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input2 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input2 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input3 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input3 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input4 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input4 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input5 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input5 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
//Click on University other option process End 

//Click on Degree other option process Start 
   $(document).on('change', '#input1 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input1 .degree').html(response.select);
                                    $('#input1 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input2 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input2 .degree').html(response.select);
                                    $('#input2 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input3 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input3 .degree').html(response.select);
                                    $('#input3 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input4 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input4 .degree').html(response.select);
                                    $('#input4 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input5 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input5 .degree').html(response.select);
                                    $('#input5 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   

 $(document).on('change', '.message #other_stream', function (event) {

var item1=$(this);
var other_stream=(item1.val());
 
 if(other_stream == 61)
{
    $.fancybox.open('<div class="message1"><h2>Add Stream</h2><input type="text" name="other_degree1" id="other_degree1"><a id="univer1" class="btn">OK</a></div>');

      $('.message1 #univer1').on('click', function () {
      var $textbox1 = $('.message1').find('input[type="text"]'),
      textVal1  = $textbox1.val();

       $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_stream" ?>',
                          data: 'other_stream=' + textVal1,
                          success: function (response) {
                       
                               if(response == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Stream already available in  Stream Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.message #other_stream').html(response);
                              }
                          }
                      });
    
      });
}
       
       }); 
//Click on Degree other option process End

//script start for next button start
function next_page()
   {
   
   
    var board_primary = document.getElementById('board_primary').value;
    var school_primary = document.getElementById('school_primary').value;
    var percentage_primary = document.getElementById('percentage_primary').value;
    var pass_year_primary = document.getElementById('pass_year_primary').value;
   
   var board_secondary = document.getElementById("board_secondary").value;
   var school_secondary = document.getElementById("school_secondary").value;
   var percentage_secondary = document.getElementById("percentage_secondary").value;
   var pass_year_secondary = document.getElementById("pass_year_secondary").value;
   
   var board_higher_secondary = document.getElementById("board_higher_secondary").value;
   var stream_higher_secondary = document.getElementById("stream_higher_secondary").value;
   var school_higher_secondary = document.getElementById("school_higher_secondary").value;
   var percentage_higher_secondary = document.getElementById("percentage_higher_secondary").value;
   var pass_year_higher_secondary = document.getElementById("pass_year_higher_secondary").value;
   
   var num = $('.clonedInput').length;
   
   if(num==1 || num<6)
   {
        
           var degree1 = document.querySelector("#input1 .degree").value;
           var stream1 = document.querySelector("#input1 .stream").value;
           var university1 = document.querySelector("#input1 .university").value;
           var college1 = document.querySelector("#input1 .college").value;
           var percentage1 = document.querySelector("#input1 .percentage").value;
           var pass_year1 = document.querySelector("#input1 .pass_year").value;
          
   }
   if(num==2 || (num>1 && num<6))
   {    
           var degree2= document.querySelector("#input2 .degree").value;
           var stream2 = document.querySelector("#input2 .stream").value;
           var university2 = document.querySelector("#input2 .university").value;
           var college2 = document.querySelector("#input2 .college").value;
           var percentage2 = document.querySelector("#input2 .percentage").value;
           var pass_year2 = document.querySelector("#input2 .pass_year").value;
   }
   
   if(num==3 || (num>2 && num<6))
   {    
       var degree3 = document.querySelector("#input3 .degree").value;
       var stream3 = document.querySelector("#input3 .stream").value;
       var university3 = document.querySelector("#input3 .university").value;
       var college3 = document.querySelector("#input3 .college").value;
       var percentage3 = document.querySelector("#input3 .percentage").value;
       var pass_year3 = document.querySelector("#input3 .pass_year").value;
   }
   
   if(num==4 || (num>3 && num<6))
   {     
       var degree4= document.querySelector("#input4 .degree").value;
       var stream4 = document.querySelector("#input4 .stream").value;
       var university4 = document.querySelector("#input4 .university").value;
       var college4 = document.querySelector("#input4 .college").value;
       var percentage4 = document.querySelector("#input4 .percentage").value;
       var pass_year4 = document.querySelector("#input4 .pass_year").value;
   }
   
   if(num==5)
   {  
       var degree5 = document.querySelector("#input5 .degree").value;
       var stream5 = document.querySelector("#input5 .stream").value;
       var university5 = document.querySelector("#input5 .university").value;
       var college5 = document.querySelector("#input5 .college").value;
       var percentage5 = document.querySelector("#input5 .percentage").value;
       var pass_year5 = document.querySelector("#input5 .pass_year").value;
   }
   
   //for clonedInput length 1 start
   if(num==1)
   {
     
        
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '')
    {
         
       $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
          
    }
          
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {   
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
              
           }
           else if(degree1!='' ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
           else
           {
              $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
       }
       
       else
       {
            $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="")
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>'); 
       }
   }
   
   
      }
   //for clonedInput length 1 end
   
   //for clonedInput length 2 start
   if(num==2)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '')
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 2 end
   
   //for clonedInput length 3 start
   if(num==3)
   {
      
      
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '')
    {
       $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');    
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 3 end
   
   //for clonedInput length 4 start
   if(num==4)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '' && degree4=="" &&  stream4 == '' && university4 == '' && college4 == '' && percentage4 == '' && pass_year4 == '')
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' )
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
            
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="" && degree4!="" && stream4!="" && university4!="" && college4!="" &&  percentage4!="" && pass_year4!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 4 end
   
   //for clonedInput length 5 start
   if(num==5)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '' && degree4=="" &&  stream4 == '' && university4 == '' && college4 == '' && percentage4 == '' && pass_year4 == '' && degree5=="" &&  stream5 == '' && university5 == '' && college5 == '' && percentage5 == '' && pass_year5 == '' )
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="" && degree4!="" && stream4!="" && university4!="" && college4!="" &&  percentage4!="" && pass_year4!="" && degree5!="" && stream5!="" && university5!="" && college5!="" &&  percentage5!="" && pass_year5!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 5 end
   
   }
   
   //edit time next page
   function next_page_edit() {
   
       $.fancybox.open('<div class="message"><h2>Do you want to leave this page?</h2><a class="mesg_link" href="<?php echo base_url() ?>job/job_project_update">OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
   }
      
  //script start for next button end