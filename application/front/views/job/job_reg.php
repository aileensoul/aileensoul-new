<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<!-- Calender Css Start-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.datetimepicker.css'); ?>">
<!-- Calender Css End-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<body>
   <section>
      <div class="user-midd-section " id="paddingtop_fixed">
         <div class="container">
            <div class="row">
               <div class="col-md-3"></div>
               <div class="clearfix">
                  <div class="job_reg_page_fprm">
                     <div class="common-form job_reg_main">
                        <h3>Welcome In Job Profile</h3>
                        <?php echo form_open(base_url('job/job_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                        <fieldset>
                           <label >First Name <font  color="red">*</font> :</label>
                           <input type="text" name="first_name" id="first_name" tabindex="1" placeholder="Enter your First Name" style="text-transform: capitalize;" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" value="<?php echo $job[0]['first_name'];?>" maxlength="35">
                        </fieldset>
                        <fieldset>
                           <label >Last Name <font  color="red">*</font>:</label>
                           <input type="text" name="last_name" id="last_name" tabindex="2" placeholder="Enter your Last Name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="<?php echo $job[0]['last_name'];?>" maxlength="35">
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Email Address <font  color="red">*</font> :</label>
                           <input type="text" name="email" id="email" tabindex="3" placeholder="Enter your Email Address" value="<?php echo $job[0]['user_email'];?>" maxlength="255">
                        </fieldset>
                        <fieldset class="fresher_radio col-xs-12" >
                           <label>Fresher <font  color="red">*</font> : </label>
                           <div class="main_raio">
                              <input type="radio" value="Fresher" tabindex="" id="test1" name="fresher" class="radio_job" id="fresher">
                              <label for="test1" class="point_radio" >Yes</label>
                           </div>
                           <div class="main_raio">
                              <input type="radio" tabindex="" value="Experience" id="test2" class="radio_job" name="fresher" id="fresher" checked>
                              <label for="test2" class="point_radio">No</label>
                           </div>
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Job Title<font  color="red">*</font> :</label>
                           <input type="search" tabindex="6" id="job_title" name="job_title" value="" placeholder="Ex:- Sr. Engineer, Jr. Engineer, Software Developer, Account Manager" style="text-transform: capitalize;" onfocus="this.value = this.value;" maxlength="255">
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="skills"> Skills<font  color="red">*</font> : </label>
                           <input id="skills2" name="skills" tabindex="7"  size="90" placeholder="Enter SKills">
                        </fieldset>
                        <fieldset class="full-width main_select_data">
                           <label>Industry <font  color="red">*</font> :</label>
                           <select name="industry" id="industry" tabindex="8">
                              <option value="">Select industry</option>
                              <?php foreach ($industry as $indu) { ?>
                              <option value="<?php echo $indu['industry_id']; ?>"><?php echo $indu['industry_name']; ?></option>
                              <?php } ?>
                           </select>
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="cities">Preffered location for job<font  color="red">*</font> : </label>
                           <input id="cities2" name="cities"  size="90" tabindex="9" placeholder="Enter Preferred Cites">
                        </fieldset>
                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <input type="submit"   id="submit" name="" value="Register" tabindex="10">
                           </div>
                        </fieldset>
                        <?php echo form_close();?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- END CONTAINER -->
   <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
   <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
   <script>
      // job title script start
         $(function() {
             function split( val ) {
                 return val.split( /,\s*/ );
             }
             function extractLast( term ) {
                 return split( term ).pop();
             }
             
             $( "#job_title" ).bind( "keydown", function( event ) {
                 if ( event.keyCode === $.ui.keyCode.TAB &&
                     $( this ).autocomplete( "instance" ).menu.active ) {
                     event.preventDefault();
                 }
             })
             .autocomplete({
                 minLength: 2,
                 source: function( request, response ) { 
                     // delegate back to autocomplete, but extract the last term
                     $.getJSON("<?php echo base_url();?>general/get_jobtitle", { term : extractLast( request.term )},response);
                 },
                 focus: function() {
                     // prevent value inserted on focus
                     return false;
                 },
      
                  select: function(event, ui) {
                event.preventDefault();
                $("#job_title").val(ui.item.label);
                $("#selected-tag").val(ui.item.label);
                // window.location.href = ui.item.value;
            },
          
             });
         });
   </script>
   <script>
      $.validator.addMethod("lowercase", function(value, element, regexpr) {          
          return regexpr.test(value);
      }, "email Should be in Small Character");
      
      
       $.validator.addMethod("regx2", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
          //alert(value);
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      //alert(value);
                      return regexpr.test(value);
      
                      //return false;
                  }
           // return regexpr.test(value);
      },"special character and space not allow in the beginning");
      
      $.validator.addMethod("regx_digit", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
          //alert(value);
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      //alert(value);
                      return regexpr.test(value);
      
                      //return false;
                  }
           // return regexpr.test(value);
      },"digit is not allow");
      
      $.validator.addMethod("regx1", function(value, element, regexpr) {          
          //return value == '' || value.trim().length != 0; 
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                        return regexpr.test(value);
                  }
           // return regexpr.test(value);
      }, "only space, only number and only special characters are not allow");
      
      
       $("#jobseeker_regform").validate({
      
                 ignore: '*:not([name])',
              
               rules: {
      
                      first_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                          //noSpace: true
      
                      },
      
                      last_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                          //noSpace: true
      
                      },
                      
                      cities: {
      
                          required: true,
                        //  regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                          //noSpace: true
      
                      },
      
                      email: {
      
                          required: true,
                          email: true,
                          lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                         remote: {
                             url: "<?php echo base_url() . 'job/check_email' ?>",
                             //async is used for double click on submit avoid
                             async:false,
                             type: "post",
                             data: {
                                 email: function () {
      
                                     return $("#email").val();
                                 },
                                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                             },
                         },
                      },
      
                      fresher: {
      
                          required: true,
      
                      },
                      
                       job_title: {
      
                          required: "#test2:checked",
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                      //    regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                       //   noSpace: true
                       },
                       
                       industry: {
      
                          required: true,
                         // regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                         // noSpace: true
                       },
                       
                       cities: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                      //    regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                        //  noSpace: true
                       },
                       
                       skills: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                  //required:true 
                      },
                     
                  },
      
                  messages: {
      
                      first_name: {
      
                          required: "first name Is Required.",
      
                      },
      
                      last_name: {
      
                          required: "last name Is Required.",
      
                      },
      
                      email: {
      
                          required: "email Address Is Required.",
                          email: "please Enter Valid Email Id.",
                          remote: "email already exists"
                      },
                     
                      fresher: {
      
                          required: "fresher Is Required.",
      
                      },
                      
                      industry: {
      
                          required: "industry Is Required.",
      
                      },
                      
                      cities: {
      
                          required: "city Is Required.",
      
                      },
                      
                      job_title: {
      
                          required: "job title Is Required.",
      
                      },
                      
                       skills: {
      
                           required: "skill Is Required.",
      
                      }
      
                  },
      
              });
             
   </script>
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <!--new script for cities start-->
   <script>
      $(function() {
          function split( val ) {
              return val.split( /,\s*/ );
          }
          function extractLast( term ) {
              return split( term ).pop();
          }
          
          $( "#cities2" ).bind( "keydown", function( event ) {
              if ( event.keyCode === $.ui.keyCode.TAB &&
                  $( this ).autocomplete( "instance" ).menu.active ) {
                  event.preventDefault();
              }
          })
          .autocomplete({
              minLength: 2,
              source: function( request, response ) { 
                  // delegate back to autocomplete, but extract the last term
                  $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
              },
              focus: function() {
                  // prevent value inserted on focus
                  return false;
              },
              select: function( event, ui ) {
                 
                  var terms = split( this.value );
                  if(terms.length <= 10) {
                      // remove the current input
                      terms.pop();
                      // add the selected item
                      terms.push( ui.item.value );
                      // add placeholder to get the comma-and-space at the end
                      terms.push( "" );
                      this.value = terms.join( ", " );
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
   </script>
   <!--new script for cities end-->
   <!--new script for skill start-->
   <script>
      $(function() {
          function split( val ) {
              return val.split( /,\s*/ );
          }
          function extractLast( term ) { 
              return split( term ).pop();
          }
          
          $( "#skills2" ).bind( "keydown", function( event ) {
              if ( event.keyCode === $.ui.keyCode.TAB &&
                  $( this ).autocomplete( "instance" ).menu.active ) {
                  event.preventDefault();
              }
          })
          .autocomplete({
              minLength: 2,
              source: function( request, response ) { 
                  // delegate back to autocomplete, but extract the last term
                  $.getJSON("<?php echo base_url();?>general/get_skill", { term : extractLast( request.term )},response);
              },
              focus: function() {
                  // prevent value inserted on focus
                  return false;
              },
              select: function( event, ui ) {
                 
                  var terms = split( this.value );
                  if(terms.length <= 20) {
                      // remove the current input
                      terms.pop();
                      // add the selected item
                      terms.push( ui.item.value );
                      // add placeholder to get the comma-and-space at the end
                      terms.push( "" );
                      this.value = terms.join( ", " );
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
   </script>
   <!--new script for skill end-->
</body>
</html>