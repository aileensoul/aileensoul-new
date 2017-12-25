
<?php echo $head; ?>

 <?php
        if (IS_JOB_CSS_MINIFY == '0') {
            ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/gyc.css'); ?>">

<?php }else{?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/gyc.css'); ?>">

<?php }?>
<?php echo $header; ?>


<body   class="page-container-bg-solid page-boxed">
    <img src="<?php echo base_url() ?>assets/images/404.jpg" alt="404" />
</body>

</html>
