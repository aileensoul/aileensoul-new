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
    <body class="page-container-bg-solid page-boxed pushmenu-push user-list">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <div class="container" id="paddingtop_fixed">
            </div>
            <div class="user-midd-section bui_art_left_box">
                <div class="container art_container padding-360">
                    <div class="">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt" >
                            <div class="left_fixed">
                                <?php echo $business_left ?>
                            </div>
                            <div class="tablate-potrat-add">
                                <div class="fw text-center pt10">
                                    <script type="text/javascript">
                                        (function () {
                                            if (window.CHITIKA === undefined) {
                                                window.CHITIKA = {'units': []};
                                            }
                                            ;
                                            var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                            var placement_id = window.CHITIKA.units.length;
                                            window.CHITIKA.units.push(unit);
                                            document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                        }());
                                    </script>
                                    <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                </div>
                            </div>
                        </div>

                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="">  
                                <div class="right_side_posrt fl"> 
                                    <div class="common-form">
                                        <div class="job-saved-box">
                                            <h3>User list</h3>
                                            <div class="contact-frnd-post">
                                                <div class="mob-add">
                                                    <div class="fw text-center pt10 pb10">
                                                        <script type="text/javascript">
                                                            (function () {
                                                                if (window.CHITIKA === undefined) {
                                                                    window.CHITIKA = {'units': []};
                                                                }
                                                                ;
                                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                                var placement_id = window.CHITIKA.units.length;
                                                                window.CHITIKA.units.push(unit);
                                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                                            }());
                                                        </script>
                                                        <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                                    </div>
                                                </div>
                                                <!-- AJAX DATA... -->
                                            </div>
                                            <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                            <div class="col-md-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 

                            <div class="fw text-center">
                                <script type="text/javascript">
                                                                            (function () {
                                                                                if (window.CHITIKA === undefined) {
                                                                                    window.CHITIKA = {'units': []};
                                                                                }
                                                                                ;
                                                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                                                var placement_id = window.CHITIKA.units.length;
                                                                                window.CHITIKA.units.push(unit);
                                                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                                                            }());
                                </script>
                                <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                <div class="fw pt10">
                                    <a href="http://www.chitika.com/publishers/apply?refid=aileensoul"><img src="http://images.chitika.net/ref_banners/300x250_hidden_ad.png" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="tablate-add">

                            <script type="text/javascript">
                                                                            (function () {
                                                                                if (window.CHITIKA === undefined) {
                                                                                    window.CHITIKA = {'units': []};
                                                                                }
                                                                                ;
                                                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 160, "height": 600, "sid": "Chitika Default"};
                                                                                var placement_id = window.CHITIKA.units.length;
                                                                                window.CHITIKA.units.push(unit);
                                                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                                                            }());
                            </script>
                            <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="6">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- script for skill textbox automatic end (option 2)-->
        <script src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <!-- script for business autofill -->
        <script>
                                                                            var base_url = '<?php echo base_url(); ?>';
        </script>
        <?php if (IS_BUSINESS_JS_MINIFY == '0') { ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/userlist.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
        <?php } else { ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/userlist.min.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/business-profile/common.min.js?ver=' . time()); ?>"></script>
        <?php } ?>
    </body>
</html>