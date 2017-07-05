<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grow Business Network|Hiring|Search Jobs|Freelance Work|It's Free|Aileensoul</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/common-style.css">
  <link rel="stylesheet" href="css/style-main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="main-login">
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-3">
          <h2 class="logo"><a href="<?php echo base_url('main'); ?>">Aileensoul</a></h2>
        </div>
        <div class="col-md-8 col-sm-9">
          <form class="header-login" name="login_form" id="login_form" method="post">
            <div class="input">
              <input type="email" name="email_login" id="email_login" class="form-control input-sm" placeholder="Email Address">
              </div>
              <div class="input">
              <input type="password" name="password_login" id="password_login" class="form-control input-sm" placeholder="Password">
            </div>
            <div class="btn-right">
              <button class="btn1">Login</button>
              <a tabindex="19" id="myBtn" class="f-pass" href="javascript:void(0)">Forgot Password?</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </header>



  <!-- model for forgot password start -->


<div id="myModal" class="modal">
  <div class="modal-content">


  <?php
        $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
        echo form_open('profile/forgot_password', $form_attribute);
    ?>

    <div class="modal-header" style="width: 100%; text-align: center;">

      <span class="close">&times;</span>
      <label style="color: #a0b3b0;">Forgot Password</label>
    </div>


    <div class="modal-body" style="    width: 100%;
    text-align: center;">
        <label  style="margin-bottom: 15px; color: #a0b3b0;"> Enter your e-mail address below to get your password.</label>
        <input style="" type="text" name="forgot_email" id="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

    </div>

    <div class="modal-footer ">
      <!--  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
       -->  
        <div class="submit_btn">              
        <input class="btn btn-theme" type="submit" name="submit" value="Submit" /> 
       </div>
    </div>

  </form>

  </div>
