function portfolio_form_submit(event){  
 
//alert("hoii");
   
    var bestofmine = document.getElementById("bestofmine").value;

    var bestmine = document.getElementById("bestmine").value;
//alert(bestmine);

  var $field = $('#artportfolio123');
  
  var artportfolio = $('#artportfolio123').html();
  artportfolio = artportfolio.replace(/ /gi, " ");
  artportfolio = artportfolio.trim();
 
     

  if(bestofmine != ''){ 

      var bestofmine_ext = bestofmine.split('.').pop();
      
      var allowespdf = ['pdf'];
      var foundPresentpdf = $.inArray(bestofmine_ext, allowespdf) > -1;
      }
      

      var bestmine_ext = bestmine.split('.').pop();
      
       var allowespdf = ['pdf'];
       var foundPresentportfolio = $.inArray(bestmine_ext, allowespdf) > -1;


       if(foundPresentpdf == false)
       {
                 $(".bestofmine_image").html("Please select only pdf file.");
                return false;
         
      }

      else{ 


        var fd = new FormData();
                
         fd.append("image", $("#bestofmine")[0].files[0]);

         files = this.files;

        fd.append('artportfolio', artportfolio);
        fd.append('bestmine', bestmine);

         $.ajax({

              url: base_url + "artistic/art_portfolio_insert",

             //url: "<?php echo base_url(); ?>artistic/art_portfolio_insert",
             type: "POST",
             data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
              if(art_step == 4){ 
                 //window.location= "<?php echo base_url() ?>artistic/artistic_profile";
                 window.location= base_url + "artistic/artistic_profile"; 

                 }else{ 

                 window.location= base_url + "artistic/art_post"; 

                // window.location= "<?php echo base_url() ?>artistic/art_post"; 
                  } 

            }
         }); 

         
      }
    }



    function delpdf(){
     $.ajax({ 
        type:'POST',
        url: base_url + "artistic/deletepdf",

        //url:'<?php echo base_url() . "artistic/deletepdf" ?>',
        success:function(data){ 
          // alert(data);
          // return false;
       //document.getElementById('filename').style.visiblity="hidden";
    //   document.getElementById("pdffile").style.visibility = "hidden";
        $("#filename").text('');
        $("#pdffile").hide();
        document.getElementById('bestmine').value = '';

          }
            }); 
  }

document.getElementById('bestofmine').onchange = uploadOnChange;
    
function uploadOnChange() {
    var filename = null;
    var filename = this.value;
     var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    } 
    
  $("#filename").text(filename);
 
   }


   $(".alert").delay(3200).fadeOut(300);


jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});


 var _onPaste_StripFormatting_IEPaste = false;

            function OnPaste_StripFormatting(elem, e) { 

                if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                   // alert(1);
                    e.preventDefault();
                    var text = e.originalEvent.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (e.clipboardData && e.clipboardData.getData) { 
                    //alert(2);
                   
                    e.preventDefault();
                    var text = e.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (window.clipboardData && window.clipboardData.getData) {

                    //alert(3);

                    // Stop stack overflow
                    if (!_onPaste_StripFormatting_IEPaste) {
                        _onPaste_StripFormatting_IEPaste = true;
                        e.preventDefault();
                        window.document.execCommand('ms-pasteTextOnly', false);
                    }
                    _onPaste_StripFormatting_IEPaste = false;
                }

            }


$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});


$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});

$(function() {
    // alert('hi');
$( "#tags1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});

$(function() {
    // alert('hi');
$( "#searchplace1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
});

function checkvalue() {
                           
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace =$.trim( document.getElementById('searchplace').value);
                            
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