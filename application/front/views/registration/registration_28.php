     <head> 
         
    <meta charset="utf-8" />
    <title>Find the Best Jobs, Hiring, Employment and Freelance | Aileensoul.com</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <!-- seo changes start -->
    <!--Need to add following TAG in Header.-->

    
<meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />

<link rel="canonical" href="https://www.aileensoul.com" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="description" content="Aileensoul provides best opportunity where you can Hire, Recruit, Freelance, Busines and find or search jobs of your preference in your required field." />
<meta name="keywords" content="Hire Freelancers, Freelance Jobs Online, Find Freelance Work, Freelance Jobs, Get Online Work, online freelance jobs, freelance websites, freelance portal, online freelance work, freelance job sites, freelance consulting jobs, hire freelancers online, best freelancing sites, online writing jobs for beginners, top freelance websites, freelance marketplace, jobs, Job search, job vacancies, Job Opportunities in India, jobs in India, job openings, Jobs Recruitment, Apply For Jobs, Find the right Job, online job applications, apply for jobs online, online job search, online jobs india, job posting sites, job seeking sites, job search websites, job websites in india, job listing websites, jobs hiring, how to find a job, employment agency, employment websites, employment vacancies, application for employment, employment in india, searching for a job, job search companies, job search in india, best jobs in india, job agency, job placement agencies, how to apply for a job, jobs for freshers, job vacancies for freshers, recruitment agencies, employment agencies, job recruitment, hiring agencies, hiring websites, recruitment sites, corporate recruiter, career recruitment, online recruitment, executive recruiters, job recruiting companies, online job recruitment, job recruitment agencies, it, recruitment agencies, recruitment websites, executive search firms, sales recruitment agencies, top executive search firms, recruitment services, technical recruiter, recruitment services, job recruitment agency, recruitment career" />
<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->



<link rel="canonical" href="https://www.aileensoul.com" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/media.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/common-style.css'); ?>">

  
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 

    <meta content="" name="author" />
 
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_login.css'); ?>">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/media.css'); ?>">
     </head>

<style type="text/css">
     .reg_j h1 span{padding-bottom: 16px!important; margin-bottom: 5px!important;}
</style>

<body class="main_bdy_c">
<header>
    
        <div class="header3">
    <div class="container">
    <div class="row">
  <div class="col-md-6 col-sm-5">
                        <div class="logo"><a tabindex="-20" href="<?php echo base_url('main') ?>"><!-- <img src="<?php// echo base_url('images/logo.png'); ?>"> --> <span >Aileensoul</span></a></div>
                    </div>
 
           <div class="col-md-6 col-sm-7 header-left-menu">
                   <ul class="fr">
                    <li class=""><a class="login_butn" tabindex="15"  href="<?php echo base_url('login') ?>">Login</a></li>
                      
                    </ul>

                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                        </div>
    </div>    
    </div>
     
    </div>


</header>
   <div class="container">
        <div class="row">
          <div class="col-md-12"> <div class="reg">
               <div class="abt_a reg_j">
              <h1><span>Join Aileensoul</span></h1>
            </div>
                   <?php echo form_open_multipart(base_url('registration/reg_insert'),array('id' => 'regform','name' => 'regform','class' => "clearfix"));
  
  if ($this->session->flashdata('error')) 
               {
                      echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                }
                if ($this->session->flashdata('success'))
                 {
                         echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                }

?>
          
            <span id="uname-error"> </span>
            
                <fieldset class="col-md-6 par-3">
                    <label>First Name</label>
                    <input tabindex="1" type="text" value="<?php if($fsname){ echo $fsname; }?>" name="fname" id="fname" placeholder="Enter First name">
                      <?php echo form_error('fname'); ?>
                </fieldset>
                 <fieldset class="col-md-6 pal-3">
                    <label>Last Name</label>
                     <input  tabindex="2" type="text" value="<?php if($lname){ echo $lname; }?>" name="lname" id="lname" placeholder="Enter Last name">
                      <?php echo form_error('lname'); ?>
                </fieldset>
                 <fieldset class="col-md-12">
                    <label>Email Address</label>
                     <input type="text" name="email" tabindex="3" id="email" placeholder="Enter Email address" value="">
              <?php echo form_error('email'); ?>
                </fieldset>
 <fieldset class="col-md-12">
                    <label>Password</label>
                    <input type="password" tabindex="4" name="password" id="password" placeholder="Enter Password" class="showpassword2" placeholder="">
                      <?php echo form_error('password'); ?>
             <div>
    <label for="checkbox_eye" class="rela_eye"  >
  <img style="height: 20px; width: 20px;" src="<?php echo base_url('images/eye.png'); ?>">
