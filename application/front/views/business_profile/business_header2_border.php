<style type="text/css">

    #addcontactContainer{
        display: none;
        background-color: #fff;
        border: 1px solid rgba(100, 100, 100, .4);
        -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
        overflow: visible;
        position: absolute;
        top: 30px;
        margin-top: 0px;
        z-index: 2;
        display: none;
        float: left;
        width: 450px;
        right: 0;
    }
    #addcontactContainer::before {
        content: '';
        display: block;
        position: absolute;
        width: 0;
        height: 0;
        color: transparent;
        border: 10px solid black;
        border-color: transparent transparent #e9eaed;
        margin-top: -20px;
        margin-left: 18px;
        right: 9px;
    }
    #addcontactTitle {
        z-index: 1000;
        font-weight: bold;
        padding: 8px;
        font-size: 18px;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
        background: -moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background: -webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background: -o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background: -ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background: linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
        background-color: #f9f9f9;
        width: 100%;
        border-bottom: 1px solid #dddddd;
    }
    #addcontactBody {
        padding: 0px 0px 0px 0px !important;
        overflow-y: scroll;
        height: 350px;
    }
    #addcontactBody ul, #addcontactBody li {
        width:100%;
    }
    #addcontactBody li{
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }
    #addcontactBody li a{
        padding-left: 0;
        color: #000;
        padding-top: 0;
    }
    .addcontact-pic {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        float: left;

    }
    .addcontact-text{
        float: left;
        width: 80%;
        padding-left: 5px;
    }
    .addcontact-text span{
        display: block;
        line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }
    .addcontact-left{
        width:75%;
        float: left;
    }
    .addcontact-left a{
        color: #000;
        width: 100%;
        float: left;
        padding-bottom: 0 !important;
        display: -webkit-flex; /* Safari */
        -webkit-align-items: center; /* Safari 7.0+ */
        display: flex !important;
        align-items: center;
    }
    .addcontact-left a:hover, .addcontact-left a:focus {
        background: none !important;
    }
    .addcontact-right{
        width: 25%;
        float: left;
    }
    .addcontact-right a{
        display: inline-block !important;
        border: 1px solid #000;
        padding: 8px !important;
        border-radius: 100%;
        width: 40px;
        height: 40px;
        text-align: center;
        margin: 5px 2px;
    }
    .addcontact-right a:hover, .addcontact-right a:focus {
        background: none !important;
    }
    .addcontact-right a i{
        color: #000;
        font-size: 20px !important;
    }
    #addcontactFooter {
        background-color: #e9eaed;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        width: 100%;
        margin-top: -20px;
        border-top: 1px solid #dddddd;
    }
    #addcontactFooter a{
        color: #000;
    }
    #addcontactFooter a:hover{
        background:#fff;
    }
</style>
<script>
    
    $(document).ready(function () {
        $("#addcontactBody").click(function (event) { 
             $("#addcontactContainer").show();
            event.stopPropagation();
        
            
        });
        
        $("body").click(function (event) { 
                $("#addcontactContainer").hide(600);
            event.stopPropagation();
        
            
        });

    });


</script>
<script type="text/javascript" >
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#addcontactContainer").hide();
        }
    });

    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#InboxContainer").hide();
        }
    });

    $(document).ready(function ()
    {
        $("#addcontactLink").click(function ()
        {
//$("#notificationLink").hide();

            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $(".dropdown-menu").hide();

            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#dropdown-content_hover").hide();

            $("#InboxContainer").fadeToggle(300);
            $("#Inbox_count").fadeOut("slow");
            return false;
        });

    });

    $(document).ready(function ()
    {
        $(".dropdown_hover").click(function ()
        {
            $("#addcontactContainer").hide();
            // return false;
        });
    });

    $(document).ready(function ()
    {
        $("#addcontactLink").click(function ()
        {
//$("#addcontactLink").hide();

            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            $(".dropdown-menu").hide();
            $("#dropdown-content_hover").hide();



            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $("#addcontactContainer").fadeToggle(300);
            $("#addcontact_count").fadeOut("slow");
            return false;
        });

    });

