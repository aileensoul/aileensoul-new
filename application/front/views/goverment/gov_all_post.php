<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
           
    </head>
    <body class="page-container-bg-solid page-boxed">
    <?php echo $header; ?>
     <?php echo $job_header2_border;?>   
     <?php echo $footer;  ?>

	<div class="user-midd-section" id="paddingtop_fixed">
		<div class="container padding-360">
			<div class="job-saved-box">
				<h3>All Government Job</h3>
			</div>
				<div class="gov-job-title">
					<table>
						<tr>
							<td><img src="<?php echo base_url('assets/img/bank-job.gif'); ?>"></td>
							<td class="pl10">
								<h3>Opening in Sbi life insurance</h3>
								<p class="job-field"><b>Last Date:</b> 15/5/2018</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="gov-job-field">
					<ul>
						<li><p class="job-field"><b>Post Name:</b> Manager</p></li>
						<li class="text-right"><p class="job-field"><b>Job Location:</b> All Over India</p></li>
						<li><p class="job-field"><b>No. of Vacancies:</b> Not Specified</p></li>
						<li class="text-right"><p class="job-field"><b>Required Exp :</b> Not Specified</p></li>
						<li><p class="job-field"><b>Pay Scale :</b> Rs. 35,400-1,12,400</p></li>
						
					</ul>
				</div>
				<div class="gov-job-detail">
					<p><b>Job Discription :</b></p>
					<ul>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
					</ul>
					<p><b>Eligibility Criteria  :</b></p>
					<ul>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
						<li>Achievement of New Business Premium targets </li>
					</ul>
					<p><b>Company Profile:</b></p>
					<p>SBI Life Insurance Co. Ltd
SBI Life Insurance Company Limited is a joint venture between the State Bank of India and BNP Paribas Assurance. SBI Life Insurance is registered with an authorized capital of Rs 2000 crores and a Paid-up capital of Rs 1000 Crores. SBI owns 74% of the total capital and BNP Paribas Assurance the remaining 26%. </p>
					<p>State Bank of India enjoys the largest banking franchise in India. Along with its 6 Associate Banks, SBI Group has the unrivalled strength of over 16,000 branches across the country, arguably the largest in the world. </p>
					<p>State Bank of India enjoys the largest banking franchise in India. Along with its 6 Associate Banks, SBI Group has the unrivalled strength of over 16,000 branches across the country, arguably the largest in the world. </p>
				</div>
			</div>
			
				<div class="gov-job-right-title">
					<h3>Government job<a href="#" class="pull-right">All Job</a></h3>
				</div>
				<div class="gov-job-list">
					<marquee direction="up" scrollamount="3" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);">
						<ul>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
							<li><a href="#">Bank Job</a></li>
							<li><a href="#">ONGC Job</a></li>
							<li><a href="#">Railways Job</a></li>
						</ul>
					</marquee>
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