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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'welcome';
$route['admin'] = 'admin/dashboard';

$route['signout'] = 'users/signout';
$route['signin'] = 'users/signin';
$route['signup'] = 'users/signup';
$route['forgot_password'] = 'users/forgot_password';
$route['auth/activate/(:num)/(:any)'] = 'users/activate/$1/$2';

$route['read/(:any)'] = 'posts/read/$1';

$route['category/(:any)'] = 'posts/category/$1';
$route['category/(:any)/(:num)'] = 'posts/category/$1/$2';

$route['tag/(:any)'] = 'posts/tag/$1';
$route['tag/(:any)/(:num)'] = 'posts/tag/$1/$2';

$route['blog'] = 'posts/index';
$route['blog/(:num)'] = 'posts/index/$1';