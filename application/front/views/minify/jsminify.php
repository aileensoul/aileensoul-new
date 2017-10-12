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
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/business-info.min.js');
// BUSINESS_INFO END 

// BUSINESS_CONTACT START   
$bus_info = array('webpage/business-profile/contacts.js',
    '../js_min/webpage/business-profile/common.min.js',
);

$this->minify->js($bus_info);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/contacts.min.js');
// BUSINESS_CONTACT END 

// BUSINESS_SEARCH_LOGIN START   
$bus_info = array('webpage/business-profile/contacts.js',
    '../js_min/webpage/business-profile/common.min.js',
);

$this->minify->js($bus_info);
echo $this->minify->deploy_js(FALSE, 'webpage/business-profile/bus_search_login.min.js');


//$this->minify->js(array('helpers.js', 'jqModal.js'));
//echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');
?>
<div id="container">
    <h1>Welcome to CodeIgniter Minify library!</h1>


    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>