</label>
</div>
        
                </fieldset>

          
                <fieldset class="col-md-9 date_tm">
                    <label>Date Of Birth</label>

   <select name="date" tabindex="5">
    <option value="">  DD  </option>  
    <option value="01"> 1 </option>  
    <option value="02"> 2 </option> 
    <option value="03"> 3 </option> 
    <option value="04"> 4 </option> 
    <option value="05"> 5  </option> 
    <option value="06"> 6  </option> 
    <option value="07"> 7  </option> 
    <option value="08">  8  </option> 
    <option value="09">  9  </option> 
    <option value="10">  10  </option> 
    <option value="11">  11  </option> 
    <option value="12">  12  </option> 
    <option value="13">  13  </option> 
    <option value="14">  14  </option> 
    <option value="15">  15  </option> 
    <option value="16">  16  </option> 
    <option value="17">  17  </option> 
    <option value="18">  18  </option> 
    <option value="19">  19  </option> 
    <option value="20">  20  </option> 
    <option value="21">  21  </option> 
    <option value="22">  22  </option> 
    <option value="23">  23  </option> 
    <option value="24">  24  </option> 
    <option value="25">  25  </option> 
    <option value="26">  26  </option> 
    <option value="27">  27  </option> 
    <option value="28">  28  </option> 
    <option value="29">  29  </option> 
    <option value="30">  30  </option> 
    <option value="31">  31  </option> 


</select>
<select name="month" tabindex="6">
    <option value="">  MM  </option>
    <option value="01">  Jan  </option>
    <option value="02">  Feb  </option>
    <option value="03">  Mar  </option>
    <option value="04">  Apr  </option>
    <option value="05"> May   </option>
    <option value="06"> Jun  </option>
    <option value="07"> Jul  </option>
    <option value="08"> Aug  </option>
    <option value="09"> Sep  </option>
    <option value="10"> Oct  </option>
    <option value="11"> Nov  </option>
    <option value="12"> Dec  </option>
</select> 
<select name="year" tabindex="7">
    <option value=""> YYYY </option>
 <?php  for ($i = date('Y'); $i > 1899 ; $i--) {?>
    <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
  
        <?php  } ?>
    
    
</select>

                </fieldset>
                <fieldset class="col-md-3 date_tm" style="padding-left: 50px;">
                    <label>Gender</label>

<select name="gen" id="gen" style="padding-right: 0px!important;" tabindex="8">
    <option value=""> Gender </option>
    <option value="M" <?php if($gender == 'M'){ echo 'selected'; }?>> Male </option>
    <option value="F" <?php if($gender == 'F'){ echo 'selected'; }?>> FeMale </option>
   </select>
              <?php echo form_error('gen'); ?>  
                </fieldset>
<div class="col-md-12 terms">
    <p >By Clicking on create an account button you agree our
  <a href="#" tabindex="-11">Terms and Condition</a> and <a tabindex="-10" href="">Privacy Policy</a>
    </p>
    
</div>

     <input type="submit" tabindex="9" value="Create an Account" name="submit" class="button3 button-block3 " style="background:#87ceff!important;    background-repeat: no-repeat; background-position: right center ; margin-top:  10px;">
          <!--<div class="or"> <span>or</span></div>-->
           </form>
          <!--<button class="button3 button-block3 facebook_ac" tabindex="10">Sign Up With Facebook</button>-->
            </div>
          </div> 
</div>           
</div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="padding-bottom: 1px!important; padding: 12px;">
                <div class="footer-menu pull-left">
                    <p style="color: #fff;">&copy; 2017 | by <a tabindex="-100" href="#" style="color: #fff;">Aileensoul</a></p>
                </div>
                </div>
                <div class="col-md-6">
                <div class="footer-menu pull-right">
                    <nav>
                        <ul>
                          <li> <b><a class="" tabindex="11" href="<?php echo base_url('about_us'); ?>">About Us</a> </b></li>
                                    <li> <b><a tabindex="12" class="" href="<?php echo base_url('contact_us'); ?>">Contact Us</a> </b></li>
                                    <li><b><a tabindex="13" class="" href="javascript:void(0);">Blog</a> </b></li>
                                    <li> <b><a tabindex="14" class="" href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a> </b></li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
        </div>
    <!-- scripts -->