//Document Click


</script>



<header>
    <div class="bg-search">
        <div class="header2 headerborder animated fadeInDownBig">
            <div class="container">
                <div class="row">

                    <?php echo $business_search; ?>
                    <div class="col-sm-5 col-md-6 col-xs-6 mob-width">
                        <div class="search-mob-block">
                                 <div class="">
                                     <a href="#search">
                                     <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                     </a>
                                 </div>
                                 <div id="search">
                                    <button type="button" class="close">×</button>
                                    <form>
                                        <div class="new-search-input">
                                            <input type="search" value="" placeholder="Find Your Job" />
                                            <input type="search" value="" placeholder="Find Your Location" />
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                             </div>
                        
                        <div class="">
                            <ul class="">
                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_post') { ?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_post'); ?>">Home</a>
                                </li>
                                <!-- Friend Request Start-->

                                <li id="add_contact">
                                    <a class="action-button shadow animate" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                        <span class="hidden-xs">Contact Request &nbsp;</span> 
                                        <i class="fa fa-user" aria-hidden="true"> </i>

                                        <span id="addcontact_count"></span>

                                    </a>
                                    <div id="addcontactContainer">
                                        <div id="addcontactTitle">Contact Request</div>

                                        <div id="addcontactBody" class="notifications">


                                        </div>
                                        <div id="addcontactFooter"><a href="<?php echo base_url('business_profile/contact_list'); ?>">See All</a></div>
                                    </div>
                                </li>         
                                <li>


                                    <div class="dropdown_hover">
                                        <span id="art_profile" >Business Profile <i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <div class="dropdown-content_hover" id="dropdown-content_hover">
                                            <a href="<?php echo base_url('business_profile/business_resume/' . $businessdata[0]['business_slug']); ?>"><i class="fa fa-user" aria-hidden="true"></i> View Profile</a> 
                                            <a href="<?php echo base_url('business_profile/business_information_update'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>

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


    $(document).ready(function () {
        $('.dropdown_hover').click(function (event) {
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

    $(document).ready(function () {
        $("body").click(function (event) {
            $(".dropdown-content_hover").hide();
            event.stopPropagation();
        });

    });
</script>


<script type="text/javascript">

    function deactivate(clicked_id) {
        $('.biderror .mes').html("<div class='pop_content'> Are you sure you want to deactive your business profile?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='deactivate_profile(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }

    function deactivate_profile(clicked_id) {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/deactivate" ?>',
            data: 'id=' + clicked_id,
            success: function (data) {
                window.location = "<?php echo base_url() ?>dashboard";

            }
        });



    }
</script>

<!-- script for update all read notification start-->
<script type="text/javascript">


function Notification_contact(){

    contactperson();
    update_contact_count();

}

    function contactperson() {

        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/contact_notification",
            type: "POST",
            success: function (data) {
               
                $('#addcontactBody').html(data);
               
            }
        });

    }


    function update_contact_count(){


        $.ajax({
                url: "<?php echo base_url(); ?>business_profile/update_contact_count",
                type: "POST",
                success: function (data) {
               
                     //$('#addcontactBody').html(data);
                  
                    
                }
            });


    }
     
     function contactapprove(toid,status) {
      
        $.ajax({
                url: "<?php echo base_url(); ?>business_profile/contact_approve",
                type: "POST",
                data: 'toid=' + toid + '&status=' + status,
                success: function (data) {
               
                     $('#addcontactBody').html(data);
                  
                    
                }
            });

        }

</script>
<!-- script for update all read notification end -->


<!-- all popup close close using esc start -->
 <script type="text/javascript">

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});


 $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( "#dropdown-content_hover" ).hide();
    }
});  
  

 </script>
 <!-- all popup close close using esc end-->

 