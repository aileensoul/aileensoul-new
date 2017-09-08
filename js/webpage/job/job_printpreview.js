//validation start
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

$(document).ready(function () {

        $("#userimage").validate({

            rules: {

                profilepic: {

                    required: true,

                },

            },

            messages: {

                profilepic: {

                    required: "Photo Required",

                },

            },
          submitHandler: profile_pic
        });
    });
//validation End

//Save Post Start
function savepopup(id) {
        save_user(id);
        $('.biderror .mes').html("<div class='pop_content'>Candidate successfully saved.");
        $('#bidmodal').modal('show');
    }

function save_user(abc)
    {
        $.ajax({
            type: 'POST',
            url: base_url +'recruiter/save_search_user',
            data: 'user_id=' + abc,
            success: function (data) {
                $('.' + 'saveduser' + abc).html(data).addClass('butt_rec');
            }
        });
    }
//Save Post End


//all popup close close using esc start
 $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $('#bidmodal-2').modal('hide');
        }
    });
//all popup close close using esc End

//Tabing In Education And Graduation Start
$( document ).ready(function() {
  $('div[onload]').trigger('onload');
});
 function openCity(evt, cityName) {
  
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

  function opengrad(evt, cityName) {
    
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent1");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks1");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
//Tabing In Education And Graduation End

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
 (function($) {
   $('.second.circle-1').circleProgress({
   value: count_profile_value
   }).on('circle-animation-progress', function(event, progress) {
   $(this).find('strong').html(Math.round(count_profile * progress) + '<i>%</i>');
   });
   
   })(jQuery);
   //Progress bar see End



   $(".alert").delay(3200).fadeOut(300);