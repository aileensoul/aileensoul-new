<!DOCTYPE html>
<html lang="en" ng-app="userOppoApp" ng-controller="userOppoController" scrollable-container>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('8/ninja-slider.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('8/ninja-slider.js');?>" type="text/javascript"></script>

    </head>
    <body>
        <?php echo $header_profile; ?>
    <!--start-->

    <div style="max-width:700px;margin:90px auto;">
        <h2>DEMO: Click Gallery Images to Popup Lightbox</h2>
        <br /><br />
        <div class="gallery">
            <img ng-src="<?php echo base_url() . 'assets/image8/abc.jpg';?>" ng-click="lightbox(0)" style="width:auto; height:140px;" />
            <img ng-src="<?php echo base_url() . 'assets/image8/a_s.jpg';?>" ng-click="lightbox(1)" style="width:auto; height:140px;" /><br />
            <img ng-src="<?php echo base_url() . 'assets/image8/b_s.jpg';?>" ng-click="lightbox(2)" />
            <img ng-src="<?php echo base_url() . 'assets/image8/c_s.jpg';?>" ng-click="lightbox(3)" />
            <img ng-src="<?php echo base_url() . 'assets/image8/d_s.jpg';?>" ng-click="lightbox(4)" />
        </div>
    </div>
    <!--end-->
    <div style="max-width:700px;margin:0 auto;">
        <p>Ninja Slider can be used as a lightbox, the image slideshow in a modal popup window.</p>
        <p>The lightbox will take advantage of all the Ninja Slider's rich features: responsive, touch device friendly, video support, etc.</p>
        <p>
            For detailed instructions please visit <a href="http://www.menucool.com/slider/show-image-gallery-on-modal-popup">show image gallery on modal popup</a>.
        </p>
    </div>
      
      
       
      
       

        <script src="<?php echo base_url('assets/js/jquery.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.form.3.51.js?ver=' . time()) ?>"></script> 
        <script src="<?php echo base_url('assets/dragdrop/js/plugins/sortable.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/fileinput.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/locales/fr.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/locales/es.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/themes/explorer/theme.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/as-videoplayer/build/mediaelement-and-player.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/as-videoplayer/demo.js?ver=' . time()); ?>"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <script src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script src="<?php echo base_url('assets/js/ng-tags-input.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/angular/angular-tooltips.min.js?ver=' . time()); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
        <script>
                                var base_url = '<?php echo base_url(); ?>';
                                var slug = '<?php echo $slugid; ?>';
                                var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                var title = '<?php echo $title; ?>';
                                var no_user_post_html = '<?php echo $no_user_post_html; ?>';
                                var header_all_profile = '<?php echo $header_all_profile; ?>';
                                var app = angular.module('userOppoApp', ['ui.bootstrap', 'ngTagsInput', 'ngSanitize']);
        </script>               
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
   <script>
        app.controller('userOppoController', function ($scope, $http) {
            
            $scope.lightbox = function (idx) {
                 //show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
            var ninjaSldr = document.getElementById("ninja-slider");
            ninjaSldr.parentNode.style.display = "block";

            nslider.init(idx);

            var fsBtn = document.getElementById("fsBtn");
            fsBtn.click();
        alert("hiiii");
    };
    
    function fsIconClick(isFullscreen, ninjaSldr) { //fsIconClick is the default event handler of the fullscreen button
            if (isFullscreen) {
                ninjaSldr.parentNode.style.display = "none";
            }
        }

    });
   </script>
    </body>
</html>