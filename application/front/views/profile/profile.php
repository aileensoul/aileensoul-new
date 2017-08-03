<!--start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->


<!-- Calender Css Start-->
   <style type="text/css">

.date-dropdowns .day, .date-dropdowns .month, .date-dropdowns .year{width: 30%; float: left; margin-right: 5%;}
.date-dropdowns .year{margin-right: 0;}
.example {
    width: 33%;
    min-width: 400px;
    padding: 15px;
    display: inline-block;
    box-sizing: border-box;
    text-align: center;
}

.example:first-of-type {
    position: relative;
    bottom: 35px;
}

/* Example Heading */
.example h2 {
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
    font-size: 1.3em;
    margin: 15px 0;
    color: #4F5462;
}

.example input {
    display: block;
    margin: 0 auto 20px auto;
    width: 150px;
    padding: 8px 10px;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    background: #F2F2F2;
    text-align: center;
    font-size: 1em;
    letter-spacing: 0.02em;
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
}

.example select {
    padding: 10px;
    background: #ffffff;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    margin: 0 3px;
}

.example select.invalid {
    color: #E9403C;
}

.example input[type="submit"] {
    margin-top: 10px;
}

.example input[type="submit"]:hover {
    cursor: pointer;
    background-color: #e5e5e5;
}


</style>
<!-- css for date picker end-->
   <!-- Calender Css End-->

  <section>
    <div class="user-midd-section" id="paddingtop_fixed">
     
      <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="padd_set">
                        <div class="left-side-bar" id="bs-collapse" >
                            <ul class="left-form-each">
                                <li  <?php if ($this->uri->segment(1) == 'profile') { ?> class="active init" <?php } ?>>  <a href="<?php echo base_url() . 'profile' ?>" data-toggle="collapse" data-parent="#bs-collapse" id="toggle">Edit Profile</a></li>

                                <li> <a href="<?php echo base_url('registration/changepassword') ?>">Change Password</a></li>

                                


                            </ul>
                        </div>
                        </div>
                    </div>
          <div class="col-md-7 col-sm-8">

     
            <div class="common-form profile_edit main_form">
              <h3>Edit Profile</h3>
  

 <?php echo form_open_multipart(base_url('profile/edit_profile'), array('id' => 'basicinfo','name' => 'basicinfo','class' => "clearfix common-form_border")); ?>
                    <fieldset class="">
                      <label >First Name </label>
                      <input name="first_name" type="text" placeholder="Firstname..." id="first_name" value="<?php echo $userdata[0]['first_name']?>" onblur="return full_name();"/><span id="fullname-error"></span><?php echo form_error('first_name'); ?>

                    </fieldset>
                    <fieldset class="">
                      <label>Last Name</label>
                                  <input name="last_name" placeholder="Lastname...." type="text" id="last_name" value="<?php echo $userdata[0]['last_name']?>" onblur="return full_name();"/><span id="fullname-error"></span>
 <?php echo form_error('last_name'); ?>

                    </fieldset>
     <fieldset>           
          
            <label >E-mail Address:</label>
              <input name="email"  type="text" id="email" placeholder="EmailAddress..."  value="<?php echo $userdata[0]['user_email']?>"   onblur="return email_id();"/><span id="email-error"></span> <?php echo form_error('email'); ?>


          </fieldset>
      <fieldset>        

            <label>Birthday:</label>

                      <select tabindex="9" class="day" name="selday" id="selday">
                                                <option value="" disabled selected value>Day</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <select tabindex="10" class="month" name="selmonth" id="selmonth">
                                                <option value="" disabled selected value>Month</option>
                                                //<?php
//                  for($i = 1; $i <= 12; $i++){
//                  
                                                ?>
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
//                  
                                                ?>
                                            </select>
                                            <select tabindex="11" class="year" name="selyear" id="selyear">
                                                <option value="" disabled selected value>Year</option>
                                                <?php
                                                for ($i = date('Y'); $i >= 1900; $i--) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>

          <!-- <input name="dob"  type="date" id="date" class="form-control"  value="<?php //echo date('Y-m-d', strtotime($userdata[0]['user_dob']))?>"   onblur="return email_id();"/> <span id="email-error"></span> -->
          
        <div class="dateerror" style="color:#f00; display: block;"></div>
          
          </fieldset>

                    <fieldset>
                      <label>Gender</label>
                      <input type="radio" id="gen" name="gender" value="M" <?php if($userdata[0]['user_gender'] == M){ echo 'checked'; } ?>>Male
                      <input type="radio" id="gen" name="gender" value="F" <?php if($userdata[0]['user_gender'] == F){ echo 'checked'; } ?>>Female
                    <!-- <input type="radio" id="gen" name="gender" value="O" <?php if($userdata[0]['user_gender'] == O){ echo 'checked'; } ?>> Other
 -->  
                     
          <?php echo form_error('gender'); ?>
          </fieldset>
          <!-- <fieldset>
            <label >Image:</label>
               <?php if($userdata[0]['user_image'] != ''){ ?>
                            <img alt="" class="" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="100" width="100" alt="Smiley face" />
                        <?php } else { ?>
                            <img alt=""  src="<?php echo base_url(NOIMAGE); ?>" height="100" width="200" alt="Smiley face" />
                        <?php } ?>
                        <input type="file" name="profileimg" id="profileimg" value="">
          <?php echo form_error('profileimg'); ?>
          
          </fieldset> -->

           
            
                    <fieldset class="hs-submit full-width">


                        <!-- <input type="reset" value="Reset" name="cancel"> -->
                      <input type="submit" value="submit" name="submit" id="submit">
                                      
                    </fieldset>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
      <!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<!-- <script type="text/javascript">
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
<!- Calender Js End--> 

