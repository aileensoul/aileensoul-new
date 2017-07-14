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
  <section class="middle-main pd-low">
		<div class="container">
			<div id="contactsucc"></div>
			<div class="">
				<div class="inner-form">
					<div class="login">
						<div class="title">
						  <h1>Contact us</h1>
						</div>
						<form role="form" name="contact_form" id="contact_form" method="post">
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
									  <input type="text" name="contact_name" id="contact_name" class="form-control input-sm required" placeholder="First Name*">
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
									  <input type="text" name="contactlast_name" id="contactlast_name" class="form-control input-sm" placeholder="Last Name*">
									</div>
								</div>
							</div>
							<div class="form-group">
							  <input type="email" name="contact_email" id="contact_email" class="form-control input-sm" placeholder="Email Address*">
							</div>
							<div class="form-group">
								<input type="text" name="contact_subject" id="contact_subject" class="form-control input-sm" placeholder="Subject*">
							</div>
							<div class="form-group">
								<textarea type="text" id="contact_message" name="contact_message" class="form-control" placeholder="Message*"></textarea>
								  
							</div>
							<p class="pb15">
								<span class="red">*</span>All fields are mendatory
							</p>
							<p>
								<button class="btn1">Submit</button>
							  </p>
						</div>
					</div>
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
	  //  login form css
      // button ripple effect from @ShawnSauce 's pen http://codepen.io/ShawnSauce/full/huLEH
      
      $(function(){
        
        var animationLibrary = 'animate';
        
        $.easing.easeOutQuart = function (x, t, b, c, d) {
        return -c * ((t=t/d-1)*t*t*t - 1) + b;
        };
        $('[ripple]:not([disabled],.disabled)')
        .on('mousedown', function( e ){
        
        var button = $(this);
        var touch = $('<touch><touch/>');
        var size = button.outerWidth() * 1.8;
        var complete = false;
        
        $(document)
        .on('mouseup',function(){
          var a = {
          'opacity': '0'
          };
          if( complete === true ){
          size = size * 1.33;
          $.extend(a, {
            'height': size + 'px',
            'width': size + 'px',
            'margin-top': -(size)/2 + 'px',
            'margin-left': -(size)/2 + 'px'
          });
          }
          
          touch
          [animationLibrary](a, {
          duration: 500,
          complete: function(){touch.remove();},
          easing: 'swing'
          });
        });
        
        touch
        .addClass( 'touch' )
        .css({
          'position': 'absolute',
          'top': e.pageY-button.offset().top + 'px',
          'left': e.pageX-button.offset().left + 'px',
          'width': '0',
          'height': '0'
        });
        
        /* IE8 will not appendChild */
        button.get(0).appendChild(touch.get(0));
        
        touch
        [animationLibrary]({
          'height': size + 'px',
          'width': size + 'px',
          'margin-top': -(size)/2 + 'px',
          'margin-left': -(size)/2 + 'px'
        }, {
          queue: false,
          duration: 500,
          'easing': 'easeOutQuart',
          'complete': function(){
          complete = true
          }
        });
        });
      });

      var username = $('#username'), 
        password = $('#password'), 
        erroru = $('erroru'), 
        errorp = $('errorp'), 
        submit = $('#submit'),
        udiv = $('#u'),
        pdiv = $('#p');

      username.blur(function() {
        if (username.val() == '') {
        udiv.attr('errr','');
        } else {
        udiv.removeAttr('errr');
        }
      });

      password.blur(function() {
      if(password.val() == '') {
        pdiv.attr('errr','');
        } else {
        pdiv.removeAttr('errr');
        }
      });

      submit.on('click', function(event) {
        event.preventDefault();
        if (username.val() == '') {
        udiv.attr('errr','');
        } else {
        udiv.removeAttr('errr');
        } 
        if(password.val() == '') {
        pdiv.attr('errr','');
        } else {
        pdiv.removeAttr('errr');
        }
      });
      

      
      
  
  });
</script>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<!-- validation for edit email formate form strat -->

<script>
                            $(document).ready(function () { 
                                $("#contact_form").validate({ 
                                    rules: {
                                        contact_name: {
                                            required: true,
                                        },
                                        contactlast_name: {
                                            required: true,
                                        },
                                        contact_email: {
                                            required: true,
                                        },
                                        contact_subject: {
                                            required: true,
                                        },
                                        contact_message: {
                                            required: true,
                                        }
                                        
                                    },


                                    messages:
                                            {
                                                contact_name: {
                                                    required: "Please enter first name",
                                                },
                                                contactlast_name: {
                                                    required: "Please enter last name",
                                                },
                                                contact_email: {
                                                    required: "Please enter email address",
                                                    
                                                },
                                                contact_subject: {
                                                    required: "Please enter subject",
                                                },
                                              
                                                contact_message: {
                                                    required: "Please enter your message",
                                                }
                                               
                                            },
                                    submitHandler: submitRegisterForm
                                });
                                /* register submit */
                                function submitRegisterForm()
                                {
                                    var contact_name = $("#contact_name").val();
                                    var contactlast_name = $("#contactlast_name").val();
                                    var contact_email = $("#contact_email").val();
                                    var contact_subject = $("#contact_subject").val();
                                    var contact_message = $("#contact_message").val();
                                    
                                    
                                    var post_data = {
                                        'contact_name': contact_name,
                                        'contactlast_name': contactlast_name,
                                        'contact_email': contact_email,
                                        'contact_subject': contact_subject,
                                        'contact_message': contact_message,
                                        
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                    }
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url() ?>contact_us/contact_us_insert',
                                        data: post_data,
                                        beforeSend: function ()
                                        {
                                            $("#register_error").fadeOut();
                                            $("#btn-register").html('Sign Up ...');
                                        },
                                        success: function (response)
                                        {
                                            if (response == "ok") {

                                              $("#contact_name").val('');
                                              $("#contactlast_name").val('');
                                              $("#contact_email").val('');
                                              $("#contact_subject").val('');
                                              $("#contact_message").val('');
                                              
                                          $.fancybox.open('<div class="alert alert-danger contactus"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Your message send successfully' + ' !</div>');
                                          
//                                                 $("#contactsucc").fadeIn(1000, function () {
//                                                    $("#contactsucc").html('<div class="alert alert-danger contactus"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Your message send successfully' + ' !</div>');
//                                                    $("#btn-register").html('Sign Up');
                                              //  });
                                               // setTimeout(' window.location.href = "<?php //echo base_url() ?>dashboard"; ', 4000);
                                            }
                                            else {
                                          
                                           $.fancybox.open('<div class="alert alert-danger contactus"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' +'your conatct not send successfully' + ' !</div>');
//                                                $("#contactsucc").fadeIn(1000, function () {
//                                                    $("#contactsucc").html('<div class="alert alert-danger contactus"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' +'your conatct not send successfully' + ' !</div>');
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