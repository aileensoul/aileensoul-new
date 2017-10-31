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
//$route['default_controller'] = 'under_construction';


$route['404_override'] = 'My404Page';
//$route['translate_uri_dashes'] = FALSE;


$route['about-us'] = "about_us";
$route['contact-us'] = "contact_us";
$route['terms-and-condition'] = "main/terms_condition";
$route['privacy-policy'] = "main/privacy_policy";


$route['business-profile'] = "business_profile/index";
$route['business-profile/reactivate'] = "business_profile/reactivate";
$route['business-profile/business-information-insert'] = "business_profile/business_information_insert";
$route['business-profile/business-information-update'] = "business_profile/business_information_update";
$route['business-profile/business-information-edit'] = "business_profile/business_information_update";

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
$route['business-profile/photos'] = "business_profile/business_photos";
$route['business-profile/photos/(:any)'] = "business_profile/business_photos/$1";

$route['business-profile/videos'] = "business_profile/business_videos";
$route['business-profile/videos/(:any)'] = "business_profile/business_videos/$1";

$route['business-profile/audios'] = "business_profile/business_audios";
$route['business-profile/audios/(:any)'] = "business_profile/business_audios/$1";


$route['business-profile/pdf'] = "business_profile/business_pdf";
$route['business-profile/pdf/(:any)'] = "business_profile/business_pdf/$1";

$route['business-profile/business-profile-contactperson'] = "business_profile/business_profile_contactperson";
$route['business-profile/contact-person/(:any)'] = "business_profile/business_profile_contactperson/$1";
$route['business-profile/post-detail'] = "business_profile/postnewpage";
$route['business-profile/post-detail/(:any)/(:any)'] = "business_profile/postnewpage/$1/$2";
$route['business-profile/creat-pdf'] = "business_profile/creat_pdf";
$route['business-profile/business-profile-editpost'] = "business_profile/business_profile_editpost";

$route['notification/business-profile-post/(:any)'] = "notification/business_post/$1";
$route['notification/business-profile-post-detail/(:any)/(:any)'] = "notification/bus_post_img/$1/$2";


//FREELANCER HIRE ROUTES SETTINGS
$route['freelancer-hire/home'] = "freelancer/recommen_candidate";
$route['freelancer-hire/employer-details'] = "freelancer/freelancer_hire_profile";
$route['freelancer-hire/employer-details/(:any)'] = "freelancer/freelancer_hire_profile/$1";
$route['freelancer-hire/projects'] = "freelancer/freelancer_hire_post";
$route['freelancer-hire/projects/(:any)'] = "freelancer/freelancer_hire_post/$1";
$route['freelancer-hire/freelancer-save'] = "freelancer/freelancer_save";
$route['freelancer-hire/add-projects'] = "freelancer/freelancer_add_post";
$route['freelancer-hire/basic-information'] = "freelancer_hire/freelancer_hire_basic_info";
$route['freelancer-hire/address-information'] = "freelancer_hire/freelancer_hire_address_info";
$route['freelancer-hire/professional-information'] = "freelancer_hire/freelancer_hire_professional_info";
$route['freelancer-hire/search'] = "search/freelancer_hire_search";
$route['freelancer-hire/search/0/(:any)'] = "search/freelancer_hire_search/0/$1";
$route['freelancer-hire/search/(:any)/0'] = "search/freelancer_hire_search/$1/0";
$route['freelancer-hire/search/(:any)/(:any)'] = "search/freelancer_hire_search/$1/$2";
$route['freelancer-hire/edit-projects/(:any)'] = "freelancer/freelancer_edit_post/$1";
$route['freelancer-hire/reactivate'] = "freelancer_hire/reactivate";
$route['freelancer-hire/deactivate'] = "freelancer/deactivate_hire";
$route['freelancer-hire/freelancer-applied/(:any)'] = "freelancer/freelancer_apply_list/$1";
$route['freelancer-hire'] = "freelancer_hire/freelancer_hire";
$route['notification/freelancer-hire/(:any)'] = "notification/freelancer_hire_post/$1";


//FREELANCER APPLY ROUTES SETTINGS
$route['freelancer-work/home'] = "freelancer/freelancer_apply_post";
$route['freelancer-work/freelancer-details/(:any)'] = "freelancer/freelancer_post_profile/$1";
$route['freelancer-work/freelancer-details'] = "freelancer/freelancer_post_profile";
$route['freelancer-work/saved-projects'] = "freelancer/freelancer_save_post";
$route['freelancer-work/applied-projects'] = "freelancer/freelancer_applied_post";
$route['freelancer-work/basic-information'] = "freelancer/freelancer_post_basic_information";
$route['freelancer-work/address-information'] = "freelancer/freelancer_post_address_information";
$route['freelancer-work/professional-information'] = "freelancer/freelancer_post_professional_information";
$route['freelancer-work/rate'] = "freelancer/freelancer_post_rate";
$route['freelancer-work/avability'] = "freelancer/freelancer_post_avability";
$route['freelancer-work/education'] = "freelancer/freelancer_post_education";
$route['freelancer-work/portfolio'] = "freelancer/freelancer_post_portfolio";
$route['freelancer-work/search'] = "search/freelancer_post_search";

