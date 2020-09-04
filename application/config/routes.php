<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['activity'] = 'activity/index';
$route['activity/update'] = 'activity/update';
$route['activity/create'] = 'activity/create';
$route['activity/(:any)'] = 'activity/view/$1';

$route['profile'] = 'user/index';
$route['profile/update'] = 'user/edit';

$route['student'] = 'student/index';
$route['student/register'] = 'student/register';
$route['student/(:any)'] = 'student/view/$1';

$route['organization'] = 'organization/index';

$route['mentor'] = 'mentor/index';
$route['mentor/register'] = 'mentor/register';
$route['mentor/update'] = 'mentor/update';
$route['mentor/(:any)'] = 'mentor/view/$1';

$route['citra'] = 'citra/index';
$route['citra/(:any)'] = 'citra/view/$1';

$route['score'] = 'score/index';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;