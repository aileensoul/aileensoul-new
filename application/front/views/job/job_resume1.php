<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->

<body class="page-container-bg-solid page-boxed">
	<section>
		<div class="user-midd-section">
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
                                          
                                              <h5>PERSONAL INFO</h5>
                                                <div class="left-resume-input"> <p>NAME</p>
                                                  <p>BIRTHDAY</p>
                                                  <p>MARITAL STATUS</p>
                                                  <p>NATIONALITY</p>
                                                  <p>GENDER</p>
                                                  <p>LANGUAUES</p>
                                               </div>
                                                  <div > <p> <?php echo $userdata[0]['first_name']  .' '. $userdata[0]['last_name']; ?></p>

                                                  <p><?php echo $job[0]['dob'];?></p>

                                                  <p><?php echo $job[0]['marital_status'];?></p>

                                                  <p><?php $cache_time  =  $this->db->get_where('nation',array('nation_id' => $job[0]['nationality']))->row()->nation_name;  
                                                         echo $cache_time; ?></p>

                                                  <p><?php echo $job[0]['gender'];?></p>
                                                  <p> <?php $cache_time  =  $this->db->get_where('language',array('language_id' => $job[0]['language']))->row()->language_name;  
                                                         echo $cache_time; ?></p>
                                                   </div>
                        
                                        </div>
                                               <div class="resume-inside-content">
                                          
                                              <h5>CONTACT INFO</h5>
                                                <div class="left-resume-input">   <p>MOBILE</p>
                                    <p>EMAIL</p>
                                    <p >ADDRESS </p>
                                               
                                               </div>
                                                  <div> <p><?php echo $job[0]['phnno'];?></p>
                                                  <p><?php echo $job[0]['email'];?></p>
                                                  <p><?php echo $job[0]['address'];?></p>
                                                
                                                   </div>
                           <div class="resume-inside">
                              <H5 >CARRIER OBJECTIVES</H5>
                             <p ><?php echo $job[0]['carrier'];?></p>
                             </div>
                                     <div class="resume-inside">
                        <H5>REFERENCE</H5>
                        <p ><?php echo $job[0]['reference'];?></p>
                                    
                            </div>
                                        </div>
                           </div>
           
               <div class="resume-top-con-head" >
             <h1> <?php echo $userdata[0]['first_name']  .' '. $userdata[0]['last_name']; ?> </h1>
            <!--  <h3>Web Designer </h3> -->
             </div>
            <div class="resume-side-mid-cont col-md-4 col-sm-4 col-xs-4">
            <?php
                      if ($job[0]['experience'] == "Experience")
                      {
            ?>           
                                                        
             <div class="resume-mide-con"> <h5 >WORK EXPERIENCE</h5>
            <div class="resume-sqaure"><!-- <p>2011</p> --></div>  <div class="resume-mid-con">
                              
                <div class="resume-inside-content">
      
                       <p><?php echo $job[0]['jobtitle'];?></p>
                        <p ><?php echo $job[0]['companyname'];?></p>
                        <p ><?php echo $job[0]['companyemail'];?></p>
                        <p ><?php echo $job[0]['companyphn'];?></p>
                            </div>
            </div> 
            <!--<div class="resume-sqaure"><p>2011</p></div> 
           <div class="resume-mid-con">
                              
                <div class="resume-inside-content">
     
                       <p >PHP DEVELOPERE</p>
<p >SEVEN DIGITAL TECHNOLOGY</p>
<p >sevendigital.tech@gmail.com</p>
<p >7845120124</p>
                            </div>
            </div> -->
            
            </div>
            <?php 
             }
            ?>
              <div> <H5 >EDUCATIONAL QUALIFICATION</H5>
             <div class="resume-sqaure"><p>2011</p></div>  <div class="resume-mid-con">
                           
                <div class="resume-inside-content">
     <p > <?php $cache_time  =  $this->db->get_where('degree',array('degree_id' => $job[0]['degree']))->row()->degree_name;  
        echo $cache_time; ?></p>
<p ><?php $cache_time  =  $this->db->get_where('university',array('university_id' => $job[0]['university']))->row()->university_name;  
                                                        echo $cache_time; ?></p>
<p ><?php echo $job[0]['percentage'];?></p>
<p ><?php echo $job[0]['grade'];?></p>
                            </div>
            </div>

 <!--  <div class="resume-sqaure"><p>2011</p></div> 
            <div class="resume-mid-con">
                              
                <div class="resume-inside-content">
     <p >M.TECH</p>
<p >Gujrat university Technology</p>
<p >CGPA : .8.00</p>
<p >Grade : A</p>
                            </div>
            </div> -->
            
            </div>
          </div>
			
            
            
            
            <div class="resume-side-right-cont  col-md-4 col-sm-4 col-xs-4">
                     <div class="resume-inside-content">
                      <H5 >INTEREST</H5>
                        <p ><?php echo $job[0]['interest'];?></p>
                                  <!--   <p >PLAYING AMES</p> -->
                            </div>
                               <div class="resume-inside-content">
                      <H5 >EXTRA ACTIVITES</H5>
                        <p ><?php echo $job[0]['curricular'];?><!-- <progress max="100" value="80" class="progressbar"></progress> --></p>
                                   <!--  <p >MARKETING <progress max="100" value="80" class="progressbar"></progress></p> -->
                            </div>
                               <div class="resume-inside-content">
                  <H5>PROFESSIONAL SKILLS</H5>
                        <p ><?php
                                                        
                                 $aud=$job[0]['keyskill'];
                                 $aud_res=explode(',',$aud);
                                 foreach ($aud_res as $skill)
                                  {
                                                
                                    $cache_time  =  $this->db->get_where('skill',array('skill_id' => $skill))->row()->skill;  
                                    $skill1[]= $cache_time;
                                                   
                                  }
                                      $listFinal = implode(', ',$skill1);
                                      echo $listFinal; 
                                                        
                                                       
                                  ?>     <!-- <progress max="100" value="80" class="progressbar"></progress> --></p>
                                   <!--  <p >WEB TESTER <progress max="100" value="80" class="progressbar"></progress></p>
                  <p >.NET<progress max="100" value="80" class="progressbar"></progress></p>  
                                    <p >PHP<progress max="100" value="80" class="progressbar"></progress></p> -->
                            </div>

          </div>
         <div class="resume-declartion">
           <h5>Declartion:</h5>
                        <p > I here by Declare that all the above Information are true and correct to best of my knowledge</p></div>
          <div class="resume-side-bottom-cont col-md-12">
      <div class="logo-footer"><a href=""><img src="images/logo-white.png"></a></div>
          </div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		  <?php echo $footer;  ?>
	</footer>
	
</body>
</html>