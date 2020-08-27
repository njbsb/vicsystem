<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['activity/create'] = 'activity/create';
$route['activity'] = 'activity/index';
// $route['students/create'] = 'students/create';
$route['students'] = 'students/index';
$route['mentors/register'] = 'mentors/register';
$route['mentors'] = 'mentors/index';
$route['citra'] = 'citra/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;