</div>
  <!-- model for forgot password end -->

  <div id="error"></div>
  <section class="middle-main">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-sm-6">
          <div class="top-middle">
            <h3 class="text-effect">We Provide A Platform & Opportunities To</h3>
            <h3 class="text-effect">Every Person In The World To Make Their Career.</h3>
          </div>
          <div class="bottom-middle">
            <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">  
                  <div class="carousel-caption">
                    <img src="img/job.png">
                    <div class="carousel-text">
                      <h3>Job Profile</h3>
                      <p>Find best job options and connect with recruiters.</p>
                    </div>
                  </div>
                </div>
                <div class="item"> 
                  <div class="carousel-caption">
                    <img src="img/rec.png">
                    <div class="carousel-text">
                      <h3>Recruiter Profile</h3>
                      <p>Hire quality employees here.</p>
                    </div>
                  </div>
                </div>
                <div class="item"> 
                  <div class="carousel-caption">
                    <img src="img/freelancer.png">
                    <div class="carousel-text">
                      <h3>Freelancer Profile</h3>
                      <p>Hire freelancers and also find freelance work.</p>
                    </div>
                  </div>
                </div>
                <div class="item"> 
                  <div class="carousel-caption">
                    <img src="img/business.png">
                    <div class="carousel-text">
                      <h3>Business Profile</h3>
                      <p>Grow your business network.</p>
                    </div>
                  </div>
                </div>
                <div class="item"> 
                  <div class="carousel-caption">
                    <img src="img/art.png">
                    <div class="carousel-text">
                      <h3>Artistic Profile</h3>
                      <p> Show your art & talent to the world.</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-5 col-sm-6">
          <div class="login">
            <h4>Join Aileensoul - It's Free</h4>
            <form role="form" name="register_form" id="register_form" method="post">
                <div class="row">
                  <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="email" name="email_reg" id="email_reg" class="form-control input-sm" placeholder="Email Address">
                </div>
              <div class="form-group">
                  <input type="password" name="password_reg" id="password_reg" class="form-control input-sm" placeholder="Password">
                </div>
              <div class="form-group dob">
                <select class="day" name="selday" id="selday">
                  <option value="" disabled selected value>Date</option>
                  <?php
                  for($i = 1; $i <= 31; $i++){
                  ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <select class="month" name="selmonth" id="selmonth">
                  <option value="" disabled selected value>Month</option>
                  //<?php
//                  for($i = 1; $i <= 12; $i++){
//                  ?>
                  <option value="1">Jan</option>
                  <option value="2">Feb</option>
                  <option value="3">Mar</option>
                  <option value="4">Apr</option>
                  <option value="5">May</option>
                  <option value="6">Jun</option>
                  <option value="7">Jul</option>
                  <option value="8">Aug</option>
                  <option value="9">Sep</option>
                  <option value="10">Oct</option>
                  <option value="11">Nov</option>
                  <option value="12">Dec</option>
                  //<?php
//                  }
//                  ?>
                </select>
                <select class="year" name="selyear" id="selyear">
                  <option value="" disabled selected value>Year</option>
                  <?php
                  for($i = date('Y'); $i >= 1900; $i--){
                  ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php
                  }
                  ?>

                </select>
              </div>
              
              <div class="form-group gender-custom">
                <select class="gender" name="selgen" id="selgen">
                  <option value="" disabled selected value>Gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
              </div>
              
              <p class="form-text">
                By Clicking on create an account button you agree our<br>
                <a href="#">Terms and Condition</a> and <a href="#">Privacy Policy</a>.
              </p>
                <p>
                <button class="btn1">Create an account</button>
              </p>
              </form>
            
          </div>
        </div>
      </div>
      
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-4">
          © 2017 | by Aileensoul
        </div>
        <div class="col-md-6 col-sm-8">
          <ul>
            <li><a href="<?php echo base_url('about_us'); ?>">About Us</a>|</li>
            <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a>|</li>
            <li><a href="javascript:void(0);">Blogs</a>|</li>
            <li><a href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>

</body>
</html>

<script>
  $( document ).ready(function() {
    
    // text animation effect 
    var $lines = $('.top-middle h3.text-effect');
      $lines.hide();
      var lineContents = new Array();

      var terminal = function() {

        var skip = 0;
        typeLine = function(idx) {
        idx == null && (idx = 0);
        var element = $lines.eq(idx);
        var content = lineContents[idx];
        if(typeof content == "undefined") {
          $('.skip').hide();
          return;
        }
        var charIdx = 0;

        var typeChar = function() {
          var rand = Math.round(Math.random() * 150) + 25;

          setTimeout(function() {
          var char = content[charIdx++];
          element.append(char);
          if(typeof char !== "undefined")
            typeChar();
          else {
            element.append('<br/><span class="output">' + element.text().slice(9, -1) + '</span>');
            element.removeClass('active');
            typeLine(++idx);
          }
          }, skip ? 0 : rand);
        }
        content = '' + content + '';
        element.append(' ').addClass('active');
        typeChar();
        }

        $lines.each(function(i) {
        lineContents[i] = $(this).text();
        $(this).text('').show();
        });

        typeLine();
      }

      terminal();
  
  });
</script>


<!-- script for login  user valoidtaion start -->

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
                            //validation for edit email formate form
                            $(document).ready(function () {
                                /* validation */
                                $("#login_form").validate({
                                    rules: {
                                        email_login: {
                                            required: true,
                                        },
                                        password_login: {
                                            required: true,
                                        }
                                    },
                                    messages:
                                            {
                                                email_login: {
                                                    required: "Please enter email address",
                                                },
                                                password_login: {
                                                    required: "Please enter password",
                                                }
                                            },
                                    submitHandler: submitForm
                                });
                                /* validation */
                                /* login submit */
                                function submitForm()
                                {
                                    var email_login = $("#email_login").val();
                                    var password_login = $("#password_login").val();
                                    var post_data = {
                                        'email_login': email_login,
                                        'password_login': password_login,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                    }
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url() ?>registration/check_login',
                                        data: post_data,
                                        beforeSend: function ()
                                        {
                                            $("#error").fadeOut();
                                            $("#btn-login").html('Login ...');
                                        },
                                        success: function (response)
                                        { 
                                            if (response == "ok") {
                                                $("#btn-login").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Login ...');

                                               window.location= "<?php echo base_url() ?>dashboard"; 

                                                //setTimeout(' window.location.href = "<?php //echo base_url() ?>home"; ', 4000);
                                               // setTimeout(' window.location.href = ""; ', 4000);
                                            }else if(response == "password"){

                                             $("#error").fadeIn(1000, function () {
                                                    $("#error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Please enter valid password' + ' !</div>');
                                                    $("#btn-login").html('Login');
                                                }); 

                                            }
                                            else { 
                                                $("#error").fadeIn(1000, function () {
                                                    $("#error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                                                    $("#btn-login").html('Login');
                                                });
                                            }
                                        }
                                    });
                                    return false;
                                }
                                /* login submit */
                            });



</script>


<!-- login validtaion and submit end -->

<!-- validation for edit email formate form strat -->

<script>
                            $(document).ready(function () { 
                                $("#register_form").validate({ 
                                    rules: {
                                        first_name: {
                                            required: true,
                                        },
                                        last_name: {
                                            required: true,
                                        },
                                        email_reg: {
                                            required: true,
                                             remote: {
                                               url: "<?php echo site_url() . 'registration/check_email' ?>",
                                             type: "post",
                                              data: {
                                    email_reg: function () {
                                     // alert("hi");
                                        return $("#email_reg").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                              },
                                        },
                                        password_reg: {
                                            required: true,
                                        },
                                        selday: {
                                            required: true,
                                        },
                                        selmonth: {
                                            required: true,
                                        },
                                        selyear: {
                                            required: true,
                                        },
                                        selgen: {
                                            required: true,
                                        }
                                    },


                                    groups: {
                                        selyear: "selyear selmonth selday"
                                     },
                                    messages:
                                            {
                                                first_name: {
                                                    required: "Please enter first name",
                                                },
                                                last_name: {
                                                    required: "Please enter last name",
                                                },
                                                email_reg: {
                                                    required: "Please enter email address",
                                                    remote: "Email address already exists",
                                                },
                                                password_reg: {
                                                    required: "Please enter password",
                                                },
                                              
                                                selday: {
                                                    required: "Please enter your birthdate",
                                                },
                                                selmonth: {
                                                    required: "Please enter your birthdate",
                                                },
                                                selyear: {
                                                    required: "Please enter your birthdate",
                                                },
                                                selgen: {
                                                    required: "Please enter your gender",
                                                }
                                               
                                            },
                                    submitHandler: submitRegisterForm
                                });
                                /* register submit */
                                function submitRegisterForm()
                                {
                                    var first_name = $("#first_name").val();
                                    var last_name = $("#last_name").val();
                                    var email_reg = $("#email_reg").val();
                                    var password_reg = $("#password_reg").val();
                                    var selday = $("#selday").val();
                                    var selmonth = $("#selmonth").val();
                                    var selyear = $("#selyear").val();
                                    var selgen = $("#selgen").val();
                                    
                                    var post_data = {
                                        'first_name': first_name,
                                        'last_name': last_name,
                                        'email_reg': email_reg,
                                        'password_reg': password_reg,
                                        'selday': selday,
                                        'selmonth': selmonth,
                                        'selyear': selyear,
                                        'selgen': selgen,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                    }
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url() ?>registration/reg_insert',
                                        data: post_data,
                                        beforeSend: function ()
                                        {
                                            $("#register_error").fadeOut();
                                            $("#btn-register").html('Sign Up ...');
                                        },
                                        success: function (response)
                                        {
                                            if (response == "ok") {
                                                $("#btn-register").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Sign Up ...');

                                                 window.location= "<?php echo base_url() ?>dashboard";
                                               // setTimeout(' window.location.href = "<?php //echo base_url() ?>dashboard"; ', 4000);
                                            }
                                            else {
                                                $("#register_error").fadeIn(1000, function () {
                                                    $("#register_error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                                                    $("#btn-register").html('Sign Up');
                                                });
                                            }
                                        }
                                    });
                                    return false;
                                }
                               });

</script>




<!-- forgot password script start -->


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!-- forgot password script end -->
<script type="text/javascript">
$(document).ready(function () { //aletr("hii");
          /* validation */
          $("#forgot_password").validate({
              rules: {
                  forgot_email: {
                      required: true,
                        }
                  
                        },
            messages:  {
                    forgot_email: {
                    required: "Email Address Is Required.",
                      }

                    
                   },
                });
            /* validation */
                                    
          });
</script>


<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);

   
        
       $("#email_reg").val('');
       $("#password_reg").val('');
   
   });
   //For Scroll page at perticular position js End
</script>



<script type="text/javascript">
// disable spacebar js start
$(document).ready(function(){
$("#email_reg").on("keydown", function (e) {
return e.which !== 32;
});
}); 

$(document).ready(function(){
  $("#password_reg").on("keydown", function (e) {
return e.which !== 32;
});
}); 

// disable spacebar js end
</script>