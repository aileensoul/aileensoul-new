
<?php

// COMMON HEAD CSS MINIFY START
$this->minify->css(array('common-style.css',
    'media.css',
    'animate.css',
    '1.10.3.jquery-ui.css',
    'header.css',
    'style.css',
    'font-awesome.min.css',
));
echo $this->minify->deploy_css(FALSE, 'common-header.min.css');
// COMMON HEAD CSS MINIFY END

//RECRUITER PROFILE CSS START

// REC COMMON HEADER FOR EVERY PAGE

$rec_comon_header = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_comon_header);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_common_header.min.css');

// RECRUITER PROFILE CSS END

?>
<div id="container">
    <h1>Welcome to CodeIgniter Minify library!</h1>


    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>