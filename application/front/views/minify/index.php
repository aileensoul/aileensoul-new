
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

// REC ADD POST 
$rec_add_post = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_add_post);
echo $this->minify->deploy_css(FALSE, 'recruiter/add_post.min.css');

// REC COMAPNY INFORMATION 
$rec_comp_info = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_comp_info);
echo $this->minify->deploy_css(FALSE, 'recruiter/comapny_information.min.css');

// REC EDIT POST
$rec_edit_post = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_edit_post);
echo $this->minify->deploy_css(FALSE, 'recruiter/edit_post.min.css');

// REC BASIC INFORMATION
$rec_basic_info = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_basic_info);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_basic_information.min.css');

// REC POST
$rec_post = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_post);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_post.min.css');

// REC PROFILE
$rec_profile = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_profile);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_profile.min.css');

// REC SEARCH LOGIN
$rec_search_login = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_search_login);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_search_login.min.css');

// REC SEARCH LOGIN
$rec_search_login = array(
    '1.10.3.jquery-ui.css',
    'recruiter.css',
);
$this->minify->css($rec_search_login);
echo $this->minify->deploy_css(FALSE, 'recruiter/rec_search_login.min.css');


// RECRUITER PROFILE CSS END



//	//	$this->minify->js(array('helpers.js', 'jqModal.js'));
//echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');
?>
<div id="container">
    <h1>Welcome to CodeIgniter Minify library!</h1>


    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>