<!-- <script src="<?php //echo base_url('partical/particles.json'); ?>"></script> -->

<script src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
 
<script src="<?php echo base_url('partical/particles.min.js'); ?>"></script>
<script src="<?php echo base_url('partical/js/app.js'); ?>"></script>

<!-- stats.js -->
<script src="<?php echo base_url('partical/js/lib/stats.js'); ?>"></script>



   
  
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!-- <script src="<?php echo base_url('partical/js/index.js'); ?>"></script> -->


     
    <footer>



</body>

</html>

<!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.datetimepicker.full.js'); ?>"></script>
<script type="text/javascript">
$('#datepicker').datetimepicker({
  //yearOffset:222,
  startDate: "2013/02/14",
  lang:'ch',
  timepicker:false,
  format:'d/m/Y',
  formatDate:'Y/m/d'
  //minDate:'-1970/01/02', // yesterday is minimum date
  //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
<!-- Calender Js End-->

<!-- Field Validation Js start -->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<!-- Field Validation Js End -->



<!--validation using Javascript Start -->
<script type="text/javascript">

 var timer = setTimeout(function() {
           <?php echo $this->session->unset_userdata('fbuser'); ?>
        }, 180000);


 $(function(){
    $(".showpassword").each(function(index,input) {
        var $input = $(input);
        $('<div class="checkbox2 show" style="display: block;">').append(
            $("<input type='checkbox' class='showpasswordcheckbox'  id='password1' style='display: none;' /></div> ").click(function() {
                var change = $(this).is(":checked") ? "text" : "password";
                var rep = $("<input type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;
             })
        ).insertAfter($input);
    });
});



 $(function(){
    $(".showpassword2").each(function(index,input) {
        var $input = $(input);
        $('<div class="" >').append(
            $("<input type='checkbox' class='showpasswordcheckbox2' id='checkbox_eye' style='display:none;'</div> ").click(function() {
                var change = $(this).is(":checked") ? "text" : "password";
                var rep = $("<input type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;
             })
        ).insertAfter($input);
    });
});

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#regform").validate({

                    rules: {
                      uname:{
                            required: true,
                            pattern1: /^([a-zA-Z+]+[0-9+]+)$/
                        },

                        fname: {

                            required: true,
                            pattern: /^[A-Za-z]{0,}$/
                        },
                        lname: {

                            required: true,
                             pattern: /^[A-Za-z]{0,}$/
                        },
                        email: {

                            required: true,
                            email:true,
                             remote: {
                                url: "<?php echo site_url() . 'registration/check_email' ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                     // alert("hi");
                                        return $("#email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                              },
                        },
                        password: {

                            required: true,
                            minlength: 6,
                             maxlength: 20
                        },
                        password2: {

                             required: true,
                              minlength: 6,
                              maxlength: 20,
                             equalTo: "#password"
                        },
                        datepicker: {

                            required: true
                            // date: true
                        },
                        gen: {

                            required: true,
                        }
                       
                    },

                    messages: {

                       uname: {
                           required: "User Name Is Required.",
                            
                        },

                        fname: {

                            required: "First Name Is Required.",
                            
                        },
                        lname: {

                            required: "Last Name Is Required."
                        },
                         email: {

                            required: "Email Address Is Required.",
                             email:"Please Enter Valid Email Id.",
                              remote: "Email already exists"
                        },
                         password: {

                            required: "Password  Is Required.",
                            minlength: "Your password must be at least 6 characters long",
                            maxlength: "Your password must be less than 20 characters"
                        },
                         password2: {

                            required: "Please provide a Confirm Password",
                             minlength: "Your password must be at least 6 characters long",
                             maxlength: "Your password must be less than 20 characters",
                             equalTo: "Please enter the same password as above"
                           
                        },
                         datepicker: {

                            required: "Date of Birth Is Required."

                        },
                         
                        gen: {

                            required: "Gender Is Required."
                        }
                 
                    },

                });
                   });

            //pattern validation at fname and lname start//
              $.validator.addMethod("pattern", function(value, element, param) {
              if (this.optional(element)) {
               return true;
              }
              if (typeof param === "string") {
                param = new RegExp("^(?:" + param + ")$");
              }
              return param.test(value);
            }, "Digit Is Not Allowed");
             //pattern validation at fname and lname end//


            //pattern validation at Username start//
              $.validator.addMethod("pattern1", function(value, element, param) {
              if (this.optional(element)) {
               return true;
              }
              if (typeof param === "string") {
                param = new RegExp("^(?:" + param + ")$");
              }
              return param.test(value);
            }, "Username should only contains first letter is character and last letter is digit. e.g. aileensoul1, Aileensoul13 ");
             //pattern validation at Username end//


             //function for restrictspace on keypress at password and confirm password start 
             function RestrictSpace() 
             {
              if (event.keyCode == 32)
                 {
                     return false;
                }
            }
            //function for restrictspace on keypress at password and confirm password end 

            //function for username checking start 
            function check_if_exists() 
            {

                  result = true;
                  
                  var uname=document.getElementById('uname').value;
                  var postStr="uname="+uname;


                  var name = $("#uname").val();
                  if(name.length > 3)
                  {   
                  $("#uname-error").html('checking...');

                  $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>registration/filename_exists",
                    dataType:'xml',
                    async: false,
                    data: postStr,
                    success:function(res)
                    {
                      var returnVal=$(res).text();
                     //alert($(res).text());
                     document.getElementById('user').value=returnVal;
                      if(returnVal=="Available")
                      {
                        
                        document.getElementById('uname-error').innerHTML = returnVal;
                        color = 'brown';
                        result = true;
                      }  

                      else
                      {
                        document.getElementById('uname-error').innerHTML = returnVal;
                        
                        color = 'green';
                        result = false;
                      } 
                       $('#uname-error').css('color', color);   
                    }
                  });
                }
                else
                {
                  // document.getElementById('uname-error').innerHTML = "<span style=\"color:red\">" + "Username Should be more than 3 characters" + "</span>";
                  
                  result = false;
                  //alert(result);
                  //$("#uname-error").html('');
                }
                  
                    return result;

                  }
              //function for username checking end 

              //function for autocomplete in all input type Start
              $(document).ready(function(){ 
                $("input").attr("autocomplete", "off"); 
              });
              //function for autocomplete in all input type End

              
  </script>
 <!--validation using Javascript End -->



