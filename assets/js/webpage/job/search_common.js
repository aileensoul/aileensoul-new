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
               $.getJSON(base_url +"job/get_alldata", { term : extractLast( request.term )},response);
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

//new script for cities search start

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

//new script for cities search end

//for search validation 

   function checkvalue() { alert(123);
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchkeyword = searchkeyword.replace(' ', '-');
       var searchkeyword = searchkeyword.replace('/[^A-Za-z0-9\-]/', '');
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }else{
           
           if(searchkeyword == ""){
               window.location = base_url + 'jobs-in-' + searchplace;
               return false;
           } else if(searchplace == ""){
               window.location = base_url + searchkeyword + '-jobs';
               return false;
           }else{
               window.location = base_url + searchkeyword + '-jobs-in-' + searchplace;
               return false;
           }
       }
   }
  function check() { alert(123456);
       var keyword = $.trim(document.getElementById('tags1').value);
       var place = $.trim(document.getElementById('searchplace1').value);
       if (keyword == "" && place == "") {
           return false;
       }
   }

// Field Validation Js Start