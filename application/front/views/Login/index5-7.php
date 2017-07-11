<!DOCTYPE html>
<html lang="en">
<head>
  <title>aileensoul main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/common-style.css">
  <link rel="stylesheet" href="css/style-main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
</head>
<body>
<div class="main-inner">
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-3">
          <h2 class="logo"><a href="<?php echo base_url('main'); ?>">Aileensoul</a></h2>
        </div>
        <div class="col-md-8 col-sm-9">
            <div class="btn-right pull-right">
              
              <a href="<?php echo base_url('registration'); ?>" class="btn3">creat an account</a>
            </div>
        </div>
      </div>
    </div>
  </header>
  <section class="middle-main">
    <div class="container">
      
        <div class="title">
          <h1 class="ttc">Welcome To Aileensoul</h1>
        </div>


         <div id="error"></div>


         
        <div class="inner-form">
          <div class="login">
            
            <form role="form" name="login_form" id="login_form" method="post">
                

                <div class="form-group">
                  <input type="email" name="email_login" id="email_login" class="form-control input-sm" placeholder="Email Address*">
                </div>
              <div class="form-group">
                  <input type="password" name="password_login" id="password_login" class="form-control input-sm" placeholder="Password*">
                </div>
              
              
              
              <p class="pb15 text-center">
                <a href="javascript:void(0)" id="myBtn">Forgot Password ?</a>
              </p>
                <p>
                <button class="btn1">Login</button>
              </p>
              <p class="pt15 text-center">
                Don't have an account? <a href="<?php echo base_url('registration'); ?>">Create an account</a>
              </p>
              </form>
            
          </div>
        </div>
        
      
    </div>
  </section>


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
                                                    $("#error").html('<div class="alert alert-danger login"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Please enter valid password' + ' !</div>');
                                                    $("#btn-login").html('Login');
                                                }); 

                                            }
                                            else { 
                                                $("#error").fadeIn(1000, function () {
                                                    $("#error").html('<div class="alert alert-danger login"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
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


</body>
</html>