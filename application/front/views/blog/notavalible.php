
<?php echo $head; ?>
 <?php if (IS_OUTSIDE_CSS_MINIFY == '0'){?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/gyc.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<?php }else{?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/gyc.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css_min/bootstrap.min.css" />
<?php }?>

<?php echo $header; ?>
<body   class="page-container-bg-solid page-boxed">
    <img src="<?php echo base_url() ?>images/404.jpg" alt="404" />
</body>

</html>
