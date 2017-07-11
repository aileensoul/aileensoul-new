<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grow Business Network|Hiring|Search Jobs|Freelance Work|It's Free|Aileensoul</title>
  <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="stylesheet" href="css/common-style.css">
  <link rel="stylesheet" href="css/style-main.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
  <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
</head>
<body>
<div class="main-inner">
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-3">
          <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
        </div>
        <div class="col-md-8 col-sm-9">
            <div class="btn-right pull-right">
              <a href="<?php echo base_url('login'); ?>" class="btn2">Login</a>
              <a href="<?php echo base_url('registration'); ?>" class="btn3">Creat an account</a>
            </div>
        </div>
      </div>
    </div>
  </header>
  <section class="middle-main">
    <div class="container">
      
       

        <div id="feedbacksucc"></div>

        
        <div class="inner-form pt-50">
          <div class="login">
             <div class="title">
          <h1>Send us feedback</h1>
        </div>
            <form role="form" name="feedback_form" id="feedback_form" method="post">
                <div class="row">
                  <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="feedback_firstname" id="feedback_firstname" class="form-control input-sm required" placeholder="First Name*">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="feedback_lastname" id="feedback_lastname" class="form-control input-sm" placeholder="Last Name*">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="email" name="feedback_email" id="feedback_email" class="form-control input-sm" placeholder="Email Address*">
                </div>
              <div class="form-group">
                  <input type="text" name="feedback_subject" id="feedback_subject" class="form-control input-sm" placeholder="Subject*">
                </div>
              <div class="form-group">
                <textarea type="text" id="feedback_message" name="feedback_message" class="form-control" placeholder="Message*"></textarea>
                  
                </div>
              
              
              <p class="pb15">
                <span class="red">*</span>All fields are mendatory
              </p>
                <p>
                <button class="btn1">Submit</button>
              </p>
              </form>
            
          </div>
        </div>
        
      
    </div>
  </section>

  <footer>
    <div class="container pt-20">
      <div class="row">
        
        <div class="col-md-6 col-sm-8 pull-right col-xs-12">
          <ul>
            <li><a href="<?php echo base_url('about_us'); ?>">About Us</a>|</li>
            <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a>|</li>
            <li><a href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a></li>
          </ul>
        </div>
		<div class="col-md-6 col-sm-4">
          © 2017 | by Aileensoul
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



<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<!-- validation for edit email formate form strat -->

<script>
                            $(document).ready(function () { 
                                $("#feedback_form").validate({ 
                                    rules: {
                                        feedback_firstname: {
                                            required: true,
                                        },
                                        feedback_lastname: {
                                            required: true,
                                        },
                                        feedback_email: {
                                            required: true,
                                        },
                                        feedback_subject: {
                                            required: true,
                                        },
                                        feedback_message: {
                                            required: true,
                                        }
                                        
                                    },


                                    messages:
                                            {
                                                feedback_firstname: {
                                                    required: "Please enter first name",
                                                },
                                                feedback_lastname: {
                                                    required: "Please enter last name",
                                                },
                                                feedback_email: {
                                                    required: "Please enter email address",
                                                    
                                                },
                                                feedback_subject: {
                                                    required: "Please enter subject",
                                                },
                                              
                                                feedback_message: {
                                                    required: "Please enter your feedback",
                                                }
                                               
                                            },
                                    submitHandler: submitRegisterForm
                                });
                                /* register submit */
                                function submitRegisterForm()
                                {
                                    var feedback_firstname = $("#feedback_firstname").val();
                                    var feedback_lastname = $("#feedback_lastname").val();
                                    var feedback_email = $("#feedback_email").val();
                                    var feedback_subject = $("#feedback_subject").val();
                                    var feedback_message = $("#feedback_message").val();
                                    
                                    
                                    var post_data = {
                                        'feedback_firstname': feedback_firstname,
                                        'feedback_lastname': feedback_lastname,
                                        'feedback_email': feedback_email,
                                        'feedback_subject': feedback_subject,
                                        'feedback_message': feedback_message,
                                        
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                    }
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url() ?>feedback/feedback_insert',
                                        data: post_data,
                                        beforeSend: function ()
                                        {
                                            $("#register_error").fadeOut();
                                            $("#btn-register").html('Sign Up ...');
                                        },
                                        success: function (response)
                                        {
                                            if (response == "ok") {

                                              $("#feedback_firstname").val('');
                                              $("#feedback_lastname").val('');
                                              $("#feedback_email").val('');
                                              $("#feedback_subject").val('');
                                              $("#feedback_message").val('');
                                              
                                               $.fancybox.open('<div class="alert alert-danger feedback"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Your feedback send successfully' + ' !</div>');
//                                                 $("#feedbacksucc").fadeIn(1000, function () {
//                                                    $("#feedbacksucc").html('<div class="alert alert-danger feedback"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Your feedback send successfully' + ' !</div>');
//                                                    $("#btn-register").html('Sign Up');
//                                                });
                                               // setTimeout(' window.location.href = "<?php //echo base_url() ?>dashboard"; ', 4000);
                                            }
                                            else {
                                                
                                                $.fancybox.open('<div class="alert alert-danger feedback"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' +'your feedback not send successfully' + ' !</div>'); 
//                                                $("#feedbacksucc").fadeIn(1000, function () {
//                                                    $("#feedbacksucc").html('<div class="alert alert-danger feedback"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' +'your feedback not send successfully' + ' !</div>');
//                                                    $("#btn-register").html('Sign Up');
//                                                });
                                            }
                                        }
                                    });
                                    return false;
                                }
                               });

</script>


</body>
</html>