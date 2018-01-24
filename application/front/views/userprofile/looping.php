<html>
    
       <link rel="stylesheet" href="<?php echo base_url('assets/n-css/owl.carousel.min.css') ?>">
    <head>  
        <style>
 BODY {
  background-color: white;
}
</style>
    </head>
    <body>

<div class="owl-carousel owl-theme">
  <?php for($i = 0; $i < 6; $i = i+1) { ?>
  <div class="item">
   <?php echo $i; ?>
  </div>
  <?php } ?>
  <div class="item">
   22
  </div>
  <div class="item">
   33
  </div>
  <div class="item">
   44
  </div>
  <div class="item">
    55
  </div>
</div>

<div id="debug"></div>

</div>
</body>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script>
var carousel = $('.owl-carousel').owlCarousel({
  items: 1,
  margin: 10,
  nav: true,
  dots: false,
  loop: true,
	navSpeed: 1500,
  onChanged: function(event) {
  	
    $('#debug').html((event.item.index - (event.relatedTarget._clones.length / 2)) + '/' + event.item.count);
    
  },  
});
</script>