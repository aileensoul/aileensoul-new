<html>
<head>
<title><?php echo $title; ?></title>
<?php echo $head; ?>

<link href="<?php echo base_url('assets/css/fileinput.css?ver='.time());?>" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/js/themes/explorer/theme.css?ver='.time()); ?>" media="all" rel="stylesheet" type="text/css"/>
</head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/artistic.css?ver='.time()); ?>">
   
<body>
<?php echo $header; ?>
 <?php echo $art_header2_border; ?>
<div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
   <div class="container art_container padding-360">
      <div class="">
      <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt" >
			<div class="left_fixed"> 

                     <?php echo $left_artistic; ?> 
            </div>
			<div class="tablate-potrat-add">
								<div class="fw text-center pt10">
									<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
									<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
								</div>
							</div>
         </div>
       <div class=" custom-right-art mian_middle_post_box animated fadeInUp">
         
    <div class="right_side_posrt fl"> 
               <div class="job-saved-box">
                  <h3 style="background-color: #fff; text-align: center; color: #003; border-bottom: 1px solid #d9d9d9;">
                     Search result of 
                    <?php  if($keyword != "" && $keyword1 == ""){echo '"' .  $keyword . '"';}
                                  elseif ($keyword == "" && $keyword1 != "") {
                                    echo '"' .  $keyword1 . '"';
                                  }
                                  else
                                  {
                                     echo '"' .  $keyword . '"'; echo  " in "; echo '"' .  $keyword1 . '"';
                                  }
              ?>                               
                  </h3>
                  <!--        <div class="contact-frnd-post"> -->
                  <div class="job-contact-frnd art-search-extra pt10">
				  	<div class="mob-add">
								<div class="fw text-center pt10 pb10">
									<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
									<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
								</div>
							</div>

                 <!-- AJAX DATA... -->
                 <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver='.time()) ?>" /></div>
                    
                  </div>
               </div>
            </div>
         </div>
      
		<div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 
					
							<div class="fw text-center">
								<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
								<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
							</div>
							<div class="fw pt20" style="text-align:center;">
								<a target="_blank"  href="https://www.amazon.in/gp/product/B00KJGYB8M/ref=as_li_tl?ie=UTF8&camp=3638&creative=24630&creativeASIN=B00KJGYB8M&linkCode=as2&tag=aileensoul-21&linkId=dc5e1b2815cc8b94d7f3d631af3cf96e"><img border="0" src="//ws-in.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=IN&ASIN=B00KJGYB8M&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=aileensoul-21" ></a><img src="//ir-in.amazon-adsystem.com/e/ir?t=aileensoul-21&l=am2&o=31&a=B00KJGYB8M" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
							</div>
						</div>
						
						<div class="tablate-add">
					
					<script type="text/javascript" language="javascript">
					  var aax_size='160x600';
					  var aax_pubname = 'aileensoul-21';
					  var aax_src='302';
					</script>
					<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
				</div>
	  </div>
   </div>
</div>

      <!-- bid model start -->

      <div class="modal fade message-box" id="postedit" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="postedit" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
      <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                        <div class="modal-dialog modal-lm">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                                <div class="modal-body">
                                   
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
      </div>

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

<footer>
<?php echo $footer; ?>
        </footer>



<script async src="<?php echo base_url('assets/js/plugins/sortable.js?ver='.time()); ?>" type="text/javascript"></script>
<script async src="<?php echo base_url('assets/js/themes/explorer/theme.js?ver='.time()); ?>" type="text/javascript"></script>
<script async src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>

 <script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';      
var data = <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
var keyword = '<?php echo $keyword; ?>';
var keyword1 = '<?php echo $keyword1; ?>';
</script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/recommen_candidate.js?ver='.time()); ?>"></script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>
</body>
</html>