<script type="text/javascript">
  'use strict';

(function($) {
  $.fn.phAnim = function( options ) {

    // Set default option
    var settings = $.extend({}, options),
        label,
        ph;
    
    // get label elem
    function getLabel(input) {
      return $(input).parent().find('label');
    }
    
    // generate an id
    function makeid() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
      return text;
    }
    
    return this.each( function() {
      
      // check if the input has id or create one
      if( $(this).attr('id') == undefined ) {
        $(this).attr('id', makeid());
      }

      // check if elem has label or create one
      if( getLabel($(this)).length == 0 ) {
        // check if elem has placeholder
        if( $(this).attr('placeholder') != undefined ) {
          ph = $(this).attr('placeholder');
          $(this).attr('placeholder', '');
          // create a label with placeholder text
          $(this).parent().prepend('<label for='+ $(this).attr('id') +'>'+ ph +'</label>');
        }
      } else {
        // if elem has label remove placeholder
        $(this).attr('placeholder', '');
        // check label for attr or set it
        if(getLabel($(this)).attr('for') == undefined ) {
          getLabel($(this)).attr('for', $(this).attr('id'));
        }
      }

      $(this).on('focus', function() {
        label = getLabel($(this));
        label.addClass('active focusIn');
      }).on('focusout', function() {
        if( $(this).val() == '' ) {
          label.removeClass('active');
        }
        label.removeClass('focusIn');
      });
    });
  };
}(jQuery));

$(document).ready(function() {
  $('.field-wrap input').phAnim();
});
</script>

<!-- save browser password email reset start -->

<script type="text/javascript">
function init() {
   
    document.getElementById("regform").reset();
    $('#regform').find('input[type=password]').reset();
}


window.onload = init;

</script>

<!-- save browser password email reset end -->
<style type="text/css">
  #fname-error{margin-top:34px;border:none !important; margin-right: -4}
  #lname-error{margin-top: 34px;border:none !important;    margin-right: 8px;}
  #email-error{border:none !important;margin-top: 34px;    margin-right: 8px;}
  #password-error{margin-top: 34px !important;border:none !important;    margin-right: 8px;}
  #gen-error{top: 55px;width: 80px;border: none !important; margin-right: 6px;}

</style>