<footer>
        
        <?php echo $footer;  ?>
    </footer>


<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
                               $(document).ready(function () { 

                $("#basicinfo").validate({

                    rules: {
                      
                        first_name: {

                            required: true,
                            //pattern: /^[A-Za-z]{0,}$/
                        },
                        last_name: {

                            required: true,
                             //pattern: /^[A-Za-z]{0,}$/
                        },
                        email: {

                            required: true,
                            email:true,
                            remote: {
                                    url: "<?php echo site_url() . 'profile/check_email' ?>",
                                    type: "post",
                                    data: {
                                        email: function () {

                                            return $("#email").val();
                                        },
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                },
                             
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
                        gen: {

                            required: true,
                        }
                       
                    },

                    messages: {

                      
                        first_name: {

                            required: "First Name Is Required.",
                            
                        },
                        last_name: {

                            required: "Last Name Is Required."
                        },
                         email: {

                            required: "Email Address Is Required.",
                             email:"Please Enter Valid Email Id.",
                              remote: "Email already exists"
                             
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
                        gen: {

                            required: "Gender Is Required."
                        }
                 
                    },
                    
                  //  submitHandler: submitRegisterForm

                });
                
                   });
                   
                   $("#submit").click(function () {
                   
                      var selday = $("#selday").val();
            var selmonth = $("#selmonth").val();
            var selyear = $("#selyear").val();
           

            var post_data = {
                
                'selday': selday,
                'selmonth': selmonth,
                'selyear': selyear,
               '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }

              
        var todaydate = new Date();
        var dd = todaydate.getDate();
        var mm = todaydate.getMonth()+1; //January is 0!
        var yyyy = todaydate.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

           var todaydate = yyyy+'/'+mm+'/'+dd;
           var value =  selyear+'/'+selmonth+'/'+selday;


            var d1 = Date.parse(todaydate);
            var d2 = Date.parse(value);
           //var one = new Date(value).getTime();
         // var second = new Date(todaydate).getTime();
    //alert(one); alert(second);

        if (d1 < d2){
        
           $(".dateerror").html("Date of birth always less than to today's date.");
            
            return false;
         }else{


            if ((0 == selyear % 4) && (0 != selyear % 100) || (0 == selyear % 400))
            {


                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {

                    if (selday == 31) {

                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) { //alert("hii");
                    if (selday == 31 || selday == 30) {
                        $(".dateerror").html("This month has only 29 days.");
                        return false;

                    }

                }

            } else {


                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {

                    if (selday == 31) {

                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) {
                    if (selday == 31 || selday == 30 || selday == 29) {
                        $(".dateerror").html("This month has only 28 days.");
                        return false;

                    }

                }

            }
        }
         
       });

</script>
 <script type="text/javascript">
  
//script for click on - change to + Start
    $(document).ready(function () {
          
      $('#toggle').on('click', function(){
    
            if($('#panel-heading').hasClass('active')){

                      $('#panel-heading').removeClass('active');

            }else{
                      //$('#one').addClass('in');
                      $('#panel-heading').addClass('active');

                       $('#panel-heading1').removeClass('active');
            }
        });

    
    });
  //script for click on - change to + End

</script>


<script src="<?php echo base_url('js/jquery.date-dropdowns.js'); ?>"></script>
<!--<script>
$(function() {
                

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

var today = yyyy;

var date_picker ='<?php echo date('Y-m-d',strtotime($userdata[0]['user_dob']));?>';


if(date_picker){

     $("#example2").dateDropdowns({
                    submitFieldName: 'datepicker',
                    submitFormat: "dd/mm/yyyy",
                    minYear: 1821,
                    maxYear: today,
                    defaultDate: date_picker,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    

                    //startDate: today,

                });   
}else if(!date_picker){
                $("#example2").dateDropdowns({
                    submitFieldName: 'datepicker',
                    submitFormat: "dd/mm/yyyy",
                    minYear: 1821,
                    maxYear: today,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //defaultDate: date_picker
                    //startDate: today,

                });  
     } 
                
            });
</script>-->

<style type="text/css">
    .date-dropdowns label{margin-top: 42px !important;}
</style>

