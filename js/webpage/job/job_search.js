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
               $.getJSON(base_url +"general/get_alldata", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $(".tags").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for jobtitle,company and skill End

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
      },
    
       });
   });
//new script for cities End

//For Search Validation Start
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
//For Search Validation End

//Search textbox highlight Start
 var text = document.getElementById("search").value;
   $(".search").highlite({
       text: text
   });
//Search textbox highlight End

//Tooltip Start
 $(document).ready(function () {
       $('[data-toggle="tooltip"]').tooltip();
   });
//Tooltip End

//Save Post Start
function savepopup(id) {
       save_post(id);
       $('.biderror .mes').html("<div class='pop_content'>Your post is successfully saved.");
       $('#bidmodal').modal('show');
   }

 function save_post(abc)
   {
       $.ajax({
           type: 'POST',
           url: base_url + 'job/job_save',
           data: 'post_id=' + abc,
           success: function (data) {
               $('.' + 'savedpost' + abc).html(data).addClass('saved');
           }
       });
   
   }
//Save Post End

//Apply Post Start
function applypopup(postid, userid) {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure want to apply this post?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
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
//Apply Post End

//all popup close close using esc Start
$( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       $('#bidmodal').modal('hide');
   }
   });  
//all popup close close using esc End

//Unload Function Strat
window.onbeforeunload = function() {
   unset($_POST);
   };
//Unload Function End