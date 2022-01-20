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

//MAIN ROUTE
$route['dashboard'] 			= 'main/dashboard';
$route['profile'] 				= 'main/profile';
$route['profile_edit'] 		= 'main/edit_profile';


// PROJECT ROUTE
$route['project'] 				  = 'project/view_all';
$route['project-add'] 		  = 'project/project_add';
$route['fetchDataSummary']  = 'project/fetchDataSummary';
$route['delete_doc']        = 'project/delete_document';
$route['delete_project']    = 'project/delete_project';
$route['upload_activity']   = 'project/upload_activities';
$route['projectStatus']     = 'project/projectStatus';
$route['check_amount']      = 'project/check_amount';

// ADMIN
$route['fetch_request']      = 'auth/fetch_request_account';
$route['fetch_request']      = 'auth/fetch_request_account';
$route['user_permision']     = 'auth/user_permision';
$route['disableUser']        = 'auth/disable_account';
$route['deleteUser']         = 'auth/delete_account';


$route['registration']			= 'auth/registration';
$route['login'] 				= 'auth/login';
$route['logout'] 				= 'auth/logout';


$route['default_controller'] 	= 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] 	= FALSE;
