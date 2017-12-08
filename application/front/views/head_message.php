<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta charset="utf-8" />
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6060111582812113",
    enable_page_level_ads: true
  });
</script>
<!-- SEO CHANGES START -->
<?php
if ($_SERVER['HTTP_HOST'] != "localhost") {
    ?>
    <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />
    <meta name="msvalidate.01" content="41CAD663DA32C530223EE3B5338EC79E" />
    <!-- Add following GoogleAnalytics tracking code in Header.-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-91486853-1', 'auto');
        ga('send', 'pageview');
    </script>
    <?php
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, 
      minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- SEO CHANGES END -->
<!-- NEED TO ADD FOLLOWING TAG IN HEADER -->
<link rel="canonical" href="http://www.aileensoul.com" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="description" content=" " />
<meta name="keywords" content=" " />
<!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
<!--<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6060111582812113",
        enable_page_level_ads: true
    });
</script>-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="icon" href="<?php echo base_url('assets/images/favicon.png?ver=' . time()); ?>">
<?php
if(IS_CSS_MINIFY == '0'){
?>
<!-- CSS START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/common-style.css?ver=' . time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/media.css?ver=' . time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css?ver=' . time()) ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css?ver=' . time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?ver=' . time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css?ver=' . time()); ?>">
<!--SCRIPT USE FOR NOTIFICATION SCROLLBAR-->
<link rel="stylesheet" href="<?php echo base_url('assets/js/scrollbar/style.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/scrollbar/jquery.mCustomScrollbar.css') ?>">
<!--SCRIPT USE FOR NOTIFICATION SCROLLBAR-->
<?php
}else{ ?>
<link rel="stylesheet"  type="text/css" href="<?php echo base_url('assets/css_min/common-header.min.css?ver=' . time()); ?>">    
<?php }
?>

<?php
if ($this->uri->segment(1) == 'dashboard') {
    ?>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" async></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.0.3.min.js?ver=' . time()); ?>"></script> 
    <?php
} else {
    ?>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.0.3.min.js?ver=' . time()); ?>"></script> 
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" async></script>-->
    <!--<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js?ver=' . time()); ?>" ></script>-->
<?php }
?>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" crossorigin="anonymous" async></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min-1.12.1.js?ver=' . time()); ?>"></script>-->  
<!--<script src="<?php // echo base_url('assets/js/fb_login.js?ver='.time());    ?>"></script>-->

<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>"></script>