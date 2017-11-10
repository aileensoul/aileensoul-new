<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head_profile_reg; ?>  
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
        <style type="text/css">
            span.error{
                background: none;
                color: red !important;
                padding: 0px 10px !important;
                position: absolute;
                right: 8px;
                z-index: 8;
                line-height: 15px;
                padding-right: 0px!important;
                font-size: 11px!important;
            }
            [contenteditable=true]:empty:before{
                content: attr(placeholder);
                display: block;
                font-size: 14px; /* For Firefox */
                color:#616060;
            }
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push" ng-app="descriptionApp" ng-controller="descriptionController">
        <?php echo $header; ?>
        <?php if ($business_common_data[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
        <section>
            <?php
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $busdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($busdata[0]['business_step'] == 4) {
                ?>
                <div class="user-midd-section" id="paddingtop_fixed">
                <?php } else {
                    ?>
                    <div class="user-midd-section" id="paddingtop_make_fixed">   
                    <?php }
                    ?>
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        if ($busdata[0]['business_step'] == 4) {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3>You are updating your Business Profile.</h3></div>
                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3>You are making your Business Profile.</h3></div>
                        <?php } ?>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li class="custom-none"><a href="<?php echo base_url('business-profile/business-information-update'); ?>"><?php echo $this->lang->line("business_information"); ?></a></li>
                                        <li class="custom-none"><a href="<?php echo base_url('business-profile/contact-information'); ?>"><?php echo $this->lang->line("contact_information"); ?></a></li>
                                        <li class="custom-none active init"><a href="javascript:void(0);"><?php echo $this->lang->line("description"); ?></a></li>
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
                                        Description
                                    </h3>
                                    <?php echo form_open(base_url('business-profile/description-insert'), array('id' => 'businessdis', 'name' => 'businessdis', 'class' => 'clearfix')); ?>
                                    <form name="businessdis" ng-submit="submitForm()" id="businessdis" class="clearfix">
                                        <fieldset>
                                            <label>Business type:<span style="color:red">*</span></label>
                                            <select name="business_type" ng-model="user.business_type" ng-change="busSelectCheck(this)" ng-options="business_typeItem.business_name for business_typeItem in businessTypeList" id="business_type" tabindex="1">
                                                <option value="" selected="selected">Select Business type</option>
                                            </select>
                                            <span ng-show="errorBusinessType" class="error">{{errorBusinessType}}</span>
                                        </fieldset>  
                                        <fieldset>
                                            <label>Category:<span style="color:red">*</span></label>
                                            <select name="industriyal" ng-model="user.industriyal" ng-change="indSelectCheck(this)" ng-options="industriyalItem.industry_name for industriyalItem in industriyalList" id="industriyal" tabindex="2">
                                                <option value="" selected="selected">Select Industry type</option>
                                            </select>
                                            <span ng-show="errorCategory" class="error">{{errorCategory}}</span>
                                        </fieldset>  

                                        <fieldset class="hs-submit full-width">
                                            <input type="submit"  id="next" name="next" value="Next" tabindex="6" >
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php echo $login_footer ?>
        <?php echo $footer; ?>
        <script>
                    var base_url = '<?php echo base_url(); ?>';
                    var slug = '<?php echo $slugid; ?>';
        </script>
        <script>
                    // Defining angularjs application.
                    var descriptionApp = angular.module('descriptionApp', []);
                    // Controller function and passing $http service and $scope var.
                    descriptionApp.controller('descriptionController', function ($scope, $http) {
                        // create a blank object to handle form data.
                        $scope.user = {};

                        $scope.businessTypeList = undefined;
                        $scope.industriyalList = undefined;

                        $http({
                            method: 'GET',
                            url: base_url + 'business_profile_registration/getBusinessType',
                        }).success(function (data) {
                            // console.log(data);
                            $scope.businessTypeList = data;
                        });

                        $http({
                            method: 'GET',
                            url: base_url + 'business_profile_registration/getCategory',
                        }).success(function (data) {
                            // console.log(data);
                            $scope.industriyalList = data;
                        });


                        // calling our submit function.
                        $scope.submitForm = function () {
                            // Posting data to php file
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/ng_bus_info_insert',
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
                                            if (data.is_success == '1') {
                                                window.location.href = base_url + 'business-profile/contact-information';
                                            } else {
                                                return false;
                                            }
                                            //$scope.message = data.message;
                                        }
                                    });
                        };
                    });
        </script>
        <?php if (IS_BUSINESS_JS_MINIFY == '0') { ?>
                <!--        <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/description.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>-->
        <?php } else { ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/description.min.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/business-profile/common.min.js?ver=' . time()); ?>"></script>
        <?php } ?>
    </body>
</html>

