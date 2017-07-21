<!--post save success pop up style strat -->
<style type="text/css">
  .dropdown-content_hover::before {
    /* top: -1px; */
    content: '';
    display: block;
    position: absolute;
    width: 0;
    height: 0;
    color: transparent;
    border: 9px solid black;
    border-color: transparent transparent #fff;
    margin-top: -18px;
    /* margin-left: 104px; */
    right: 10px;
}
</style>
<header>
    <div class="bg-search">
        <div class="header2 ">
            <div class="container">
                <div class="row">
                     <?php echo $freelancer_hire_search; ?>
                  <div class="col-md-5 col-sm-5">
                       <div class="">
                            <ul class="">
                               
                                  <li <?php if(($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'projects')){?> class="active" <?php } ?>>

                                   <?php if(($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')){?>
                                
                               
                                 <a href="javascript:void(0);" class="button" onclick="return leave_page(1)">Home</a>
                                 <?php }else{?>

                                <a href="<?php echo base_url('freelancer-hire/home'); ?>">Home
                                  </a>
                                 <?php } ?>
                                  

                                    </li>
    
                                <!-- Friend Request Start-->
  <li>
                                <!-- Friend Request End-->

<div class="dropdown_hover">
  <span id="art_profile">Employer Profile <i class="fa fa-angle-down" aria-hidden="true"></i></span>
  <div class="dropdown-content_hover" id="dropdown-content_hover">
    <?php if(($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')){?>
                                
                               

                                  <a onclick="return leave_page(2)"><i class="fa fa-user" aria-hidden="true"></i>View Profile</a>
                                 <?php }else{?>

                                <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>"><i class="fa ffreelancer/freelancer_hire_profilea-user" aria-hidden="true"></i> View Profile</a>
                                 <?php } ?>

   <?php if(($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'freelancer_edit_post')){?>

   <a onclick="return leave_page(3)"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Profile</a>

     <?php }else{?>
     
 <a href="<?php echo base_url('freelancer-hire/basic-information'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>      <?php } ?>
   
     <?php
      $userid = $this->session->userdata('aileenuser');
      ?>

    <a onClick="deactivate(<?php echo $userid; ?>)"><i class="fa fa-minus-circle" aria-hidden="true"></i> Deactive Profile</a>
  </div>
</div>
</li>
                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div> 
                    </div>
                  
                
                </div>
            </div>
        </div>
       </div> 
    </header>


<!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                        <div class="modal-dialog modal-lm deactive">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->


    <script type="text/javascript">
  

$(document).ready(function(){
    $('.dropdown_hover').click(function(event){
        event.stopPropagation();
         $(".dropdown-content_hover").slideToggle("fast");
    });
    $(".dropdown-content_hover").on("dropdown_hover", function (event) {
        event.stopPropagation();
    });
});

$(document).on("dropdown_hover", function () {
    $(".dropdown-content_hover").hide();
});

$(document).ready(function() {
     $("body").click(function(event) {
        $(".dropdown-content_hover").hide();
        event.stopPropagation();
    });
 
});
</script>


<script type="text/javascript">

  function deactivate(clicked_id) { 
      $('.biderror .mes').html("<div class='pop_content'> Are you sure you want to deactive your Freelancer Hire profile?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='deactivate_profile(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
          $('#bidmodal').modal('show');
 }

 function deactivate_profile(clicked_id){

                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . "freelancer-hire/deactivate" ?>',
                      data: 'id=' + clicked_id,
                        success: function (data) {
                          window.location= "<?php echo base_url() ?>dashboard";
                                    
                                }
                            });



 }
 </script>


 <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

   $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( "#dropdown-content_hover" ).hide();
    }
});  


    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->