
jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});


$(".alert").delay(3200).fadeOut(300);

jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");


 $.validator.addMethod("regx", function(value, element, regexpr) {          
    if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
}, "Number, space and special character are not allowed");


            $(document).ready(function () { 

                $("#artbasicinfo").validate({

                    rules: {

                        firstname: {

                            required: true,
                            regx:/^[^-\s][a-zA-Z_\s-]+$/,
                            //noSpace: true
                        },


                        lastname: {

                            required: true,
                            regx:/^[^-\s][a-zA-Z_\s-]+$/,
                            //noSpace: true
                        },


                        email: {
                            required: true,
                            email: true,
                            remote: {
                                url: base_url + "artistic/check_email",
                                //url: "<?php echo site_url() . 'artistic/check_email' ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                        },

                        phoneno: {

                            number: true,
                             minlength: 8,
                           maxlength:15
                           
                            
                        },

                    },

                    messages: {

                        firstname: {

                            required: "First name Is Required.",
                            
                        },

                        lastname: {

                            required: "Last name Is Required.",
                            
                        },

                        email: {
                            required: "Email id is required",
                            email: "Please enter valid email id",
                            remote: "Email already exists"
                        },
                        
                    },

                });
                   });



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
                            
    var searchkeyword =$.trim(document.getElementById('tags').value);
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




