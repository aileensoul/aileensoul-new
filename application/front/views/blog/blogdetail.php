<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<html>
    <head>


        <title>Find the Best Jobs, Hiring, Employment and Freelance | Aileensoul.com</title>
        <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />
        
<!--Need to add following TAG in Header.-->

<link rel="canonical" href="https://www.aileensoul.com" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="description" content="Aileensoul provides best opportunity where you can Hire, Recruit, Freelance, Busines and find or search jobs of your preference in your required fiel." />
<meta name="keywords" content="Hire Freelancers, Freelance Jobs Online, Find Freelance Work, Freelance Jobs, Get Online Work, online freelance jobs, freelance websites, freelance portal, online freelance work, freelance job sites, freelance consulting jobs, hire freelancers online, best freelancing sites, online writing jobs for beginners, top freelance websites, freelance marketplace, jobs, Job search, job vacancies, Job Opportunities in India, jobs in India, job openings, Jobs Recruitment, Apply For Jobs, Find the right Job, online job applications, apply for jobs online, online job search, online jobs india, job posting sites, job seeking sites, job search websites, job websites in india, job listing websites, jobs hiring, how to find a job, employment agency, employment websites, employment vacancies, application for employment, employment in india, searching for a job, job search companies, job search in india, best jobs in india, job agency, job placement agencies, how to apply for a job, jobs for freshers, job vacancies for freshers, recruitment agencies, employment agencies, job recruitment, hiring agencies, hiring websites, recruitment sites, corporate recruiter, career recruitment, online recruitment, executive recruiters, job recruiting companies, online job recruitment, job recruitment agencies, it, recruitment agencies, recruitment websites, executive search firms, sales recruitment agencies, top executive search firms, recruitment services, technical recruiter, recruitment services, job recruitment agency, recruitment career" />
<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->

<!-- Add following GoogleAnalytics tracking code in Header.-->

<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91486853-1', 'auto');
  ga('send', 'pageview');

</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6060111582812113",
    enable_page_level_ads: true
  });
</script> -->

<!-- seo changes end -->

<!-- seo changes end -->


        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">  -->

      

        
    </head>
<!--- header end -->
<div class="container">
    <div class="project-top-patination">
        <ul>
         <li><span>Blog</span></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="blog_tab">
            <div class="col-sm-9 blog_left">
                <div class="one_blog">
                    <h2> <?php echo $title;?></h2>
                    <ul class="entry-meta">
                                    <li class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('M d, Y', strtotime($date));?></li>
                                    <li class="entry-author"><i class="fa fa-female" aria-hidden="true"></i><a rel="author external" title="Visit Dhara Dhanesha’s website" href="javascript:void"><?php echo $author;?></a></li>
                                    <li class="entry-catagory"><i class="fa fa-comment" aria-hidden="true"></i><a rel="category tag" href="javascript:void">

    <?php echo count($this->blog_model->Blogcount($blogid)) . '  '; ?>  Comment</a></li>
                                    
                    </ul>
              <img src="<?php echo BLOG_IMAGE.$image; ?>" height="50" width="50" alt="Smiley face"  title="<?php echo $image_title?>" content="<?php echo $image_description?>">
                    <p><?php echo $description;?></p>
                    <!-- blog detail end -->
<?php
        $form_attr = array('id' => 'contactform', 'class' => 'form-horizontal row-border' , 'enctype' => 'multipart/form-data');
        echo form_open_multipart('blog/add_blog', $form_attr);
?>
<!-- submiit form start -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert fade in alert-success">
                <i class="icon-remove close" data-dismiss="alert"></i>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } elseif ($this->session->flashdata('captcha_error')) { ?>  
        <div class="alert fade in alert-danger" >
            <i class="icon-remove close" data-dismiss="alert"></i>
            <?php echo $this->session->flashdata('captcha_error'); ?>
        </div>
        <?php } elseif ($this->session->flashdata('error')) { ?>  
            <div class="alert fade in alert-danger" >
                <i class="icon-remove close" data-dismiss="alert"></i>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

<div class="container">
    <div class="row">

    <div class="col-sm-12 comment">
     <h5>Leave a Comment </h5>
                                            <p> <?php echo count($this->blog_model->Blogcount($blogid)) . '  '; ?>  Comment</p>
                                        </div>

        <div class="col-sm-6">
            
            <div class="contact_form">
            <span>Your Name (*)</span>
                <input type="text" name="contactname" placeholder="Name"/>
            </div>
            
            <div class="contact_form">
            <span>Your Email (*)</span>
                <input type="text" name="contactemail" placeholder="E-mail" />
            </div>

            <input type="hidden" name="blogid" value="<?php echo $blogid; ?>">
            
            <div class="contact_form">
            <span>Your Message</span>
                <textarea name="contactmessage"></textarea>
            </div>
         
            <div class="g-recaptcha" data-sitekey="6LcFcxEUAAAAAPbR5BAmpthQtNXZ6QTrUvuCRd-V"></div>
            
            <div class="col-sm-3">
            <div class="submit_button">
            <?php echo form_button(array('class' => "btn btn-primary", 'type' => "submit", 'name' => "submitbtn", 'id' => "contactbtn", 'content' => "SUBMIT")); ?>
            </div>
            </div>
            
            <div class="col-sm-5">
            <div class="mandatory">
            <span>Fields marked with * are mandatory.</span>
            </div>
            </div>
            
        </div>
    </div>
</div>
</form>
<!-- submit form end -->  
<div class="col-sm-12 comm even">
<?php $reviewdata = $this->blog_model->Blogcount($blogid);

foreach($reviewdata as $review_key => $review_val){?>
                                <div class="comments">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <div class="comm_con">
                                        <h5><?php echo $review_val->user_name; ?></h5>
                                        <p><?php echo $review_val->review_comment; ?>.</p>
                                        <ul>
                                           
                                            <li><?php echo date('M d, Y', strtotime($review_val->created_date)); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <?php } ?>
                                
                            </div>
                
                </div>
                

                
            </div>
          
            <ul class="l_imges">
               
                  <?php foreach($blogolddata as $old_key=>$old_value){ ?>
                <li><a href="<?php echo base_url('blog/blogdetail/' . $old_value->blog_id); ?>"><img src="<?php echo BLOG_IMAGE.$old_value->blog_image; ?>" height="50" width="50" alt="Smiley face"  title="<?php echo $old_value->image_title?>" content="<?php echo $old_value->image_description?>"><p><?php echo $old_value->title; ?></p></a></li>
                  <?php }  ?>
                    
                </ul>
            
           
        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>