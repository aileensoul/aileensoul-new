<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->

<?php echo $job_header2; ?>
<body class="page-container-bg-solid page-boxed">
	<section>
		<div class="user-midd-section" id="paddingtop_fixed">
			<div class="container">
				<div class="row">
                <div class="resume-download-menu">    
                  <ul>
                      <li><a href="job_savedownload"><i class="fa fa-share-alt" aria-hidden="true"></i> Save As </a></li>
                      <li><a href="job_download"><i class="fa fa-download" aria-hidden="true"></i> Download</a></li>
                  </ul>


                </div>
         <div class="resume-side-top-cont col-md-12  col-sm-12 col-xs-12">
          </div>

                          <div class="resume-side-left-cont col-md-4 col-sm-4 col-xs-4">
                                                                         <div class="resume-image col-md-12 col-sm-12 col-xs-12">
                                            <img src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" alt="" >
                                        </div>
      <div class="resume-inside-content">
                                          
                                              <h6>PERSONAL INFO</h6>
                                                <div class="left-resume-input"> <p>NAME</p>
                                                  <p>BIRTHDAY</p>
                                                  <p>MARITAL STATUS</p>
                                                  <p>NATIONALITY</p>
                                                  <p> GENDER</p>
                                                  <p>LANGUAUES</p>
                                               </div>
                                                  <div >
                                                   <p><?php echo $job[0]['fname']  .' '. $job[0]['lname']; ?></p>

                                                  <p><?php echo date('d-M-Y',strtotime($job[0]['dob'])); ?></p>

                                                  <p><?php echo $job[0]['marital_status'];?></p>

                                                  <p> <?php $cache_time  =  $this->db->get_where('nation',array('nation_id' => $job[0]['nationality']))->row()->nation_name;  
                                                         echo $cache_time; ?></p>

                                                  <p><?php echo $job[0]['gender'];?></p>

                                                  <p>  <?php
                                                        
                                                        $aud=$job[0]['language'];

                                                        $aud_res=explode(',',$aud);
                                                        foreach ($aud_res as $lan)
                                                        {
                                                
                                                            $cache_time  =  $this->db->get_where('language',array('language_id' => $lan))->row()->language_name;  
                                                            $language1[]= $cache_time;
                                                   
                                                        }
                                                        $listFinal = implode(', ',$language1);
                                                        echo $listFinal; 
                                                       
                                                        ?>     </p>
                                                   </div>
                        
                                        </div>
                                               <div class="resume-inside-content">
                                          
                                              <h6>CONTACT INFO</h6>
                                                <div class="left-resume-input">   <p>MOBILE</p>
                                    <p>EMAIL</p>
                                    <p >ADDRESS </p>
                                               
                                               </div>
                                                  <div> <p><?php echo $job[0]['phnno'];?></p>
                                                  <p><?php echo $job[0]['email'];?> </p>
                                                  <p><?php echo $job[0]['address'];?></p>
                                                
                                                   </div>
                           <div class="resume-inside">
                              <H6 >CARRIER OBJECTIVES</H6>
                             <p ><?php echo $job[0]['carrier'];?></p>
                             </div>
                                     <div class="resume-inside">

                        <?php 
                                if($job[0]['reference'])
                                 {
                        ?>              
                        <H5>REFERENCE</H5>
                        <p ><?php echo $job[0]['reference'];?></p>
                         <?php
                                         }
                          ?>           
                            </div>
                                        </div>
                           </div>
           
               <div class="resume-top-con-head" >
             <h1> <?php echo $job[0]['fname']  .' '. $job[0]['lname']; ?></h1>
          <!--    <h3>Web Designer </h3> -->
             </div>
            <div class="resume-side-mid-cont col-md-4 col-sm-4 col-xs-4">
             <div class="resume-mide-con"> <h5 >WORK EXPERIENCE</h5>

             <?php foreach($job_work as $work){ ?>
            <div class="resume-sqaure"><p>2011</p></div> 
             <div class="resume-mid-con">
                              
                <div class="resume-inside-content">
     
                       <p >PHP DEVELOPERE</p>
<p >SEVEN DIGITAL TECHNOLOGY</p>
<p >sevendigital.tech@gmail.com</p>
<p >7845120124</p>
                            </div>
            </div> 

            <?php } ?>

            
            </div>
              <div> <H6 >EDUCATIONAL QUALIFICATION</H6>

 <?php foreach($job_edu as $job1){ ?>
             <div class="resume-sqaure"><p>2011</p></div>  <div class="resume-mid-con">
                           
                <div class="resume-inside-content">
     <p >M.TECH</p>
<p >Gujrat university Technology</p>
<p >CGPA : .8.00</p>
<p >Grade : A</p>
                            </div>
            </div> 
     <?php } ?>
            
            </div>
          </div>
      
            
            
            
            <div class="resume-side-right-cont  col-md-4 col-sm-4 col-xs-4">
                     <div class="resume-inside-content">
                      <H6 >INREEST</H6>
                        <p >WEB DESIGNER</p>
                                    <p >PLAYING AMES</p>
                            </div>
                               <div class="resume-inside-content">
                      <H6 >EXTRA ACTIVITES</H6>
                        <p >HARDWARE <progress max="100" value="80" class="progressbar"></progress></p>
                                    <p >MARKETING <progress max="100" value="80" class="progressbar"></progress></p>
                            </div>
                               <div class="resume-inside-content">
                  <H6>PROFESSIONAL SKILLS</H6>
                        <p >WEBDESIGNER<progress max="100" value="80" class="progressbar"></progress></p>
                                    <p >WEB TESTER <progress max="100" value="80" class="progressbar"></progress></p>
                  <p >.NET<progress max="100" value="80" class="progressbar"></progress></p>  
                                    <p >PHP<progress max="100" value="80" class="progressbar"></progress></p>
                            </div>

          </div>
         <div class="resume-declartion">
           <h6>Declartion</h6>
                        <p >WEBDESIGNER</p></div>
          <div class="resume-side-bottom-cont col-md-12">
      <div class="logo-footer"><a href=""><img src="<?php echo base_url() ?>images/logo-white.png"></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>

	
</body>
</html>

<!-- script for skill textbox automatic start-->

<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- script for skill textbox automatic end -->

<script>

var data= <?php echo json_encode($demo); ?>;


        
$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>

<script>
//select2 autocomplete start for skill
$('#searchskills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>freelancer/keyskill",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
             

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>freelancer/location",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
            
              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location

</script>
<!-- for search validation -->
<script type="text/javascript">
function checkvalue(){
   // alert("hi");
  var searchkeyword=document.getElementById('tags').value;
  var searchplace=document.getElementById('searchplace').value;
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
   //  alert('Please enter Keyword');
    return false;
  }
}
</script>
 <!-- end search validation -->
