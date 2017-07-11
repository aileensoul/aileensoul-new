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
    <div class="user-midd-section">
     
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

                        <input type="hidden" id="example2">

          <!-- <input name="dob"  type="date" id="date" class="form-control"  value="<?php //echo date('Y-m-d', strtotime($userdata[0]['user_dob']))?>"   onblur="return email_id();"/> <span id="email-error"></span> -->
          
          <?php echo form_error('email'); ?>
          
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
                           
                        datepicker: {

                            required: true,
                            // date: true
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
                           
                        
                         datepicker: {

                            required: "Date of Birth Is Required."

                        },
                         
                        gen: {

                            required: "Gender Is Required."
                        }
                 
                    },

                });
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
<script>
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
</script>

<style type="text/css">
    .date-dropdowns label{margin-top: 42px !important;}
</style>

