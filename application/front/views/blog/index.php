<!DOCTYPE html>
<?php

if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
    // $date = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
    header("HTTP/1.1 304 Not Modified");
    exit();
}

$format = 'D, d M Y H:i:s \G\M\T';
$now = time();

$date = gmdate($format, $now);
header('Date: '.$date);
header('Last-Modified: '.$date);

$date = gmdate($format, $now+30);
header('Expires: '.$date);

//header('Cache-Control: public, max-age=30');

?>
<html class="blog_cl" lang="en">
    <head>
        <title>Official Blog for Regular Updates, News and Sharing knowledge - Aileensoul</title>
        <meta name="description" content="Our Aileensoul official blog will describe our free service and related news, tips and tricks - stay tuned." />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png?ver=' . time()); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php
        if ($_SERVER['HTTP_HOST'] != "localhost") {
            ?>
            
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-91486853-1', 'auto');
                ga('send', 'pageview');

            </script>
            <meta name="msvalidate.01" content="41CAD663DA32C530223EE3B5338EC79E" />
            <?php
        }
        ?>
            <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />

            <?php if (IS_OUTSIDE_JS_MINIFY == '0'){?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <?php }else{?>
        <script async src="//pagead2.googlesyndication.com/pagead/js_min/adsbygoogle.js"></script>

        <?php }?>
        <script>
                (adsbygoogle = window.adsbygoogle || []).push({
                    google_ad_client: "ca-pub-6060111582812113",
                    enable_page_level_ads: true
                });
        </script>
        <style>
            footer > .container{border:1px solid transparent!important;}
            .footer{border:1px solid #d9d9d9;}
        </style>
        <?php
        foreach ($blog_detail as $blog) {
            ?>
            <!-- Open Graph data -->
            <meta property="og:title" content="<?php echo $blog['title']; ?>" />
            <meta  property="og:type" content="Blog" />
            <meta  property="og:image" content="<?php echo base_url($this->config->item('blog_main_upload_path') . $blog['image'] . '?ver=' . time()) ?>" />
            <meta  property="og:description" content="<?php echo $blog['meta_description']; ?>" />
            <meta  property="og:url" content="<?php echo base_url('blog/' . $blog['blog_slug']) ?>" />
            <meta property="og:image:width" content="620" />
            <meta property="og:image:height" content="541" />
            <meta property="fb:app_id" content="825714887566997" />

            <!-- for twitter -->
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:site" content="<?php base_url('blog/' . $blog['blog_slug']) ?>">
            <meta name="twitter:title" content="<?php $blog['title']; ?>">
            <meta name="twitter:description" content="<?php $blog['meta_description']; ?>">
            <meta name="twitter:creator" content="By Aileensoul">
            <meta name="twitter:image" content="http://placekitten.com/250/250">
            <meta name="twitter:domain" content="<?php base_url('blog/' . $blog['blog_slug']) ?>">
            <?php
        }
        ?>

         <?php if (IS_OUTSIDE_CSS_MINIFY == '0'){?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/blog.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/common-style.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-main.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?ver=' . time()); ?>">

        <?php }else{?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/blog.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/common-style.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/font-awesome.min.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/style-main.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/style.css?ver=' . time()); ?>">

        <?php }?>

        <?php if (IS_OUTSIDE_JS_MINIFY == '0'){?>
        <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js?ver=' . time()); ?>" ></script>

        <?php }else{?>
        <script src="<?php echo base_url('assets/js_min/jquery-3.2.1.min.js?ver=' . time()); ?>" ></script>

        <?php }?>
    </head>
    <body class="blog">
        <div class="main-inner">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-3">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/logo-name.png?ver='.time()) ?>" alt="logo"></a>
                        </div>
                        <div class="col-md-8 col-sm-9" style="padding-top: 5px;">
                            <div class="btn-right pull-right">
                                <?php if (!$this->session->userdata('aileenuser')) { ?>
                                    <a href="<?php echo base_url('login'); ?>" class="btn2">Login</a>
                                    <a href="<?php echo base_url('registration'); ?>" class="btn3">Create an account</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="blog_header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 col-xs-3 mob-zindex">

                            <div class="logo pl20">
                                <?php
                                if ($this->input->get('q') || $this->uri->segment(2) == 'popular' || $this->uri->segment(2) == 'tag') {
                                    ?>
                                    <a href="<?php echo base_url('blog'); ?>">
                                        <h3  style="color: #1b8ab9;">Blog</h3>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="javascript:void(0)">
                                        <h3  style="color: #1b8ab9;">Blog</h3>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-7 col-xs-9 header-left-menu">
                            <div class="main-menu-right">
                                <ul class="">
                                    <?php foreach ($blog_category as $category) { ?>
                                        <li class="category">
                                            <div id="category_<?php echo $cateory['id']; ?>"  onclick="return category_data(<?php echo $category['id']; ?>);">
                                                <?php echo $category['name']; ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section>
                <div class="col-md-12 hidden-md hidden-lg pt20">
                    <div class="blog_search">
                        <div>
                            <div class="searc_w"><input type="text" name="Search blog post" placeholder="Search Blog Post"></div>
                            <div class="butn_w"><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-mid-section user-midd-section">
                    <div class="container">
                        <div class="row">
                            <div class="blog_post_outer col-md-9 col-sm-8 pr0">
                                <?php
                                if ($this->input->get('q')) {
                                    ?>
                                    <div class="blog-tag">
                                        <div class="tag-line"><span>Search results for</span> <?php echo $search_keyword; ?></div>
                                    </div>
                                    <?php
                                }//if end  
                                if ($this->uri->segment(2) == 'tag') {
                                    ?>
                                    <div class="blog-tag">
                                        <div class="tag-line"><span>Tag:</span> <?php echo $search_keyword; ?></div>
                                    </div>
                                    <?php
                                }//if end  

                                if (count($blog_detail) == 0) {

                                    if ($this->input->get('q') || $this->uri->segment(2) == 'tag') {
                                        ?>
                                        <div class="job-saved-box">
                                            <div class="blog-tag" style="margin-bottom: 0px;">

                                            </div>
                                            <div class="contact-frnd-post">
                                                <div class="text-center rio">
                                                    <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                                                    <p style="margin-left:4%;text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                                                    <ul>
                                                        <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    if ($this->uri->segment(3) == 'popular') {
                                        echo "Not Any Popular Blog";
                                    }
                                }//if end
                                else {

                                    //    foreach ($blog_detail as $blog) {
                                    ?>
                                    <div class="job-contact-frnd">

                                    </div>
                                    <!--<li><a class="fbk" url_encode="http%3A%2F%2Flocalhost%2Faileensoul-new%2Fblog%2Fall-about-aileensoul" url="http://localhost/aileensoul-new/blog/all-about-aileensoul" title="Facebook" summary="%22%3Cp+xss%3D%22removed%22%3EAt+one+point+in+the+yester-years%2C+people+worked+jobs+to+feed+their+family+and+themselves.+In+this+day+and+age%2C+people+work+not+only+for+a+steady+source+of+income%2C+but+also+for+a+sense+of+fulfilment+that+one+gets+from+doing+something+that+they+love.+Thus%2C+it+is+important+for+an+individual%E2%80%99s+work-+be+it+a+job+or+a+business+or+a+skill+that+they+practice-+to+align+with+their+interests+and+mainly%2C+their+passion.+If+not%2C+one+ends+up+in+a+daily+monotonous+struggle+that+does+leave+them+satisfied%2C+but+not+inherently+happy.%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3E%C2%A0%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3EIt+might+not+always+be+the+easiest+task+to+land+that+perfect+job+for+yourself.+What+is+needed+is+a+single+roof+where+all+your+job-related+needs+are+satisfactorily+met.+Aileensoul+is+a+completely+free+platform+for+career-related+services%2C+such+as+hiring%2C+freelancing%2C+networking+and+much+more.+It+is+a+portal+that+seeks+to+connect+recruiters+to+prospective+employees.+It+also+helps+businesses+connect+with+each+other%2C+as+well+as+artists+find+a+platform+for+their+talents.+Simply+put%2C+anyone+with+any+requirement+related+to+the+job+or+business+sector+is+sure+to+find+a+solution+on+Aileensoul.%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3E%C2%A0%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3EThere+are+many+problems+encountered+by+both+employers+and+employees+while+looking+for+a+perfect+fit+for+themselves.+In+the+age+of+technology%2C+there+is+an+overwhelming+amount+of+job+portals%2C+freelancing+sites+and+such+that+make+it+difficult+for+an+individual+to+single+out+the+best+one.+There+is+the+added+hassle+of+creating+and+maintaining+separate+accounts+for+all+these+sites.+Moreover%2C+there+has+been+an+alarming+increase+in+the+number+of+start-ups+in+the+past+decade.+Most+of+these+business+face+the+problem+of+being+unable+to+recruit+capable%2C+trustworthy+employees%2C+owing+to+the+newness+of+their+business.+There+are+artists+that+usually+work+on+project+basis%2C+who+find+it+difficult+to+find+a+decent+job+or+project.+Aileensoul+seeks+to+provide+solutions+to+all+of+these+problems.+On+this+portal%2C+everyone+from+start-up+companies+to+multinational+corporations+can+find+suitable+recruitment.+Freelancers+and+artists+can+find+a+platform+for+themselves+on+Aileensoul+that+truly+values+their+talents.%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3E%C2%A0%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3EOn+Aileensoul%2C+job+seekers+can+easily+search+for+their+desired+profile%2C+shortlist+jobs+that+pique+their+interest%2C+and+then+apply+for+the+same.+They+can+also+connect+to+the+recruiters%E2%80%99+profile+to+find+out+more+about+the+same.+Aileensoul+also+allows+businesses+to+connect+with+one+another%2C+update+information+and+indulge+in+contact+networking.+On+this+portal%2C+artists+can+upload+their+PDF+files%2C+videos%2C+images%2C+etc+so+as+to+find+the+right+audience+for+their+talent.+Freelancers+can+connect+to+agents+and+other+mediums+to+find+the+perfect+project+that+meets+their+skill+set.%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3E%C2%A0%3C%2Fp%3E%0D%0A%0D%0A%3Cp+xss%3D%22removed%22%3EAileensoul+is+a+unified+platform+for+every+career-related+need+that+an+individual+may+have.+It+provides+solutions+for+every+sector+of+the+job+market%2C+from+job+recruiters+to+%3Ca+href%3D%22https%3A%2F%2Fwww.aileensoul.com%22+target%3D%22_blank%22%3Ejob+seekers%3C%2Fa%3E+to+artists.+Aileensoul%E2%80%99s+mission+is+to+help+people+discover+and+rediscover+their+perfect+career+and+to+help+them+grow+in+their+chosen+career.+It+also+seeks+to+end+unemployment+and+by+extension%2C+poverty%2C+by+setting+people+up+with+their+desired+jobs+or+finding+them+projects+that+not+only+provides+a+source+of+income%2C+but+also+instils+them+with+a+sense+of+contentment.%3C%2Fp%3E%0D%0A%22" image="http%3A%2F%2Flocalhost%2Faileensoul-new%2Fuploads%2Fblog%2Fmain%2Fbanner_12.jpg"> -->
                                    <!--                                                                                <span class="social_fb"></span>
                                                                                                                </a>
                                                                                                            </li>-->
                                    <ul class="load-more-blog">
                                        <li class="loadbutton"></li>
                                        <li class="loadcatbutton"></li>
                                    </ul>
                                <?php }
                                ?>
                            </div>

                            <div class="col-md-3 col-sm-4 hidden-xs">
                                <div class="blog_search">
                                    <h6> Blog Search </h6>
                                    <div>

                                        <form action="<?php echo base_url('blog') ?>" method="get" autocomplete="off">
                                            <div class="searc_w"><input type="text" name="q" id="q" placeholder="Search Blog Post"></div>
                                            <button type="submit" class="butn_w" onclick="return checkvalue();"><i class="fa fa-search"></i></button> 

                                            <?php //echo form_close(); ?>
										</form>
                                    </div>
                                </div>
                                <div class="blog_latest_post">
                                    <h3>Latest Post</h3>
                                    <?php
                                    foreach ($blog_last as $blog) {
                                        ?>
                                        <div class="latest_post_posts">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo base_url('blog/' . $blog['blog_slug']) ?>"> 
                                                        <div class="post_inside_data">
                                                            <div class="post_latest_left">
                                                                <div class="lateaqt_post_img">
                                                                    <img src="<?php echo base_url($this->config->item('blog_main_upload_path') . $blog['image']) ?>" alt="<?php echo $blog['image']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="post_latest_right">
                                                                <div class="desc_post">
                                                                    <span class="rifght_fname"> <?php echo $blog['title']; ?> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!--latest_post_posts end -->
                                        <?php
                                    }//for loop end
                                    ?>
                                </div>

                                
                            </div>


                        </div>
                    </div>
                </div>
       
    </section>
    <?php
    echo $login_footer
    ?>
</div>

<script>
                                        var base_url = '<?php echo base_url(); ?>';
</script>
<script>
//AJAX DATA LOAD BY LAZZY LOADER START
    $(document).ready(function () {
        blog_post();

    });

    function category_data(catid, pagenum) {
        $('.job-contact-frnd').html("");
        $('.loadbutton').html("");
        cat_post(catid, pagenum);
    }

    $('.loadcatbutton').click(function () {
        var pagenum = parseInt($(".page_number:last").val()) + 1;
        var catid = $(".catid").val();
        cat_post(catid, pagenum);
    });

    var isProcessing = false;
    function cat_post(catid, pagenum) {
        if (isProcessing) {
            /*
             *This won't go past this condition while
             *isProcessing is true.
             *You could even display a message.
             **/
            return;
        }
        isProcessing = true;
        $.ajax({
            type: 'POST',
            url: base_url + "blog/cat_ajax?page=" + pagenum + "&cateid=" + catid,
            data: {total_record: $("#total_record").val()},
            dataType: "json",
            beforeSend: function () {

            },
            complete: function () {
                $('#loader').hide();
            },
            success: function (data) {
                $('.loader').remove();
                $('.job-contact-frnd').append(data.blog_data);
                $('.loadcatbutton').html(data.load_msg)
                // second header class add for scroll
                var nb = $('.post-design-box').length;
                if (nb == 0) {
                    $("#dropdownclass").addClass("no-post-h2");
                } else {
                    $("#dropdownclass").removeClass("no-post-h2");
                }
                isProcessing = false;
            }
        });
    }


    $('.loadbutton').click(function () {
        var pagenum = parseInt($(".page_number:last").val()) + 1;
        blog_post(pagenum);
    });
    var isProcessing = false;
    function blog_post(pagenum) {
        if (isProcessing) {
            /*
             *This won't go past this condition while
             *isProcessing is true.
             *You could even display a message.
             **/
            return;
        }
        isProcessing = true;
        $.ajax({
            type: 'POST',
            url: base_url + "blog/blog_ajax?page=" + pagenum,
            data: {total_record: $("#total_record").val()},
            dataType: "json",
            beforeSend: function () {

            },
            complete: function () {
                $('#loader').hide();
            },
            success: function (data) {
                $('.loader').remove();
                $('.job-contact-frnd').append(data.blog_data);
                $('.loadbutton').html(data.load_msg)
                // second header class add for scroll
                var nb = $('.post-design-box').length;
                if (nb == 0) {
                    $("#dropdownclass").addClass("no-post-h2");
                } else {
                    $("#dropdownclass").removeClass("no-post-h2");
                }
                isProcessing = false;
            }
        });
    }
//AJAX DATA LOAD BY LAZZY LOADER END
</script>
 <?php if (IS_OUTSIDE_JS_MINIFY == '0'){?>
<script src="<?php echo base_url('assets/js/webpage/blog/blog.js?ver=' . time()); ?>"></script>
<?php }else{?>
<script src="<?php echo base_url('assets/js_min/webpage/blog/blog.js?ver=' . time()); ?>"></script>
<?php }?>
</body>
</html>
