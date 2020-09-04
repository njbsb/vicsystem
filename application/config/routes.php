<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['activity'] = 'activity/index';
$route['activity/update'] = 'activity/update';
$route['activity/create'] = 'activity/create';
$route['activity/(:any)'] = 'activity/view/$1';

$route['profile'] = 'profile/index';
$route['profile/update'] = 'profile/update';

$route['students'] = 'students/index';
$route['organization'] = 'organization/index';
$route['mentors'] = 'mentors/index';

$route['citra'] = 'citra/index';
$route['citra/(:any)'] = 'citra/view/$1';

$route['score'] = 'score/index';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;