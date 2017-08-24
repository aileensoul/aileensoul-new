 //LOADER START
 jQuery(document).ready(function($) {  
   
   // site preloader -- also uncomment the div in the header and the css style for #preloader
   $(window).load(function(){
   $('#preloader').fadeOut('slow',function(){$(this).remove();});
   });
   });
 //LOADER END

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
                $.getJSON(base_url +"general/get_alldata", { term : extractLast( request.term )},response);
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
                $.getJSON(base_url +"general/get_alldata", { term : extractLast( request.term )},response);
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
                $.getJSON(base_url +"general/get_location", { term : extractLast( request.term )},response);
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
                $.getJSON(base_url +"general/get_location", { term : extractLast( request.term )},response);
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
   
       if (num - 1 == predefine_data)
       {
   
           $('#btnRemove').attr('disabled', 'disabled');
   
   
       }
       $('.clonedInput').last().remove();
   
   });
  
   
   
   $('#btnAdd').on('click', function () {
   
       $('.clonedInput').last().add().find("input:text").val("");
   
   });
// Clone input type End

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
   
       $.fancybox.open('<div class="message"><h2>Do you want to leave this page?</h2><a class="mesg_link" href="base_url + job/job_project_update">OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
   }
      
  //script start for next button end

    $(".alert").delay(3200).fadeOut(300);
