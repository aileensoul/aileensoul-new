<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    </head>
    <div class="js">
        <body>
            <div id="preloader"></div>
            <?php echo $header; ?>
            <?php
            if ($freepostdata[0]['user_id'] && $freepostdata[0]['free_post_step'] == '7') {
                echo $freelancer_post_header2_border;
            }
            ?>
            <section>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        $userid = $this->session->userdata('aileenuser');

                        $contition_array = array('user_id' => $userid, 'status' => '1');
                        $freepostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        if ($freepostdata[0]['free_post_step'] == 7) {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3>You are updating your Freelancer Profile.</h3></div>
                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3>You are making your Freelancer Profile.</h3></div>
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
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_basic_information'); ?>">Basic Information</a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_address_information'); ?>">Address Information</a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_professional_information'); ?>">Professional Information</a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_rate'); ?>">Rate</a></li>

                                        <li <?php if ($this->uri->segment(1) == 'freelancer') { ?> class="active init" <?php } ?>><a href="#">Add Your Avability</a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '5') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer/freelancer_post_education'); ?>"> Education</a></li>		    
                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '6') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer/freelancer_post_portfolio'); ?>">Portfolio</a></li>
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
                                    <h3>Add Your Avability</h3>
                                    <?php echo form_open(base_url('freelancer/freelancer_post_avability_insert'), array('id' => 'freelancer_post_avability', 'name' => 'freelancer_post_avability', 'class' => 'clearfix')); ?>
                                    <?php
                                    $job_type = form_error('job_type');
                                    $work_hour = form_error('work_hour');
                                    ?>
                                    <fieldset class="col-md-4" <?php if ($inweek) { ?> class="error-msg" <?php } ?>>
                                        <label> Working As</label>
                                        <input type="radio" tabindex="1" autofocus name="job_type" id="job_type" value="Full Time" <?php
                                        if ($job_type1 == 'Full Time') {
                                            echo 'checked';
                                        }
                                        ?>>Full Time
                                        <input type="radio" tabindex="1" name="job_type" id="job_type" value="Part Time" <?php
                                        if ($job_type1 == 'Part Time') {
                                            echo 'checked';
                                        }
                                        ?>>Part Time
                                               <?php echo form_error('job_type'); ?>
                                    </fieldset>
                                    <fieldset class=""<?php if ($work_hour) { ?> class="error-msg" <?php } ?>>
                                        <label>Working hours per week:</label>
                                        <input type="text" name="work_hour" tabindex="2" placeholder="Enter working hour" value="<?php
                                        if ($work_hour1) {
                                            echo $work_hour1;
                                        }
                                        ?>">
                                               <?php echo form_error('work_hour'); ?>
                                    </fieldset>
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" name="next" value="Next" tabindex="3">
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
            <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
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

                //validation for edit email formate form

                $(document).ready(function () {

                    $("#freelancer_post_avability").validate({
                        rules: {
                            work_hour: {
                                required: false,
                                number: true,
                                max: 168
                            },
                        },
                        messages: {
                            work_hour: {
                                max: "Number should be between 0-168"
                            },
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                $(".alert").delay(3200).fadeOut(300);
            </script>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    // site preloader -- also uncomment the div in the header and the css style for #preloader
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
            </script>
            <script type="text/javascript">
                function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return  false;
                    }
                }
            </script> 
        </body>
    </div>
</html>