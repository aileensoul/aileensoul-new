<!DOCTYPE html>
<html>

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Dynamic Page | About</title>
	
	
	
	<!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	 <link rel="stylesheet" href="<?php echo base_url() ?>dynamic/css/style.css" />
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
 
         <script type="text/javascript" src="<?php echo base_url('dynamic/js/jquery.ba-hashchange.min.js'); ?>"></script>
         <script type="text/javascript" src="<?php echo base_url('dynamic/js/dynamicpage.js'); ?>"></script>
    
</head>

<body>

    <?php include('../header.php'); ?>

	<div id="page-wrap">

        <header>
		  <h1>Dynamic Site</h1>
		
		  <nav>
		      <ul class="group">
		          <ul class="group">
		          <li><a href="dynamic">Home</a></li>
		          <li><a href="about_dynamic">About</a></li>
		          <li><a href="contact_dynamic">Contact</a></li>
		      </ul>
		      </ul>
		  </nav>
		</header>
		
		<section id="main-content">
		<div id="guts">
		
		  <h2>About</h2>
		
		  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p> 
		
		</div>
		</section>
		
		<footer>
		  &copy;2010 CSS-Tricks
		</footer>
			
	</div>
	
	<?php include('../footer.php'); ?>

</body>

</html>