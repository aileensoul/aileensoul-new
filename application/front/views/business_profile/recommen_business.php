<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url('assets/css/fileinput.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/js/themes/explorer/theme.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('assets/js/plugins/sortable.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/fileinput.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/themes/explorer/theme.js?ver=' . time()) ?>" type="text/javascript"></script>
        <?php
        if (IS_CSS_MINIFY == '0') {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/business.css?ver=' . time()); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/business_profile/business-common.min.css?ver=' . time()); ?>">
        <?php } ?>
        <script>
            $(function () {
                var showTotalChar = 200, showChar = "ReadMore", hideChar = "";
                $('.showmore').each(function () {
                    var content = $(this).html();
                    if (content.length > showTotalChar) {
                        var con = content.substr(0, showTotalChar);
                        var hcon = content.substr(showTotalChar, content.length - showTotalChar);
                        var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
                        $(this).html(txt);
                    }
                });
                $(".showmoretxt").click(function () {
                    if ($(this).hasClass("sample")) {
                        $(this).removeClass("sample");
                        $(this).text(showChar);
                    } else {
                        $(this).addClass("sample");
                        $(this).text(hideChar);
                    }
                    $(this).parent().prev().toggle();
                    $(this).prev().toggle();
                    return false;
                });
            });
        </script>   
        <script>
            $(document).ready(function ()
            {
                /* Uploading Profile BackGround Image */
                $('body').on('change', '#bgphotoimg', function ()
                {
                    $("#bgimageform").ajaxForm({
                        target: '#timelineBackground',
                        beforeSubmit: function () {
                        }
                        ,
                        success: function () {
                            $("#timelineShade").hide();
                            $("#bgimageform").hide();
                        }
                        ,
                        error: function () {
                        }
                    }).submit();
                });
                /* Banner position drag */
                $("body").on('mouseover', '.headerimage', function ()
                {
                    var y1 = $('#timelineBackground').height();
                    var y2 = $('.headerimage').height();
                    $(this).draggable({
                        scroll: false,
                        axis: "y",
                        drag: function (event, ui) {
                            if (ui.position.top >= 0)
                            {
                                ui.position.top = 0;
                            } else if (ui.position.top <= y1 - y2)
                            {
                                ui.position.top = y1 - y2;
                            }
                        }
                        ,
                        stop: function (event, ui)
                        {
                        }
                    });
                });
                /* Bannert Position Save*/
                $("body").on('click', '.bgSave', function ()
                {
                    var id = $(this).attr("id");
                    var p = $("#timelineBGload").attr("style");
                    var Y = p.split("top:");
                    var Z = Y[1].split(";");
                    var dataString = 'position=' + Z[0];
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('business_profile/image_saveBG_ajax'); ?>",
                        data: dataString,
                        cache: false,
                        beforeSend: function () {
                        }
                        ,
                        success: function (html)
                        {
                            if (html)
                            {
                                window.location.reload();
                                $(".bgImage").fadeOut('slow');
                                $(".bgSave").fadeOut('slow');
                                $("#timelineShade").fadeIn("slow");
                                $("#timelineBGload").removeClass("headerimage");
                                $("#timelineBGload").css({
                                    'margin-top': html});
                                return false;
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <!-- START HEADER -->
        <?php echo $header; ?>
        <!-- END HEADER -->

        <?php
        if ($is_business) {
            echo $business_header2_border;
        }
        ?>
        <section class="search-page">
            <div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
                <div class="container">
                    <div class="">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="">
                                <?php echo $business_left; ?>
                            </div>
                        </div>
                        <div class="col-md-6 search-post-box col-sm-12 fixed_middle_side  custom-right-business animated fadeInUp" style="height: 150%;">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3 style="background-color: #fff; text-align: center; color: #003; border-bottom: 1px solid #d9d9d9;">
                                        Search result of 
                                        <?php
                                        if ($keyword != "" && $keyword1 == "") {
                                            echo '"' . trim($keyword, ',') . '"';
                                        } elseif ($keyword == "" && $keyword1 != "") {
                                            echo '"' . trim($keyword1, ',') . '"';
                                        } else {
                                            echo '"' . trim($keyword, ',') . '"';
                                            echo " and ";
                                            echo '"' . trim($keyword1, ',') . '"';
                                        }
                                        ?>
                                    </h3>
                                    <div class="job-contact-frnd">
                                        <!-- AJAX DATA... -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Bid-modal  -->
<div class="modal fade message-box biderror" id="bidmodal" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;
            </button>       
            <div class="modal-body">
                <span class="mes"></span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="likeusermodal" role="dialog">
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
<footer>
    <?php echo $footer ?>
</footer>
<!--<script src="<?php //echo base_url('assets/js/jquery.wallform.js?ver=' . time());   ?>"></script>-->
<script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.highlite.js?ver=' . time()); ?>">
</script>
<script>
    $('#content').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
</script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var keyword = '<?php echo $keyword; ?>';
    var keyword1 = '<?php echo $keyword1; ?>';
</script>
<?php if (IS_JS_MINIFY == '0') { ?>
    <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/search.js?ver=' . time()); ?>"></script>
    <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
<?php } else { ?>
    <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/search.min.js?ver=' . time()); ?>"></script>
    <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/business-profile/common.min.js?ver=' . time()); ?>"></script>
<?php } ?>
</body>
</html>