$route['freelancer-work/deactivate'] = "freelancer/deactivate";
$route['freelancer-work/reactivate'] = "freelancer/reactivate";
$route['freelancer-work/search'] = "search/freelancer_post_search";
$route['freelancer-work'] = "freelancer/freelancer_post";

/* Report Route end */



//ARTISTIC ROUTES SETTINGS


$route['artistic'] = "artistic/index";
$route['artistic/artistic-basic-information-insert'] = "artistic/art_basic_information_insert";
$route['artistic/artistic-information-update'] = "artistic/art_basic_information_update";

$route['artistic/artistic-address'] = "artistic/art_address";
$route['artistic/artistic-address-insert'] = "artistic/art_address_insert";

$route['artistic/artistic-information'] = "artistic/art_information";
$route['artistic/artistic-information-insert'] = "artistic/art_information_insert";

$route['artistic/artistic-portfolio'] = "artistic/art_portfolio";
$route['artistic/artistic-portfolio-insert'] = "artistic/art_portfolio_insert";

$route['artistic/home'] = "artistic/art_post";
$route['artistic/dashboard'] = "artistic/art_manage_post";
$route['artistic/dashboard/(:any)'] = "artistic/art_manage_post/$1";


$route['artistic/details/(:any)'] = "artistic/artistic_profile/$1";
$route['artistic/details'] = "artistic/artistic_profile";

$route['artistic/photos'] = "artistic/art_photos";
$route['artistic/photos/(:any)'] = "artistic/art_photos/$1";

$route['artistic/videos'] = "artistic/art_videos";
$route['artistic/videos/(:any)'] = "artistic/art_videos/$1";

$route['artistic/audios'] = "artistic/art_audios";
$route['artistic/audios/(:any)'] = "artistic/art_audios/$1";


$route['artistic/pdf'] = "artistic/art_pdf";
$route['artistic/pdf/(:any)'] = "artistic/art_pdf/$1";

$route['artistic/post-detail'] = "artistic/postnewpage";
$route['artistic/post-detail/(:any)'] = "artistic/postnewpage/$1";

$route['artistic/creat-pdf'] = "artistic/creat_pdf";

//BLOG ROUTES SETTINGS
$route['blog/popular'] = "blog/popular";
$route['blog/read_more'] = "blog/read_more";
$route['blog/comment_insert'] = "blog/comment_insert";
$route['blog/tag/(:any)'] = "blog/tagsearch/$1";
$route['blog/(:any)'] = "blog/index/$1";

//JOB ROUTES SETTINGS
$route['job/home'] = "job/job_all_post";
$route['job/home/live-post'] = "job/job_all_post/$1";

$route['job/resume'] = "job/job_printpreview";
$route['job/resume/(:any)'] = "job/job_printpreview/$1";

$route['job/saved-job'] = "job/job_save_post";
$route['job/applied-job'] = "job/job_applied_post";
$route['job/basic-information'] = "job/job_basicinfo_update";

$route['job/qualification'] = "job/job_education_update";
$route['job/qualification/(:any)'] = "job/job_education_update/$1";

$route['job/project'] = "job/job_project_update";
$route['job/work-area'] = "job/job_skill_update";
$route['job/work-experience'] = "job/job_work_exp_update";

$route['job/profile'] = "job/job_reg";
$route['job/profile/live-post'] = "job/job_reg";
$route['job/profile/live-post/(:any)'] = "job/job_reg/$1";
$route['job/search'] = "job/job_search";
$route['job/post-(:any)/(:any)'] = "job/post/$1/$2";
$route['job/recruiter-profile/(:any)'] = "job/rec_profile/$1";


//RECRUITER ROUTES SETTINGS

$route['recruiter/basic-information'] = "recruiter/rec_basic_information";
$route['recruiter/company-information'] = "recruiter/company_info_form";

$route['recruiter/home'] = "recruiter/recommen_candidate";

$route['recruiter/profile'] = "recruiter/rec_profile";
$route['recruiter/profile/(:any)'] = "recruiter/rec_profile/$1";

$route['recruiter/save-candidate'] = "recruiter/save_candidate";

$route['recruiter/post'] = "recruiter/rec_post";
$route['recruiter/post/(:any)'] = "recruiter/rec_post/$1";

$route['recruiter/jobpost'] = "recruiter/live_post";
$route['recruiter/jobpost/(:any)'] = "recruiter/live_post/$1";

$route['recruiter/add-post'] = "recruiter/add_post";

$route['recruiter/post-insert'] = "recruiter/add_post";

$route['recruiter/edit-post'] = "recruiter/edit_post";
$route['recruiter/edit-post/(:any)'] = "recruiter/edit_post/$1";
$route['recruiter/apply-list/(:any)'] = "recruiter/view_apply_list/$1";

$route['recruiter/search'] = "recruiter/recruiter_search";

// NOTIFICATION ROUTES SETTINGS
$route['notification/details/(:any)'] = "business_profile/business_resume/$1";
$route['notification/business-post/(:any)'] = "business_profile/edit_post/$1";

$route['notification/art-post/(:any)'] = "notification/art_post/$1";
