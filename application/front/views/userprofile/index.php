<!DOCTYPE html>
<html lang="en" ng-app="userProfileApp" ng-controller="userProfileController">
<!--<html lang="en" ng-app="userProfileApp">-->
<head>
       <base href="/aileensoul-new/" >
	<title ng-bind="title"></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/animate.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/owl.carousel.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css')?>">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css')?>">
        
<body class="main-db">
	<?php echo $header; ?>
     <div ng-view></div>
	<?php echo $footer; ?>
		
	
	<div style="display:none;" class="modal fade" id="post-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					
                        <div class="modal-dialog">
                            <div class="modal-content">
								<button type="button" class="modal-close" data-dismiss="modal">×</button>
								<div class="post-popup-box">
									<div class="post-box">
										<div class="post-img">
											<img src="<?php echo base_url('assets/n-images/user-pic.jpg')?>">
										</div>
										<div class="post-text">
											<textarea class="title-text-area" placeholder="Post Opportunity"></textarea>
										</div>
										<div class="all-upload">
											<label for="file-1">
												<i class="fa fa-camera upload_icon"><span class="upload_span_icon"> Photo </span></i>
												<i class="fa fa-video-camera upload_icon"><span class="upload_span_icon"> Video</span>  </i> 
												<i class="fa fa-music upload_icon"> <span class="upload_span_icon">  Audio </span> </i>
												<i class="fa fa-file-pdf-o upload_icon"><span class="upload_span_icon"> PDF </span></i>
											</label>
										</div>
										
									</div>
									<div class="post-field">
										<form>
											<div class="form-group">
												
												<textarea placeholder="FOR WHOM THIS OPPORTUNITY ?&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;Ex:Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, PHP Developer, HR, BDE, CA, Doctor, Freelancer.." cols="10" rows="5" style="resize:none"></textarea>
												
											</div>
											<div class="form-group">
												<textarea type="text" class="" placeholder="WHICH LOCATION?&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a; Ex:Mumbai, Delhi, New south wels, London, New York, Captown, Sydeny, Shanghai, Moscow, Paris, Tokyo.. "></textarea>
												
											</div>
											<div class="form-group">
												<input type="text" placeholder="What is your field?">
											</div>
										
											
										</form>
										
										
									</div>
									<div class="text-right fw pt10">
										<a class="btn1" href="#">Post</a>
									</div>
								</div>
                                
                                
                              
                            </div>
                        </div>
                   
					</div>
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/owl.carousel.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js');?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script>
             var base_url = '<?php echo base_url(); ?>';
             var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
              
              
             var app = angular.module("userProfileApp", ["ngRoute"]);
             
             var item = '<?php echo $this->uri->segment(1); ?>'               
   app.controller('userProfileController', function($scope) {
     $scope.active = $scope.active == item?'':item;
     $scope.makeActive = function(item) {       
       $scope.active = $scope.active == item?'':item;
     }
   })
   
                    app.config(function ($routeProvider, $locationProvider) {
                        $routeProvider
                                .when("/profiless", {
                                    templateUrl: base_url + "userprofile_page/profile",
                                    controller: 'profilesController'
                                })
                                .when("/dashboard", {
                                    templateUrl: base_url + "userprofile_page/dashboard"
                                 //   controller: 'basicInfoController'
                                })
                                .when("/details", {
                                    templateUrl: base_url + "userprofile_page/details",
                                    controller: 'detailsController'
                                })
                                .when("/contacts", {
                                    templateUrl: base_url + "userprofile_page/contacts"
                                 //   controller: 'basicInfoController'
                                })
                                .when("/followers", {
                                    templateUrl: base_url + "userprofile_page/followers"
                                 //   controller: 'basicInfoController'
                                })
                                .when("/following", {
                                    templateUrl: base_url + "userprofile_page/following"
                                 //   controller: 'basicInfoController'
                                })
//                    .otherwise({
//                    redirectTo: '/profiles/'
//                    });
                        $locationProvider.html5Mode(true);
                    });
                    
                    app.controller('profilesController', function ($scope, $http, $location) {
                        $scope.user = {};
                        // PROFEETIONAL DATA
                        getFieldList();
                        function getFieldList() {
                           
                            $http({
                                method: 'POST',
                                url: base_url + 'userprofile_page/profiles_data',
                                data: 'u=' + user_id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .then(function (success) {
                                        details_data = success.data;
                                alert(details_data.rp_step);
                                
                                        $scope.details_data = details_data;
                                    });
                        }

                     
                        $scope.goMainLink = function(path){
                            location.href=path;
                        }
                      
                    });
                    
                       app.controller('detailsController', function ($scope, $http, $location) {
                        $scope.user = {};
                        // PROFEETIONAL DATA
                        getFieldList();
                        function getFieldList() {
                           
                            $http({
                                method: 'POST',
                                url: base_url + 'userprofile_page/detail_data',
                                data: 'u=' + user_id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .then(function (success) {
                                        details_data = success.data;
                                        $scope.details_data = details_data;
                                    });
                        }

                     
                        $scope.goMainLink = function(path){
                            location.href=path;
                        }
                        
                        $scope.makeActive = function(item){
                             $scope.active = $scope.active == item?'':item;
                        }
                    });
                    
     

            </script>
<!--        <script>
            jQuery(document).ready(function($) {
              var owl = $('.owl-carousel');
              owl.on('initialize.owl.carousel initialized.owl.carousel ' +
                'initialize.owl.carousel initialize.owl.carousel ' +
                'resize.owl.carousel resized.owl.carousel ' +
                'refresh.owl.carousel refreshed.owl.carousel ' +
                'update.owl.carousel updated.owl.carousel ' +
                'drag.owl.carousel dragged.owl.carousel ' +
                'translate.owl.carousel translated.owl.carousel ' +
                'to.owl.carousel changed.owl.carousel',
                function(e) {
                  $('.' + e.type)
                    .removeClass('secondary')
                    .addClass('success');
                  window.setTimeout(function() {
                    $('.' + e.type)
                      .removeClass('success')
                      .addClass('secondary');
                  }, 500);
                });
              owl.owlCarousel({
                loop: true,
                nav: true,
                lazyLoad: true,
                margin: 0,
                video: true,
                responsive: {
                  0: {
                    items: 1
                  },
				  480: {
                    items: 2
                  },
                  540: {
                    items: 3
                  },
                  1200: {
                    items: 1,
                  },
                  1280: {
                    items: 2
                  }
                }
              });
            });
		// mcustom scroll bar
			(function($){
				$(window).on("load",function(){
					
					$(".custom-scroll").mCustomScrollbar({
						autoHideScrollbar:true,
						theme:"minimal"
					});
					
				});
			})(jQuery);
                        
                        
                  
    </script>-->

</body>
</html>