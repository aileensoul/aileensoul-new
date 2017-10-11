<html>
<head> 
<title><?php echo $title; ?></title> 
<?php echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/timeline.css?ver='.time()); ?>">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profiles/artistic/artistic.css?ver='.time()); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profiles/common/mobile.css?ver='.time()) ;?>" />
</head>
<body   class="page-container-bg-solid page-boxed">
<?php echo $header; ?>
<?php echo $art_header2_border; ?>
   <section class="custom-row">
    <?php echo $artistic_common; ?>
<div class="container tablate-container art-profile">    
      <div class="profile-photo"> 
      <div class=" " >
         <div class="user-midd-section grybod" >
            <div  class="col-sm-12 border_tag padding_low_data padding_les" >
               <div class="padding_less main_art" >
                  <div class="top-tab">
                     <ul class="nav nav-tabs tabs-left remove_tab">
                        <li class="active"> <a href="<?php echo base_url('artistic/photos/' . $artisticdata[0]['slug']) ?>"><i class="fa fa-camera" aria-hidden="true"></i>   Photos</a></li>
                        <li> <a href="<?php echo base_url('artistic/videos/' . $artisticdata[0]['slug']) ?>"><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</a></li>
                        <li><a href="<?php echo base_url('artistic/audios/' . $artisticdata[0]['slug']) ?>" ><i class="fa fa-music" aria-hidden="true"></i>  Audio</a></li>
                        <li><a href="<?php echo base_url('artistic/pdf/' . $artisticdata[0]['slug']) ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Pdf</a></li>
                     </ul>
                  </div>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active" id="home">
                        <div class="common-form">
                           <div class="">
                              <div class="all-box">
                                 <ul>
                                    <?php
                                       $i = 1;
                                       
                                       $allowed = array('gif', 'png', 'jpg');
                                       foreach ($artistic_data as $mke => $mval) {
                                       
                                           $ext = pathinfo($mval['file_name'], PATHINFO_EXTENSION);
                                       
                                           if (in_array($ext, $allowed)) {
                                               $databus[] = $mval;
                                           }
                                       }
                                       
                                       if ($databus) {
                                           ?>
                                    <div class="pictures">
                                       <?php foreach ($databus as $data) {
                                          ?>
                                       <li>
                                          <div class="pht_ph_dash"> 

                                           <!-- <img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $data['file_name']) ?>" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor"/> -->

                                            <img src = "<?php echo ART_POST_MAIN_UPLOAD_URL . $data['file_name']; ?>" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor">
                                          </div>
                                       </li>
                                       <?php
                                          $i++;
                                          }
                                          ?>x
                                    </div>
                                    <?php } else { ?>
                                  <div class="art_no_pva_avl">
         <div class="art_no_post_img">
          <img src="<?php echo base_url('assets/images/020-c.png'); ?>"  >
         </div>
         <div class="art_no_post_text1">
           No Photos Available.
         </div>
       </div>
                                    <?php }
                                       ?>
                                 </ul>
                              </div>
                              <div class="module_art_phtos">
                                 <!-- khyati changes start -->
                                 <!-- khyati changes end -->
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>



     <div id="myModal1" class="modal2">
                                    <div class="modal-content2">
                                       <span class="close2 cursor" onclick="closeModal()">&times;</span>
                                       <!-- khyati chnages start-->
                                       <?php
                                          $i = 1;
                                          
                                          $allowed = array('gif', 'png', 'jpg');
                                          foreach ($artistic_data as $mke => $mval) {
                                          
                                              $ext = pathinfo($mval['file_name'], PATHINFO_EXTENSION);
                                          
                                              if (in_array($ext, $allowed)) {
                                                  $databus1[] = $mval;
                                              }
                                          }
                                          
                                          foreach ($databus1 as $artdata) {
                                              ?>
                                       <div class="mySlides">
                                          <div class="numbertext"><?php echo $i ?> / <?php echo count($databus1) ?></div>
                                          <div class="slider_img_p">

                                             <img src = "<?php echo ART_POST_MAIN_UPLOAD_URL . $artdata['file_name']; ?>">

                                             <!-- <img src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artdata['file_name']) ?>"> -->
                                          </div>
                                          <div class="likeduserlistimg<?php echo $artdata['post_files_id']; ?>">
                                            
                                          </div>
                                         
                                          <div class="<?php echo "likeusernameimg" . $artdata['post_files_id']; ?>" id="<?php echo "likeusernameimg" . $artdata['post_files_id']; ?>" style="display:none">
                                             <?php
                                                $contition_array = array('post_image_id' => $artdata['post_files_id'], 'is_unlike' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = 'post_image_like_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                // echo '<pre>'; print_r($commnetcount);
                                                foreach ($commnetcount as $comment) {
                                                    $art_fname1 = $this->db->select('art_name')->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
                                                    $art_lname1 = $this->db->select('art_lastname')->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_lastname;
                                                    ?>
                                             <?php } ?>
                                             <!-- pop up box end-->
                                             <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $artdata['post_files_id']; ?>);">
                                                <?php
                                                   $contition_array = array('post_image_id' => $artdata['post_files_id'], 'is_unlike' => '0');
                                                   $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   
                                                   
                                                   $art_fname = $this->db->select('art_name')->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_name;
                                                   $art_lname = $this->db->select('art_lastname')->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_lastname;
                                                   ?>
                                                <div class="like_one_other">
                                                   <?php
                                                      echo ucfirst(strtolower($art_fname));
                                                      echo "&nbsp;";
                                                      echo ucfirst(strtolower($art_lname));
                                                      echo "&nbsp;";
                                                      ?>
                                                   <?php
                                                      if (count($commnetcount) > 1) {
                                                          echo "and ";
                                                          echo '' . count($commnetcount) - 1 . '';
                                                          echo "&nbsp;";
                                                          echo "others";
                                                      }
                                                      ?>
                                                </div>
                                             </a>
                                          </div>
                                          
                                       </div>
                                       <?php
                                          $i++;
                                          }
                                          ?>
                                       <!-- khyati chnages end-->
                                       <a class="prev" style="left:0px;" onclick="plusSlides(-1)">&#10094;</a>
                                       <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    </div>
                                    <div class="caption-container">
                                       <p id="caption"></p>
                                    </div>
                                    <div>
                                    </div>
                                 </div>   
   </section>
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                             <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                               <div class="col-md-5">

                                <div class="user_profile"></div>

                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one">
                                    </div>
                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="width:350px; display: none"></div>
                                    </div>
                                <input type="submit"  class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                                </form>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
<!-- Model Popup Close -->
<!-- Bid-modal  -->
<div class="modal fade message-box biderror" id="bidmodal" role="dialog">
   <div class="modal-dialog modal-lm">
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
<!-- Model Popup Close -->
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="likeusermodal" role="dialog">
   <div class="modal-dialog modal-lm">
      <div class="modal-content">
         <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
         <div class="modal-body">
            <span class="mes">
            </span>
         </div>
      </div>
   </div>
</div>
<!-- Model Popup Close -->
<footer>
<?php echo $footer; ?>
        </footer>    
<script src="<?php echo base_url('assets/js/croppie.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()); ?>"></script>
<script>
var base_url = '<?php echo base_url(); ?>';   
   var data = <?php echo json_encode($demo); ?>;
   var data1 = <?php echo json_encode($de); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/photos.js?ver='.time()); ?>"></script>
</body>
</html>
