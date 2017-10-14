<?php



// BUSINESS_CONTACT FOOTER CROPPI BOOTSTRAP VALIDATE  
$bus_contact_footer = array(
    '../js_min/croppie.min.js',
    'bootstrap.min.js',
    'jquery.validate.min.js',
);

$this->minify->js($bus_contact_footer);
echo $this->minify->deploy_js(FALSE, 'croppie_bootstrap_validate.min.js');

//BOOTSTARP AND VALIDATE MIN   
$bootstrap_valdidate = array(
    'bootstrap.min.js',
    'jquery.validate.min.js',
);

$this->minify->js($bootstrap_valdidate);
echo $this->minify->deploy_js(FALSE, 'bootstrap_validate.min.js');


// CROPPIE START   
$croppie = array('croppie.js',
);

$this->minify->js($croppie);
echo $this->minify->deploy_js(FALSE, 'croppie.min.js');

//RECRUITER CHNAGES START

// RECRUITER BASIC INFO
$rec_basic_info = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/basic_info.js',
);
$this->minify->js($rec_basic_info);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_basic_info.min.js');


// RECRUITER COMPANY INFO
$rec_comp_info = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/company_info.js',
);
$this->minify->js($rec_comp_info);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_company_info.min.js');

// RECRUITER ADD POST
$rec_add_post = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/add_post.js',
);
$this->minify->js($rec_add_post);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_add_post.min.js');

// RECRUITER EDIT POST
$rec_edit_post = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/edit_post.js',
);
$this->minify->js($rec_edit_post);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_edit_post.min.js');


// RECRUITER POST
$rec_post = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/rec_post.js',
);
$this->minify->js($rec_post);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_post.min.js');

// RECRUITER PROFILE
$rec_profile = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/rec_profile.js',
);
$this->minify->js($rec_profile);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_profile.min.js');

// RECRUITER SEARCH LOGIN
$rec_search_login = array(
    'webpage/recruiter/rec_search_login.js',
);
$this->minify->js($rec_search_login);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_search_login.min.js');

// RECOMMEN CANDIDATE
$recommen_candidate = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/recommen_candidate.js',
);
$this->minify->js($recommen_candidate);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/recommen_candidate.min.js');

// RECOMMEN CANDIDATE1
$rec_search = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/rec_search.js',
);
$this->minify->js($rec_search);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_search.min.js');

// RECOMMEN CANDIDATE1
$rec_search = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/rec_search.js',
);
$this->minify->js($rec_search);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/rec_search.min.js');

// SAVED CANDIDATE
$save_candidate = array(
    'webpage/recruiter/search.js',
    'webpage/recruiter/saved_candidate.js',
);
$this->minify->js($save_candidate);
echo $this->minify->deploy_js(FALSE, 'webpage/recruiter/saved_candidate.min.js');

//VALIDATE BOOTSTRAP DROPDOWN
$val_crop_boot_drop = array(
    'jquery.validate.min.js',
    'bootstrap.min.js',
    'jquery.date-dropdowns.js',
);
$this->minify->js($val_boot_drop);
echo $this->minify->deploy_js(FALSE, 'val_boot_drop.min.js');

// CROPP VALIDATE BOOTSTRAP DROPDOWN
$val_crop_boot_drop = array(
    'jquery.validate.min.js',
    'croppie.js',
    'bootstrap.min.js',
    'jquery.date-dropdowns.js',
);
$this->minify->js($val_crop_boot_drop);
echo $this->minify->deploy_js(FALSE, 'val_crop_boot_drop.min.js');



//RECRUITER CHANGES END



//$this->minify->js(array('helpers.js', 'jqModal.js'));
//echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');
?>
<div id="container">
    <h1>Welcome to CodeIgniter Minify library!</h1>


    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>