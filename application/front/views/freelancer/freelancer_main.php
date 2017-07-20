<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
        <?php echo $head; ?>  
</head>
<body class="pushmenu-push">
<?php echo $header; ?>
<section>
	<div class="col-md-12  user-section-free-up">
	</div>
	<div class="midd-section freelancer-midd text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<h2 class="font-white">I want to hire Freelancer</h2>
						<a href="<?php echo base_url('freelancer_hire/freelancer_hire'); ?>" class="button">Hire</a>
					</div>
					<div class="col-md-6 col-sm-6">
						<h2 class="font-white">Apply as Freelancer</h2>
						<a href="<?php echo base_url('freelancer/freelancer_post'); ?>" class="button">Apply</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
					</div>
					<div class="col-md-6 col-sm-6">
					</div>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>