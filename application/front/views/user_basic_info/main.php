<!DOCTYPE html>
<!--<html lang="en" ng-app="profileBasicInfoApp" ng-controller="profileBasicInfoController">-->
<html lang="en" ng-app="profileBasicInfoApp">
    <head>
        <base href="/aileensoul-new/" >
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
       <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/common-style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/font-awesome.min.css') ?>">
        <style>
            #searchResult{
                list-style: none;
                padding: 0px;
                width: 500px;
                position: absolute;
                margin: 0;
            }

            #searchResult li{
                background: lavender;
                padding: 4px;
                margin-bottom: 1px;
            }

            #searchResult li.active{
                background: #000000;
            }

            #searchResult li:nth-child(even){
                background: cadetblue;
                color: white;
            }

            #searchResult li:hover{
                cursor: pointer;
            }

        </style>
    </head>
    <body class="register">
        <?php echo $header_profile; ?>
        
        

        <div class="middle-section">
<a href="user_basic_info/basic_profile">Basic information</a>
<!--<a href="user_basic_info/student_profile">Student information</a>-->
            <!-- MIDDLE SECTION -->
            
            <div ng-view></div>
        </div>
        <?php echo $login_footer; ?>
        
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>

        <!--<script src="<?php //echo base_url('assets/js/angular/angular.min.1.5.7.js') ?>"></script>-->
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <!--<script src="<?php// echo base_url('assets/js/angular/angular-route.1.6.4.js') ?>"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script>
                                    var base_url = '<?php echo base_url(); ?>';
                                    var slug = '<?php echo $slugid; ?>';
                                    var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
       
        
       
//alert(base_url);
var app = angular.module("profileBasicInfoApp", ["ngRoute"]);
app.config(function($routeProvider,$locationProvider) {
    $routeProvider
    .when("/user_basic_info/basic_profile", {
//        templateUrl : "red.html"
        templateUrl : base_url + "recruiter/basic_profile"
    })
    .when("/user_basic_info/student_profile", {
        templateUrl : base_url + "recruiter/student_profile"
    })
    $locationProvider.html5Mode(true);
});
        
        </script>
      
    </body>
</html>