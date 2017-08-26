
//Validation Start
 $(document).ready(function () {
   
       $("#jobdesignation").validate({
   
           rules: {
   
               designation: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               designation: {
   
                   required: "Designation Is Required.",
   
               },
   
           },
   
       });
   });
//Validation End

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
         
      },
    
       });
   });
//new script for jobtitle,company and skill  end

//new script for jobtitle,company and skill start for mobile view Start
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
          
      },
    
       });
   });
//new script for jobtitle,company and skill start for mobile view End

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
         
      },
    
       });
   });
//new script for cities End

//new script for cities start mobile view Start
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
          
      },
    
       });
   });
//new script for cities start mobile view End

//for search validation Start
 function check() {
       var keyword = $.trim(document.getElementById('tags1').value);
       var place = $.trim(document.getElementById('searchplace1').value);
       if (keyword == "" && place == "") {
           return false;
       }
   }

    function checkvalue() {
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }
   }
//for search validation End

//Tooltip start
 $(document).ready(function () {
       $('[data-toggle="tooltip"]').tooltip();
   
   });
//Tooltip End

//save post start 
  function savepopup(id) {
       save_post(id);
       $('.biderror .mes').html("<div class='pop_content'>Job successfully saved.");
       $('#bidmodal').modal('show');
   }

  function save_post(abc)
   {
       $.ajax({
           type: 'POST',
           url: base_url +'job/job_save',
           data: 'post_id=' + abc,
           success: function (data) {
               $('.' + 'savedpost' + abc).html(data).addClass('saved');
           }
       });
   
   }
//save post End

//apply post start
 function applypopup(postid, userid) 
 {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to apply this job?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
  }

 function apply_post(abc, xyz) {
       var alldata = 'all';
       var user = xyz;
   
       $.ajax({
           type: 'POST',
           url: base_url +'job/job_apply_post',
           data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
           success: function (data) {
               $('.savedpost' + abc).hide();
               $('.applypost' + abc).html(data);
               $('.applypost' + abc).attr('disabled', 'disabled');
               $('.applypost' + abc).attr('onclick', 'myFunction()');
               $('.applypost' + abc).addClass('applied');
           }
       });
   }
//apply post end

//all popup close close using esc start
 $( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       //$( "#bidmodal" ).hide();
       $('#bidmodal').modal('hide');
   }
   });
//all popup close close using esc end

//Disable progress bar when 100% complete Start
  $(document).ready(function(){ 
   
   var nb = $('div.profile-job-post-title').length;
    if(nb == 0){
   $("#dropdownclass").addClass("no-post-h2");
   
    }
   });
   
    $(document).ready(function () {
   $('.complete_profile').fadeIn('fast').delay(5000).fadeOut('slow');
   $('.edit_profile_job').fadeIn('slow').delay(5000);
   $('.tr_text').fadeIn('slow').delay(500);
   $('.true_progtree img').fadeIn('slow').delay(500);
     });
//Disable progress bar when 100% complete End

//Progress bar see start
 (function($) {9
   $('.second.circle-1').circleProgress({
   value: count_profile_value
   }).on('circle-animation-progress', function(event, progress) {
   $(this).find('strong').html(Math.round(count_profile * progress) + '<i>%</i>');
   });
   
   })(jQuery);
   //Progress bar see End
