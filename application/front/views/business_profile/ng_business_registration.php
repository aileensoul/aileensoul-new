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
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-left > .nav-tabs > li {
                float: none;
            }


        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push" ng-app="busRegApp" ng-controller="busRegController">
        <?php echo $header; ?>
        <?php if ($business_common_data[0]['business_step'] == 4) { ?>
            <?php //echo $business_header2_border; ?>
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
                            <div class="col-md-12">
                                <div class="left-side-bar">
                                    <div class="col-md-3 col-sm-4">
                                        <ul class="left-form-each">
                                            <input ng-model="busRegStep" type="hidden" value="" id="busRegStep">
                                            <!--<li><a href="#business_information" ng-click="tab_active(1)" data-toggle="tab">Business Information</a></li>
                                            <?php if ($business_common_data[0]['business_step'] >= '1' && $business_common_data[0]['business_step'] != '') { ?>
                                                                <li><a href="#contact_information" ng-click="getContactInformation(); tab_active(2);" data-toggle="tab">Contact Information</a></li>
                                            <?php } else { ?>
                                                                <li><a href="javascript:void(0);">Contact Information</a></li>
                                            <?php } ?>
                                            <?php if ($business_common_data[0]['business_step'] > '1' && $business_common_data[0]['business_step'] != '') { ?>
                                                                <li><a href="#description" ng-click="getDescription(); tab_active(3)" data-toggle="tab">Description</a></li>
                                            <?php } else { ?>
                                                                <li><a href="javascript:void(0);">Description</a></li>
                                            <?php } ?>
                                            <?php if ($business_common_data[0]['business_step'] > '2' && $business_common_data[0]['business_step'] != '') { ?>    
                                                                <li><a href="#business_image" ng-click="getImage(); tab_active(4)" data-toggle="tab">Business Images</a></li>
                                            <?php } else { ?>
                                                                <li><a href="javascript:void(0);">Business Images</a></li>
                                            <?php } ?> -->
                                            <!--                                            <li><a href="#business_information" ng-click="tab_active(1)" data-toggle="tab" ng-if="busRegStep >= '0'">Business Information</a></li>
                                                                                        <li><a href="#contact_information" ng-click="getContactInformation(); tab_active(2);" data-toggle="tab" ng-if="busRegStep >= '1'">Contact Information</a></li>
                                                                                        <li><a href="#description" ng-click="getDescription(); tab_active(3)" data-toggle="tab" ng-if="busRegStep >= '2'">Description</a></li>
                                                                                        <li><a href="#business_image" ng-click="getImage(); tab_active(4)" data-toggle="tab" ng-if="busRegStep >= '3'">Business Images</a></li>-->
                                            <li><a href="#business_information" ng-click="tab_active(1)" data-toggle="tab" ng-disabled="">Business Information</a></li>
                                            <li><a href="#contact_information" ng-click="getContactInformation(); tab_active(2);" ng-disabled="" data-toggle="tab">Contact Information</a></li>
                                            <li><a href="#description" ng-click="getDescription(); tab_active(3)" ng-disabled="" data-toggle="tab">Description</a></li>
                                            <li><a href="#business_image" ng-click="getImage(); tab_active(4)" ng-disabled="" data-toggle="tab">Business Images</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-8">
                                        <div class="common-form common-form_border">
                                            <div class="tab-content">
                                                <div class="tab-pane" id="business_information">                
                                                    <div class="">
                                                        <h3>
                                                            <?php echo $this->lang->line("business_information"); ?>
                                                        </h3>
                                                        <form name="businessinfo" ng-submit="submitbusinessinfoForm()" id="businessinfo" class="clearfix" novalidate>
                                                            <fieldset class="full-width ">
                                                                <label>Company name:<span style="color:red">*</span></label>
                                                                <input name="companyname"  ng-model="user.companyname" tabindex="1" autofocus type="text" id="companyname" placeholder="Enter company name" value="" ng-required="true" validation-max-length="10"
                                                                       validation-min-length="5"
                                                                       validation-no-space="true"
                                                                       validation-field-required="true"
                                                                       validation-no-special-chars="true"/>
                                                                <span ng-show="errorCompanyName" class="error">{{errorCompanyName}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Country:<span style="color:red">*</span></label>
                                                                <select name="country" ng-model="user.country_id" ng-change="onCountryChange()" id="country" tabindex="2">
                                                                    <option value="" selected="selected">Country</option>
                                                                    <option ng-repeat='countryItem in countryList' value='{{countryItem.country_id}}'>{{countryItem.country_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorCountry" class="error">{{errorCountry}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>State:<span style="color:red">*</span></label>
                                                                <select name="state" ng-model="user.state_id" ng-change="onStateChange()" id="state" tabindex="3">
                                                                    <option value="">Select country first</option>
                                                                    <option ng-repeat='stateItem in stateList' value='{{stateItem.state_id}}' ng-selected="user.state_id == stateItem.state_id">{{stateItem.state_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorState" class="error">{{errorState}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label> City<span class="optional">(optional)</span>:</label>
                                                                <select name="city" ng-model="user.city_id" id="city" tabindex="4">
                                                                    <option value="">Select State First</option>
                                                                    <option ng-repeat='cityItem in cityList' value='{{cityItem.city_id}}'>{{cityItem.city_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorCity" class="error">{{errorCity}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Pincode<span class="optional">(optional)</span>:</label>
                                                                <input name="pincode" ng-model="user.pincode" tabindex="5"   type="text" id="pincode" placeholder="Enter pincode" value="">
                                                                <span ng-show="errorPincode" class="error">{{errorPincode}}</span>
                                                            </fieldset>
                                                            <fieldset class="full-width ">
                                                                <label>Postal address:<span style="color:red">*</span></label>
                                                                <input name="business_address" ng-model="user.business_address" tabindex="6" autofocus type="text" id="business_address" placeholder="Enter address" style="resize: none;" value=""/>
                                                                <span ng-show="errorPostalAddress" class="error">{{errorPostalAddress}}</span>                                                                        
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width">
                                                                <input type="submit"  id="next" name="next" tabindex="7"  value="Next">
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div> 
                                                <div class="tab-pane" id="contact_information"> 
                                                    <div class="">
                                                        <h3>
                                                            Contact Information
                                                        </h3>
                                                        <form name="contactinfo" ng-submit="submitcontactinfoForm()" id="contactinfo" class="clearfix">
                                                            <fieldset>
                                                                <label>Contact person:<span style="color:red">*</span></label>
                                                                <input name="contactname" ng-model="user.contactname" tabindex="1" autofocus type="text" id="contactname" placeholder="Enter contact name" value=""/>
                                                                <span ng-show="errorContactName" class="error">{{errorContactName}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact mobile:<span style="color:red">*</span></label>
                                                                <input name="contactmobile" ng-model="user.contactmobile" tabindex="2" autofocus type="text" id="contactmobile" placeholder="Enter contact mobile" value=""/>
                                                                <span ng-show="errorContactMobile" class="error">{{errorContactMobile}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact email:<span style="color:red">*</span></label>
                                                                <input name="email" ng-model="user.email" tabindex="3" autofocus type="text" id="email" placeholder="Enter contact email" value=""/>
                                                                <span ng-show="errorEmail" class="error">{{errorEmail}}</span>                                                                        
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact website<span class="optional">(optional)</span>:</label>
                                                                <input name="contactwebsite" ng-model="user.contactwebsite" tabindex="4" autofocus type="text" id="contactwebsite" placeholder="Enter contact email" value=""/>
                                                                <span class="website_hint" style="font-size: 13px; color: #1b8ab9;">Note : <i>Enter website url with http or https</i></span>                                 
                                                                <span ng-show="errorContactWebsite" class="error">{{errorContactWebsite}}</span>                      
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width">
                                                                <input type="submit"  id="next" name="next" tabindex="5"  value="Next">
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="description"> 
                                                    <div class="">
                                                        <h3>
                                                            Description
                                                        </h3>
                                                        <form name="businessdis" ng-submit="submitdescriptionForm()" id="businessdis" class="clearfix">
                                                            <fieldset>
                                                                <label>Business type:<span style="color:red">*</span></label>
<!--                                                                <select name="business_type" ng-model="user.business_type" ng-change="busSelectCheck(this)" id="business_type" tabindex="1">
                                                                    <option ng-option value="" selected="selected">Select Business type</option>
                                                                <?php foreach ($business_type as $key => $type) { ?>
                                                                                                                            <option ng-option value="<?php echo $type->type_id; ?>"><?php echo $type->business_name; ?></option>
                                                                <?php } ?>
                                                                    <option ng-option value="0" id="busOption">Other</option>    
                                                                </select>-->
                                                                <select name="business_type" ng-model="user.business_type" ng-change="busSelectCheck(this)" id="business_type" tabindex="1">
                                                                    <option value="" selected="selected">Select Business type</option>
                                                                    <option ng-repeat='businessType in business_type' value='{{businessType.type_id}}'>{{businessType.business_name}}</option>             
                                                                    <option ng-option value="0" id="busOption">Other</option>    
                                                                </select>
                                                                <span ng-show="errorBusinessType" class="error">{{errorBusinessType}}</span>
                                                            </fieldset>  
                                                            <fieldset>
                                                                <label>Category:<span style="color:red">*</span></label>
<!--                                                                <select name="industriyal" ng-model="user.industriyal" ng-change="indSelectCheck(this)" id="industriyal" tabindex="2">
                                                                    <option ng-option value="" selected="selected">Select Industry type</option>
                                                                <?php foreach ($category_list as $key => $category) { ?>
                                                                                                                            <option ng-option value="<?php echo $category->industry_id; ?>"><?php echo $category->industry_name; ?></option>
                                                                <?php } ?>
                                                                    <option ng-option value="0" id="indOption">Other</option>
                                                                </select>-->
                                                                <select name="industriyal" ng-model="user.industriyal" ng-change="indSelectCheck(this)" id="industriyal" tabindex="2">
                                                                    <option ng-option value="" selected="selected">Select Industry type</option>
                                                                    <option ng-repeat='caegoryType in industry_type' value='{{caegoryType.industry_id}}'>{{caegoryType.industry_name}}</option>             
                                                                    <option ng-option value="0" id="indOption">Other</option>
                                                                </select>
                                                                <span ng-show="errorCategory" class="error">{{errorCategory}}</span>
                                                            </fieldset>  
                                                            <div id="busDivCheck" ng-if="user.business_type == '0'">
                                                                <fieldset class="half-width" id="other-business">
                                                                    <label> Other business type: <span style="color:red;" >*</span></label>
                                                                    <input type="text" name="bustype" ng-model="user.bustype"  tabindex="3"  id="bustype" value="<?php echo $other_business; ?>">
                                                                    <span ng-show="errorOtherBusinessType" class="error">{{errorOtherBusinessType}}</span>
                                                                </fieldset>
                                                            </div>
                                                            <div id="indDivCheck" ng-if="user.industriyal == '0'">
                                                                <fieldset class="half-width" id="other-category">
                                                                    <label> Other category:<span style="color:red;" >*</span></label>
                                                                    <input type="text" name="indtype" ng-model="user.indtype" id="indtype" tabindex="4"  value="<?php echo $other_industry; ?>">
                                                                    <span ng-show="errorOtherCategory" class="error">{{errorOtherCategory}}</span>
                                                                </fieldset>
                                                            </div>
                                                            <fieldset class="full-width">
                                                                <label>Details of your business:<span style="color:red">*</span></label>
                                                                <textarea name="business_details" ng-model="user.business_details" id="business_details" rows="4" tabindex="5"  cols="50" placeholder="Enter business detail" style="resize: none;"></textarea>
                                                                <span ng-show="errorBusinessDetails" class="error">{{errorBusinessDetails}}</span>
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width">
                                                                <input type="submit"  id="next" name="next" value="Next" tabindex="6" >
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="business_image"> 
                                                    <div class="">
                                                        <h3>Business Images</h3>
                                                        <form name="businessimage" ng-submit="submitbusImageForm()" id="businessimage" class="clearfix">
                                                            <fieldset class="full-width">
                                                                <label>Business images<span class="optional">(optional)</span>:</label>
                                                                <input type="file" file-input="files" ng-file-model="user.image1" tabindex="1" name="image1[]" accept="image/*" id="image1" multiple/> 
                                                                <span ng-show="errorImage" class="error">{{errorImage}}</span>                                                                        
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="full-width">
                                                                <div class="bus_image" style="color:#f00; display: block;"></div> 
                                                                <div class="bus_image_prev"></div> 
                                                            </fieldset>
                                                            <fieldset class = "hs-submit full-width">
                                                                <input type = "submit" id = "submit" name = "submit" tabindex = "2" value = "Submit">
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/tabs -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php echo $login_footer ?>
        <?php echo $footer; ?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script>
                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                        var slug = '<?php echo $slugid; ?>';
                                                                        var reg_uri = '<?php echo $reg_uri ?>';
        </script>
        <script>
                    // Defining angularjs application.
                    var busRegApp = angular.module('busRegApp', []);
                    busRegApp.directive("fileInput", function ($parse) {
                        return{
                            link: function ($scope, element, attrs) {
                                element.on("change", function (event) {
                                    var files = event.target.files;
                                    $parse(attrs.fileInput).assign($scope, element[0].files);
                                    $scope.$apply();
                                });
                            }
                        }
                    });
                    // Controller function and passing $http service and $scope var.
                    busRegApp.controller('busRegController', function ($scope, $http) {
                        // create a blank object to handle form data.
                        $scope.user = {};
                        $scope.countryList = undefined;
                        $scope.stateList = undefined;
                        $scope.cityList = undefined;
                        $scope.tab_active = function (data) {
                            if (data == 1) {
                                history.pushState('Business information', 'Business information', 'business-information');
                            } else if (data == 2) {
                                history.pushState('Contact information', 'Contact information', 'contact-information');
                            } else if (data == 3) {
                                history.pushState('Description', 'Description', 'description');
                            } else if (data == 4) {
                                history.pushState('Business image', 'Business image', 'image');
                            }

                            if (typeof (history.pushState) != "undefined") {
                                var obj = {Title: title, Url: url};
                                history.pushState(obj, obj.Title, obj.Url);
                                $(".common-form_border").load(url);
                            } else {
                                alert("Browser does not support HTML5.");
                            }
                        }
                        if (reg_uri == 'business-information') {
                            $('ul.left-form-each li').removeClass('active');
                            $('ul.left-form-each li:nth-child(1)').addClass('active');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(1)').addClass('active');
                        } else if (reg_uri == 'contact-information') {
                            $('ul.left-form-each li').removeClass('active');
                            $('ul.left-form-each li:nth-child(2)').addClass('active');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(2)').addClass('active');
                            getContactInformation();
                        } else if (reg_uri == 'description') {
                            $('ul.left-form-each li').removeClass('active');
                            $('ul.left-form-each li:nth-child(3)').addClass('active');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(3)').addClass('active');
                            getDescription();
                        } else if (reg_uri == 'image') {
                            $('ul.left-form-each li').removeClass('active');
                            $('ul.left-form-each li:nth-child(4)').addClass('active');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(4)').addClass('active');
                            getImage();
                        }
                        $(window).bind('popstate', function () {
                            window.location.href = window.location.href;
                        });
                        $http({
                            method: 'GET',
                            url: base_url + 'business_profile_registration/getCountry',
                            headers: {'Content-Type': 'application/json'},
                        }).success(function (data) {
                            $scope.countryList = data;
                        });

                        function onCountryChange(country_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getStateByCountryId',
                                data: {countryId: country_id}
                            }).success(function (data) {
                                $scope.stateList = data;
                                $("#state").find("option").eq(0).remove();
                                //$scope.user.business_step = data[0].business_step;
                            });
                        }

                        $scope.onCountryChange = function () {
                            $scope.countryIdVal = $scope.user.country_id;
                            onCountryChange($scope.countryIdVal);
                            $("#city").find("option").eq(0).remove();
                            $scope.user.city_id = '0';
                        };

                        function onStateChange(state_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getCityByStateId',
                                data: {stateId: state_id}
                            }).success(function (data) {
                                $scope.cityList = data;
                            });
                        }

                        $scope.onStateChange = function () {
                            $scope.stateIdVal = $scope.user.state_id;
                            onStateChange($scope.stateIdVal);
                        };


                        $http({
                            method: 'POST',
                            url: base_url + 'business_profile_registration/getBusinessInformation',
                            headers: {'Content-Type': 'application/json'},
                        }).success(function (data) {
                            onCountryChange(data[0].country);
                            onStateChange(data[0].state);

                            $scope.user.companyname = data[0].company_name;
                            $scope.user.country_id = data[0].country;
                            $scope.user.state_id = data[0].state;
                            $scope.user.city_id = data[0].city;
                            $scope.user.pincode = data[0].pincode;
                            $scope.user.business_address = data[0].address;
                            $scope.user.businfo_step = data[0].business_step;
                            $scope.busRegStep = data[0].business_step;
                        });

                        function getContactInformation() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getContactInformation',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                $scope.user.contactname = data[0].contact_person;
                                $scope.user.contactmobile = data[0].contact_mobile;
                                $scope.user.email = data[0].contact_email;
                                $scope.user.contactwebsite = data[0].contact_website;
                                $scope.user.busreg_step = data[0].business_step;
                            });
                        }
                        ;

                        $scope.getContactInformation = function () {
                            getContactInformation();
                        };

                        function getDescription() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getDescription',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                $scope.user.business_type = data['userdata'][0].business_type;
                                $scope.user.industriyal = data['userdata'][0].industriyal;
                                $scope.user.business_details = data['userdata'][0].details;
                                $scope.user.bustype = data['userdata'][0].other_business_type;
                                $scope.user.indtype = data['userdata'][0].other_industrial;
                                $scope.user.busreg_step = data['userdata'][0].business_step;

                                $scope.business_type = data['business_type'];
                                $scope.industry_type = data['industriyaldata'];
                            });
                        }
                        ;

                        $scope.getDescription = function () {
                            getDescription();
                        };

                        function getImage() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getImage',
                            }).success(function (data) {
                                $('.bus_image_prev').html(data);
                            });
                        }
                        ;

                        $scope.getImage = function () {
                            getImage();
                        };


                        // calling our submit function.
                        $scope.submitbusinessinfoForm = function () {
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
                                                //window.location.href = base_url + 'business-profile/signup/contact-information';
                                                $('ul.left-form-each li').removeClass('active');
                                                $('ul.left-form-each li:nth-child(2)').addClass('active');
                                                $('.tab-content .tab-pane').removeClass('active');
                                                $('.tab-content .tab-pane:nth-child(2)').addClass('active');
                                                $scope.tab_active(2);
                                                getContactInformation();
                                            } else {
                                                return false;
                                            }
                                            //$scope.message = data.message;
                                        }
                                    });
                        };
                        $scope.submitcontactinfoForm = function () {
                            // Posting data to php file
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/ng_contact_info_insert',
                                data: $scope.user, //forms user object
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .success(function (data) {
                                        if (data.errors) {
                                            // Showing errors.
                                            $scope.errorContactName = data.errors.contactname;
                                            $scope.errorContactMobile = data.errors.contactmobile;
                                            $scope.errorEmail = data.errors.email;
                                            $scope.errorCity = data.errors.city;
                                            $scope.errorContactWebsite = data.errors.contactwebsite;
                                        } else {
                                            if (data.is_success == '1') {
                                                //window.location.href = base_url + 'business-profile/signup/description';
                                                $('ul.left-form-each li').removeClass('active');
                                                $('ul.left-form-each li:nth-child(3)').addClass('active');
                                                $('.tab-content .tab-pane').removeClass('active');
                                                $('.tab-content .tab-pane:nth-child(3)').addClass('active');
                                                $scope.tab_active(3);
                                                getDescription();
                                            } else {
                                                return false;
                                            }
                                            //$scope.message = data.message;
                                        }
                                    });
                        };
                        $scope.submitdescriptionForm = function () {
                            // Posting data to php file
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/ng_description_insert',
                                data: $scope.user, //forms user object
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .success(function (data) {
                                        if (data.errors) {
                                            // Showing errors.
                                            $scope.errorBusinessType = data.errors.business_type;
                                            $scope.errorCategory = data.errors.industriyal;
                                            $scope.errorOtherBusinessType = data.errors.bustype;
                                            $scope.errorOtherCategory = data.errors.indtype;
                                            $scope.errorBusinessDetails = data.errors.business_details;
                                        } else {
                                            if (data.is_success == '1') {
                                                //window.location.href = base_url + 'business-profile/signup/image';
                                                $('ul.left-form-each li').removeClass('active');
                                                $('ul.left-form-each li:nth-child(4)').addClass('active');
                                                $('.tab-content .tab-pane').removeClass('active');
                                                $('.tab-content .tab-pane:nth-child(4)').addClass('active');
                                                $scope.tab_active(4);
                                                getImage();
                                            } else {
                                                return false;
                                            }
                                            //$scope.message = data.message;
                                        }
                                    });
                        };
                        $scope.submitbusImageForm = function () {
                            var form_data = new FormData();
                            angular.forEach($scope.files, function (file) {
                                //                                console.log(file);
                                form_data.append('image1[]', file);
                            });
                            $http.post(base_url + 'business_profile_registration/ng_image_insert', form_data,
                                    {
                                        transformRequest: angular.identity,
                                        headers: {'Content-Type': undefined, 'Process-Data': false}
                                    }).success(function (data) {
                                if (data.errors) {
                                    // Showing errors.
                                    $scope.errorImage = data.errors.image1;
                                } else {
                                    if (data.is_success == '1') {
                                        window.location.href = base_url + 'business-profile/home';
                                    } else {
                                        return false;
                                    }
                                }
                            });
                        }
                    });
                    function delete_bus_image(image_id) {
                        $.ajax({
                            type: 'POST',
                            url: base_url + "business_profile_registration/bus_img_delete",
                            data: 'image_id=' + image_id,
                            success: function (data) {
                                if (data) {
                                    $('.job_work_edit_' + image_id).remove();
                                }
                            }
                        });
                    }

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
