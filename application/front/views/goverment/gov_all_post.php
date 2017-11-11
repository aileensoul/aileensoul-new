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
     <?php echo $footer;  ?>

	<div class="user-midd-section" id="paddingtop_fixed">
		<div class="container padding-360">
			<div class="job-saved-box">
				<h3>All Government Job</h3>
				<div class="contact-frnd-post text-center">
					<ul class="all-job-cat">
						<li>
							<div class="all-job-box">
								<div class="job-box-left">
									<img src="<?php echo base_url('assets/img/bank.png'); ?>">
								</div>
								<div class="all-job-right">
									<span class="job-name">Bank Job</span>
								</div>
							</div>
						</li>
						<li>
							<div class="all-job-box">
								2
							</div>
						</li>
						<li>
							<div class="all-job-box">
								3
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>

  
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