
jQuery(document).ready(function($) {  
// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});


//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START
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
                $.getJSON(base_url + "artistic/artistic_search_keyword", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
               
                var terms = split( this.value );
                if(terms.length <= 1) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( "" );
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

//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END


//SCRIPT FOR CITY AUTOFILL OF SEARCH START

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
                $.getJSON(base_url + "artistic/artistic_search_city", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
               
                var terms = split( this.value );
                if(terms.length <= 1) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( "" );
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

//SCRIPT FOR CITY AUTOFILL OF SEARCH END

// validation for profile pic upload

            $(document).ready(function () { 

                $("#userimage").validate({ 

                    rules: {

                        profilepic: {

                            required: true,

                        },

                    },

                    messages: {

                        profilepic: {

                            required: "Image Required",

                        },

                    },

                     submitHandler: profile_pic

                });
            });


    // script for profile pic strat

    function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {

                        document.getElementById('preview').style.display = 'block';
                        $('#preview').attr('src', e.target.result);
                        $('.popup_previred').show();

                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profilepic").change(function () {
                profile = this.files;
                   //alert(profile);
                      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
                       //alert('not an image');
                  $('#profilepic').val('');
                   picpopup();
                     return false;
                   }else{
                      readURL(this);}
            });



function profile_pic(event){



        var fd = new FormData();
                
         fd.append("image", $("#profilepic")[0].files[0]);

         files = this.files;

       
    $.ajax({
      url: base_url + "artistic/profilepic",
      //url: "<?php echo base_url(); ?>artistic/profilepic",
      type: "POST",
      data: fd,
      contentType: false,
          cache: false,
      processData:false,
      success: function(data)
        {

        
      $('#bidmodal-2').modal('hide');

      $(".user-pic").html(data);

      document.getElementById('profilepic').value= null;

      //document.getElementById('profilepic').value == '';

      $('.popup_previred').hide();
     $('#preview').prop('src', '#');

        },          
     });
  return false;

}






//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START

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
                $.getJSON(base_url + "artistic/artistic_search_keyword", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
               
                var terms = split( this.value );
                if(terms.length <= 1) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( "" );
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

//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END

//SCRIPT FOR CITY AUTOFILL OF SEARCH START

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
                $.getJSON(base_url + "artistic/artistic_search_city", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
               
                var terms = split( this.value );
                if(terms.length <= 1) {
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( "" );
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

//SCRIPT FOR CITY AUTOFILL OF SEARCH END

function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
        $(".cr-image").attr("src","");
    }

    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1250,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 1250,
            height: 350
        }
    });
    $('.upload-result').on('click', function (ev) {

        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

           $.ajax({
                            url: base_url + "artistic/ajaxpro",
                            //url: "<?php echo base_url() ?>artistic/ajaxpro",
                            type: "POST",
                            data: {"image": resp},
                            success: function (data) { 
                                $("#row2").html(data);
                                document.getElementById('row2').style.display = "block";
                                document.getElementById('row1').style.display = "none";
                                document.getElementById('message1').style.display = "none";
                                document.getElementById("upload-demo").style.visibility = "visible";
                                document.getElementById("upload-demo-i").style.visibility = "visible";

                            }
                        });
        });
    }); 
    $('.cancel-result').on('click', function (ev) {

        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";
        $(".cr-image").attr("src","");

    });


    $('#upload').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });


    $("#upload").change(function () { 
        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);
        files = this.files;
        size = files[0].size;
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){ 
    picpopup();
    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
   $("#upload").val('');
    return false;
  }

  if (size > 10485760)
        {
            alert("Allowed file size exceeded. (Max. 10 MB)")
            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block"; 
            return false;
        }
        $.ajax({

            url: base_url + "artistic/image",
            //url: "<?php echo base_url(); ?>artistic/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
            }
        });
    });


    


    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});
