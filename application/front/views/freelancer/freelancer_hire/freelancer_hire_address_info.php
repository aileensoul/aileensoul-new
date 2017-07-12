<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    </head>
    <div class="js">
        <body>
            <div id="preloader"></div>
            <?php echo $header; ?>
            <?php
            if ($freehiredata[0]['free_hire_step'] == '3') {
                echo $freelancer_hire_header2_border;
            }
            ?>
            <section>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        $contition_array = array('user_id' => $userid, 'status' => '1');
                        $freehiredata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        if ($freehiredata[0]['free_hire_step'] == 3) {
                            ?>
                            <div class="col-md-6 col-sm-6"><h3>You are updating your Freelancer Profile.</h3></div>

                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-6"><h3>You are making your Freelancer Profile.</h3></div>
                        <?php } ?>

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li class="custom-none "> <a href="<?php echo base_url('freelancer_hire/freelancer_hire_basic_info'); ?>">Basic Information</a></li>
                                        <li <?php if ($this->uri->segment(1) == 'freelancer_hire') { ?> class="active init" <?php } ?>><a href="#">Address Information</a></li>
                                        <li class="custom-none  <?php
                                        if ($freehiredata[0]['free_hire_step'] < '2') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer_hire/freelancer_hire_professional_info'); ?>">Professional Information</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div>
                                    <?php
                                    if ($this->session->flashdata('error')) {
                                        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                    }
                                    if ($this->session->flashdata('success')) {
                                        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="common-form common-form_border">
                                    <h3>Address Information</h3>
                                    <?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_address_info_insert'), array('id' => 'address_info', 'name' => 'address_info', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                    </div>
                                    <?php
                                    $country = form_error('country');
                                    $state = form_error('state');
                                    $address = form_error('address');
                                    ?>
                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label>Country:<span class="red">*</span></label>
                                        <select tabindex="1"  name="country" id="country" autofocus>
                                            <option value="">Select Country</option>
                                            <?php
                                            if (count($countries) > 0) {
                                                foreach ($countries as $cnt) {

                                                    if ($country1) {
                                                        ?>
                                                        <option value="<?php echo $cnt['country_id']; ?>" <?php if ($cnt['country_id'] == $country1) echo 'selected'; ?>><?php echo $cnt['country_name']; ?></option>

                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('country'); ?>
                                    </fieldset>
                                    <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                        <label>State:<span class="red">*</span></label>
                                        <select tabindex="2" name="state" id="state">
                                            <?php
                                            if ($state1) {
                                                foreach ($states as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else {
                                                ?>
                                                <option value="">Select country first</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('state'); ?>
                                    </fieldset>
                                    <fieldset>
                                        <label>City:</label>
                                        <select name="city" tabindex="3" id="city">
                                            <?php
                                            if ($city1) {
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else if ($state1) {
                                                ?>
                                                <option value="">Select City</option>
                                                <?php
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Select state first</option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <?php ?>
                                    <fieldset>
                                        <label>Pincode:</label>
                                        <input type="text" name="pincode" tabindex="4" id="pincode" placeholder="Enter Pincode"  value="<?php
                                        if ($pincode1) {
                                            echo $pincode1;
                                        }
                                        ?>">
                                    </fieldset>
                                    <?php ?>
                                    <fieldset class="full-width">
                                        <label>Postal Address:<span class="red">*</span></label>
                                        <textarea name="address" id="address" tabindex="5" placeholder="Enter Address" rows="5" cols="40" style="resize:none"/><?php
                                        if ($address1) {
                                            echo $address1;
                                        }
                                        ?></textarea>
                                        <?php echo form_error('address'); ?>
                                    </fieldset>
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" tabindex="6" name="next" value="Next">
                                    </fieldset>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <?php echo $footer; ?>
            </footer>
            <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


            
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#country').on('change', function () {
                        var countryID = $(this).val();
                        if (countryID) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "freelancer_hire/ajax_data"; ?>',
                                data: 'country_id=' + countryID,
                                success: function (html) {
                                    $('#state').html(html);
                                    $('#city').html('<option value="">Select state first</option>');
                                }
                            });
                        } else {
                            $('#state').html('<option value="">Select country first</option>');
                            $('#city').html('<option value="">Select state first</option>');
                        }
                    });

                    $('#state').on('change', function () {
                        var stateID = $(this).val();
                        if (stateID) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "freelancer_hire/ajax_data"; ?>',
                                data: 'state_id=' + stateID,
                                success: function (html) {
                                    $('#city').html(html);
                                }
                            });
                        } else {
                            $('#city').html('<option value="">Select state first</option>');
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function ($) {
                    // site preloader -- also uncomment the div in the header and the css style for #preloader
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
            </script>
            <script>
                var data = <?php echo json_encode($demo); ?>;
                $(function () {
                    $("#tags").autocomplete({
                        source: function (request, response) {
                            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                            response($.grep(data, function (item) {
                                return matcher.test(item.label);
                            }));
                        },
                        minLength: 1,
                        select: function (event, ui) {
                            event.preventDefault();
                            $("#tags").val(ui.item.label);
                            $("#selected-tag").val(ui.item.label);
                            // window.location.href = ui.item.value;
                        }
                        ,
                        focus: function (event, ui) {
                            event.preventDefault();
                            $("#tags").val(ui.item.label);
                        }
                    });
                });
            </script>
            <script>
                var data1 = <?php echo json_encode($city_data); ?>;
                $(function () {
                    $("#searchplace").autocomplete({
                        source: function (request, response) {
                            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                            response($.grep(data1, function (item) {
                                return matcher.test(item.label);
                            }));
                        },
                        minLength: 1,
                        select: function (event, ui) {
                            event.preventDefault();
                            $("#searchplace").val(ui.item.label);
                            $("#selected-tag").val(ui.item.label);
                            // window.location.href = ui.item.value;
                        }
                        ,
                        focus: function (event, ui) {
                            event.preventDefault();
                            $("#searchplace").val(ui.item.label);
                        }
                    });
                });

            </script>
            <script type="text/javascript">
                function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return false;
                    }
                }
            </script>
            <script type="text/javascript">
                //validation for edit email formate form
                jQuery.validator.addMethod("noSpace", function (value, element) {
                    return value == '' || value.trim().length != 0;
                }, "No space please and don't leave it empty");

                $.validator.addMethod("regx", function (value, element, regexpr) {
                    return regexpr.test(value);
                }, "Only space, only number and only specila characters are not allow");

                $(document).ready(function () {

                    $("#address_info").validate({
                        rules: {
                            country: {
                                required: true,
                            },
                            state: {
                                required: true,
                            },
                            address: {
                                required: true,
                                regx: /^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]*$/,
                            }
                        },

                        messages: {
                            country: {
                                required: "Country Is Required.",
                            },

                            state: {
                                required: "State Is Required.",
                            },
                            address: {
                                required: "Address Is Required.",
                            },
                        },

                    });
                });
            </script>
            <script type="text/javascript">
                $(".alert").delay(3200).fadeOut(300);
            </script>
        </body>
    </div>
</html>