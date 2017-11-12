<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
           
    </head>
    <body class="page-container-bg-solid page-boxed gov-all-post">
    <?php echo $header; ?>
     <?php echo $job_header2_border;?>   
     

	<div class="user-midd-section" id="paddingtop_fixed">
		<div class="container padding-360">
			<div class="gov-job-detail-left">
			<div class="gov-job-saved-box">
				<h3>All Government Jobs</h3>
				<div class="contact-frnd-post">
					<ul class="all-job-cat">
						<li>
							<a href="#">
								<div class="all-job-box">
									<div class="job-box-left">
										<img src="<?php echo base_url('assets/img/bank.png'); ?>">
									</div>
									<div class="all-job-right">
										<span class="job-name">Bank Job</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="all-job-box">
									<div class="job-box-left">
										<img src="<?php echo base_url('assets/img/train.png'); ?>">
									</div>
									<div class="all-job-right">
										<span class="job-name">Railway Job</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="all-job-box">
									<div class="job-box-left">
										<img src="<?php echo base_url('assets/img/cs.png'); ?>">
									</div>
									<div class="all-job-right">
										<span class="job-name">Civil Jobs</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="all-job-box">
									<div class="job-box-left">
										<img src="<?php echo base_url('assets/img/gj.png'); ?>">
									</div>
									<div class="all-job-right">
										<span class="job-name">UPAC Job</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="all-job-box">
									<div class="job-box-left">
										<img src="<?php echo base_url('assets/img/agj.png'); ?>">
									</div>
									<div class="all-job-right">
										<span class="job-name">Sub Inspector Job</span>
									</div>
								</div>
							</a>
						</li>
						
					</ul>
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
						
						<div class="fw pt10 text-right">
									<a href="https://www.chitika.com/publishers/apply?refid=aileensoul"><img src="https://images.chitika.net/ref_banners/300x250_hidden_ad.png" /></a>
								</div>
                </div>
				<div class="tablate-add">

                            <script type="text/javascript">
						  ( function() {
							if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
							var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":160,"height":600,"sid":"Chitika Default"};
							var placement_id = window.CHITIKA.units.length;
							window.CHITIKA.units.push(unit);
							document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
						}());
						</script>
						<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                        </div>
		</div>
		
	</div>

  <?php echo $footer;  ?>
  
  <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()) ?>"></script>

<script>
 var base_url = '<?php echo base_url(); ?>';
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/search.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/information.js?ver='.time()); ?>"></script>
</body>
</html>