<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/



if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1'){

	 error_reporting(0);
}
else
{
	error_reporting(0);
}
  			

define('SITEPATH',$_SERVER['DOCUMENT_ROOT'].'/aileensoul/');
define('ARTISTICUPLOAD', SITEPATH.'uploads/art_images/');
define('USERUPLOAD', SITEPATH.'uploads/user_image/');


define('USERIMAGE', 'uploads/user_image/main/');
define('USERTHUMBIMAGE', 'uploads/user_image/thumbs/');

define('WHITEIMAGE', 'uploads/white.png');

define('USERBGIMAGE', 'uploads/user_bg/main/');
define('USERBGTHUMBIMAGE', 'uploads/user_bg/thumb/');

define('NOIMAGE', 'uploads/avatar.png');

define('NOBUSIMAGE', 'uploads/nobusimage.jpg');


//define name for uploads folder =>job_work_certificate
define('JOBWORKCERTIFICATE', 'uploads/job_work_certificate/');

//define name for uploads folder =>job_edu_certificate
define('JOBEDUCERTIFICATE', 'uploads/job_edu_certificate/');
define('ARTISTICIMAGE', 'uploads/art_images/');
define('ARTPOSTIMAGE', 'uploads/khyati_images/');
define('BUSPOSTIMAGE', 'uploads/bus_post_image/');



define('ARTBGIMAGE', 'uploads/art_bg/');
define('RECBGIMAGE', 'uploads/rec_bg/');
define('JOBBGIMAGE', 'uploads/job_bg/');
define('FREEHIREIMG', 'uploads/free_hire_bg/');
define('FREEWORKIMG', 'uploads/free_work_bg/');
define('ARTBGIMG', 'uploads/free_work_bg/');
define('BUSBGIMG', 'uploads/bus_bg/');
define('PROFILENA', '--');



define('BUSINESSPROFILEIMAGE', 'uploads/business_profile_images/');
define('FREELANCERPORTFOLIOIMG', 'uploads/freelancer_portfolio_attachment/');






