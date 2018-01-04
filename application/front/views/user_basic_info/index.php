<!DOCTYPE html>
<html lang="en" ng-app="profileBasicInfoApp" ng-controller="profileBasicInfoController">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/common-style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/n-style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    </head>
    <body class="register">
        <?php echo $header_profile; ?>
        <div class="middle-section">
            <div class="container">
                <div class="form-box">
                    <h2 class="text-center">Basic Information</h3>
                        <form class="">
                            <div class="form-group">
                                <p class="student-or-not">If you are a student then <a data-target="#Student-info" data-toggle="modal" href="javascript:;">Click Here.</a></p>
                            </div>
                            <div class="form-group">
                                <label for="text">Who are you?</label>
                                <input type="text" class="form-control" placeholder="Ex:Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, Developer, HR, BDE, CA, Doctor..">
                            </div>
                            <div class="form-group">
                                <label for="text">Where are you from?</label>
                                <input type="text" class="form-control" placeholder="Enter your city name">
                            </div>
                            <div class="form-group">
                                <label for="email">What is your field?</label>
                                <select>
                                    <option>IT Sector, Automobile, Clothing, Event Management, Food Beverage, Medical, Real Estate..</option>
                                    <option>IT Sector</option>
                                    <option>Automobile</option>
                                    <option>Business Services</option>
                                    <option>Clothing</option>
                                    <option>Event Management</option>
                                    <option>Food Beverage</option>
                                    <option>Medical</option>
                                    <option>Real Estate</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <p class="text-center submit-btn">
                                <button type="submit" class="btn1">Submit</button>
                            </p>
                        </form>
                </div>
            </div>
        </div>
        <?php echo $login_footer; ?>
        <div style="display:none;" class="modal fade" id="Student-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <h3>Eduction Information</h3>
                    <form>
                        <div class="form-group">
                            <label for="text">What are you studying right now?</label>
                            <input type="text" class="form-control" placeholder="Pursuing: Engineering, Medicine, Desiging, MBA, Accounting, BA, 5th, 10th, 12th ..">
                        </div>
                        <div class="form-group">
                            <label for="text">Where are you from?</label>
                            <input type="text" class="form-control" placeholder="Enter your city name">
                        </div>
                        <div class="form-group">
                            <label for="text">University / Collage / School </label>
                            <input type="text" class="form-control" placeholder="Enter your University / Collage / school ">
                        </div>
                        <p class="text-center submit-btn">
                            <button type="submit" class="btn1">Submit</button>
                        </p>
                    </form>


                </div>
            </div>

        </div>
        <script src="<?php echo base_url('assets/js/angular/angular.min.1.5.7.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular/angular-route.1.6.4.js') ?>"></script>
        <script src="<?php echo base_url('assets/js_min/angular-ui-bootstrap-modal.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script>
            // Defining angularjs application.
                    var profileBasicInfoApp = angular.module('profileBasicInfoApp', ['ui.bootstrap.modal']);
                    profileBasicInfoApp.controller('profileBasicInfoController', function ($scope, $http) {
                        
                    });
        </script>
    </body>
</html>