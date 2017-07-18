<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/* product Login end */
//$route['login'] = 'Login/index';

$route['default_controller'] = 'main';
$route['404_override'] = 'My404Page';
//$route['translate_uri_dashes'] = FALSE;


$route['business-profile'] = "business_profile/index";
$route['business-profile/business-information-insert'] = "business_profile/business_information_insert";
$route['business-profile/business-information-update'] = "business_profile/business_information_update";

$route['business-profile/contact-information'] = "business_profile/contact_information";
$route['business-profile/contact-information-insert'] = "business_profile/contact_information_insert";

$route['business-profile/description'] = "business_profile/description";
$route['business-profile/description-insert'] = "business_profile/description_insert";

$route['business-profile/image'] = "business_profile/image";
$route['business-profile/image-insert'] = "business_profile/image_insert";

$route['business-profile/details/(:any)'] = "business_profile/business_resume/$1";
$route['business-profile/details'] = "business_profile/business_resume";

$route['business-profile/home'] = "business_profile/business_profile_post";
$route['business-profile/bussiness-profile-post-add'] = "business_profile/business_profile_addpost_insert";
$route['business-profile/bussiness-profile-post-add/manage/(:any)'] = "business_profile/business_profile_addpost_insert/manage/$1";

$route['business-profile/dashboard'] = "business_profile/business_profile_manage_post";
$route['business-profile/dashboard/(:any)'] = "business_profile/business_profile_manage_post/$1";
$route['business-profile/followers'] = "business_profile/followers";
$route['business-profile/followers/(:any)'] = "business_profile/followers/$1";
$route['business-profile/following'] = "business_profile/following";
$route['business-profile/following/(:any)'] = "business_profile/following/$1";
$route['business-profile/userlist'] = "business_profile/userlist";
$route['business-profile/userlist/(:any)'] = "business_profile/userlist/$1";
$route['business-profile/contact-list'] = "business_profile/contact_list";

$route['business-profile/contacts'] = "business_profile/bus_contact";
$route['business-profile/contacts/(:any)'] = "business_profile/bus_contact/$1";

$route['business-profile/user-image-change'] = "business_profile/user_image_insert";
$route['business-profile/business-profile-save-post'] = "business_profile/business_profile_save_post";
$route['business-profile/business-profile-addpost'] = "business_profile/business_profile_addpost";
$route['business-profile/business-photos'] = "business_profile/business_photos";
$route['business-profile/business-photos/(:any)'] = "business_profile/business_photos/$1";

$route['business-profile/business-videos'] = "business_profile/business_videos";
$route['business-profile/business-videos/(:any)'] = "business_profile/business_videos/$1";

$route['business-profile/business-audios'] = "business_profile/business_audios";
$route['business-profile/business-audios/(:any)'] = "business_profile/business_audios/$1";


$route['business-profile/business-pdf'] = "business_profile/business_pdf";
$route['business-profile/business-pdf/(:any)'] = "business_profile/business_pdf/$1";

$route['business-profile/business-profile-contactperson'] = "business_profile/business_profile_contactperson";
$route['business-profile/post-detail'] = "business_profile/postnewpage";
$route['business-profile/creat-pdf'] = "business_profile/creat_pdf";
$route['business-profile/business-profile-editpost'] = "business_profile/business_profile_editpost";

/* Report Route end */

