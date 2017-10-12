<?php


// BUSINESS_COMMON START   
$bus_info = array(
    'webpage/business-profile/common.js',
);
$this->minify->js($bus_info);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/common.min.js');
// BUSINESS_COMMON END 

// BUSINESS_INFO START   
$bus_info = array('webpage/business-profile/information.js',
    '../js_min/webpage/business-profile/common.min.js',
);

$this->minify->js($bus_info);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/information.min.js');
// BUSINESS_INFO END 

// BUSINESS_CONTACT START   
$bus_contact = array('webpage/business-profile/contacts.js',
    '../js_min/webpage/business-profile/common.min.js',
);

$this->minify->js($bus_contact);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/contacts.min.js');

// BUSINESS_CONTACT FOOTER   
$bus_contact_footer = array(
    '../js_min/croppie.min.js',
    'bootstrap.min.js',
    'jquery.validate.min.js',
);

$this->minify->js($bus_contact);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/bus_contacts_footer.min.js');

//BOOTSTARP AND VALIDATE MIN   
$bus_contact_footer = array(
    'bootstrap.min.js',
    'jquery.validate.min.js',
);

$this->minify->js($bus_contact);
echo $this->minify->deploy_js(FALSE, 'bootstrap_validate.min.js');


// BUSINESS_SEARCH_LOGIN START   
$bus_search = array('webpage/business-profile/contacts.js',
    '../js_min/webpage/business-profile/common.min.js',
);

$this->minify->js($bus_search);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/bus_search_login.min.js');

// BUSINESS_SEARCH_LOGIN HEADER START   
$bus_search_header = array('../dragdrop/js/plugins/sortable.js',
    'fileinput.js',
    '../dragdrop/themes/explorer/theme.js',
);

$this->minify->js($bus_search_header);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/bus_search_login_header.min.js');

// CROPPIE START   
$croppie = array('croppie.js',
);

$this->minify->js($croppie);
echo $this->minify->deploy_js(FALSE, 'croppie.min.js');

// CROPPIE START   
$croppie = array('croppie.js',
);

$this->minify->js($croppie);
echo $this->minify->deploy_js(FALSE, 'croppie.min.js');





//$this->minify->js(array('helpers.js', 'jqModal.js'));
//echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');
?>
<div id="container">
    <h1>Welcome to CodeIgniter Minify library!</h1>


    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>