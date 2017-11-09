<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <?php
        if (IS_BUSINESS_CSS_MINIFY == '0') {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/business.css?ver=' . time()); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/business_profile/business-common.min.css?ver=' . time()); ?>">
        <?php } ?>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push" ng-app="postApp" ng-controller="postController">
        <?php echo  $header; ?>
        <?php if ($business_common_data[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
        <section>
            <?php
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $busdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($busdata[0]['business_step'] == 4) {
                ?> <div class="user-midd-section" id="paddingtop_fixed">
            <?php } else { ?>
                    <div class="user-midd-section" id="paddingtop_make_fixed">
                    <?php } ?>
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        if ($busdata[0]['business_step'] == 4) {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_edit_title"); ?></h3></div>
                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_title"); ?></h3></div>
                        <?php } ?>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li <?php if ($this->uri->segment(1) == 'business-profile') { ?> class="active init" <?php } ?>><a href="#"><?php echo $this->lang->line("business_information"); ?></a></li>
                                        <?php if ($business_common_data[0]['business_step'] > '0' && $business_common_data[0]['business_step'] != '') { ?>
                                            <li class="custom-none"><a href="<?php echo base_url('business-profile/contact-information'); ?>"><?php echo $this->lang->line("contact_information"); ?></a></li>
                                        <?php } else { ?>
                                            <li class="custom-none"><a href="javascript:void(0);"><?php echo $this->lang->line("contact_information"); ?></a></li>
                                        <?php } ?>
                                        <?php if ($business_common_data[0]['business_step'] > '1' && $business_common_data[0]['business_step'] != '') { ?>
                                            <li class="custom-none"><a href="<?php echo base_url('business-profile/description'); ?>"><?php echo $this->lang->line("description"); ?></a></li>
                                        <?php } else { ?>
                                            <li class="custom-none"><a href="javascript:void(0);"><?php echo $this->lang->line("description"); ?></a></li>
                                        <?php } ?>
                                        <?php if ($business_common_data[0]['business_step'] > '2' && $business_common_data[0]['business_step'] != '') { ?>    
                                            <li class="custom-none"><a href="<?php echo base_url('business-profile/image'); ?>"><?php echo $this->lang->line("business_images"); ?></a></li>
                                        <?php } else {
                                            ?>
                                            <li class="custom-none"><a href="javascript:void(0);"><?php echo $this->lang->line("business_images"); ?></a></li>
                                        <?php }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="common-form common-form_border">
                                    <h3>
                                        <?php echo $this->lang->line("business_information"); ?>
                                    </h3>
                                    <form name="businessinfo" ng-submit="submitForm()" id="businessinfo" class="clearfix">
                                        <fieldset class="full-width ">
                                            <label>Company name:<span style="color:red">*</span></label>
                                            <input name="companyname" ng-model="user.companyname" tabindex="1" autofocus type="text" id="companyname" placeholder="Enter company name" value=""/>
                                            <span ng-show="errorCompanyName">{{errorCompanyName}}</span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Country:<span style="color:red">*</span></label>
                                            <select name="country" ng-model="user.country" ng-change="onCountryChange()" ng-options="countryItem.id as countryItem.countryName for countryItem in countryList" id="country" tabindex="2" >
                                                <option value="">Country</option>
                                                <option value="1">Afghanistan</option>
                                            </select>
                                            <span ng-show="errorCountry">{{errorCountry}}</span>
                                        </fieldset>
                                        <fieldset>
                                            <label>State:<span style="color:red">*</span></label>
                                            <select name="state" ng-model="user.state" id="state" tabindex="3" >
                                                <option value="">Select country first</option>
                                            </select>
                                            <span ng-show="errorState">{{errorState}}</span>
                                        </fieldset>
                                        <fieldset>
                                            <label> City<span class="optional">(optional)</span>:</label>
                                            <select name="city" ng-model="user.city" id="city" tabindex="4" >
                                                <option value="">Select State First</option>
                                            </select>
                                            <span ng-show="errorCity">{{errorCity}}</span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Pincode<span class="optional">(optional)</span>:</label>
                                            <input name="pincode" ng-model="user.pincode" tabindex="5"   type="text" id="pincode" placeholder="Enter pincode" value="">
                                            <span ng-show="errorPincode">{{errorPincode}}</span>
                                        </fieldset>
                                        <fieldset class="full-width ">
                                            <label>Postal address:<span style="color:red">*</span></label>
                                            <input name="business_address" ng-model="user.business_address" tabindex="6" autofocus type="text" id="business_address" placeholder="Enter address" style="resize: none;" value=""/>
                                            <span ng-show="errorPostalAddress">{{errorPostalAddress}}</span>                                                                        
                                        </fieldset>
                                        <fieldset class="hs-submit full-width">
                                            <input type="submit"  id="next" name="next" tabindex="7"  value="Next">
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <?php //echo $login_footer ?>
        <?php //echo $footer; ?>
        <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
        <script>
                                                        var base_url = '<?php echo base_url(); ?>';
                                                        var slug = '<?php echo $slugid; ?>';

                                                        var company_name_validation = '<?php echo $this->lang->line('company_name_validation') ?>';
                                                        var country_validation = '<?php echo $this->lang->line('country_validation') ?>';
                                                        var state_validation = '<?php echo $this->lang->line('state_validation') ?>';
                                                        var address_validation = '<?php echo $this->lang->line('address_validation') ?>';
        </script>
        <script>

                    var postApp = angular.module('postApp', []);
                    
                    postApp.controller('postController', ['$http', '$scope', function ($http, $scope) {

                            $scope.countryList = undefined;
                            $scope.stateList = undefined;
                            $scope.cityList = undefined;

                            $http({
                                method: 'GET',
                                url: base_url + 'business_profile/getCountry',
                            }).success(function (data) {
                                console.log(data);
                                $scope.countryList = data;
                            });

                            $scope.onCountryChange = function () {
                                $scope.countryIdVal = $scope.countryId;
                                // console.log(“data state processing”+$scope.stateIdVal);
                                $http({
                                    method: 'POST',
                                    url: base_url + 'business_profile/getStateByCountryId',
                                    data: {countryId: $scope.countryIdVal}
                                }).success(function (data) {
                                    console.log(data);
                                    $scope.stateList = data;
                                });
                            };
                            $scope.onStateChange = function () {
                                $scope.stateIdVal = $scope.stateId;
                                // console.log(“data state processing”+$scope.stateIdVal);
                                $http({
                                    method: 'POST',
                                    url: base_url + 'business_profile/getCityByStateId',
                                    data: {stateId: $scope.stateIdVal}
                                }).success(function (data) {
                                    console.log(data);
                                    $scope.cityList = data;
                                });
                            };
                        }]);
        </script>
        <script>
                    // Defining angularjs application.
                    var postApp = angular.module('postApp', []);
                    // Controller function and passing $http service and $scope var.
                    postApp.controller('postController', function ($scope, $http) {
                        // create a blank object to handle form data.
                        $scope.user = {};
                        // calling our submit function.
                        $scope.submitForm = function () {
                            // Posting data to php file
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile/ng_bus_info_insert',
                                data: $scope.user, //forms user object
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .success(function (data) {
                                        if (data.errors) {
                                            // Showing errors.
                                            $scope.errorCompanyName = data.errors.companyname;
                                            $scope.errorCountry = data.errors.country;
                                            $scope.errorState = data.errors.state;
                                            $scope.errorCity = data.errors.city;
                                            $scope.errorPincode = data.errors.pincode;
                                            $scope.errorPostalAddress = data.errors.business_address;
                                        } else {
                                            $scope.message = data.message;
                                        }
                                    });
                        };
                    });
        </script>
        <?php
        if (IS_BUSINESS_JS_MINIFY == '0') {
            ?>
<!--            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/information.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>-->
        <?php } else {
            ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/information.min.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/business-profile/common.min.js?ver=' . time()); ?>"></script>
        <?php }
        ?>
    </body>
</html>
