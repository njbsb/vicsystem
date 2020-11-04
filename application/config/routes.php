<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['academic'] = 'academic/index';
$route['academicplan'] = 'academic/academicplan';
$route['academic/records'] = 'academic/records';

$route['activity'] = 'activity/index';
$route['activity/update'] = 'activity/update';
$route['activity/create'] = 'activity/create';
$route['activity/(:any)'] = 'activity/view/$1';
$route['activity/committee/(:any)'] = 'activity/committee/$1';

$route['committee'] = 'committee/index';
$route['committee/(:any)'] = 'committee/view/$1';

$route['collaborator'] = 'collaborator/index';

$route['user'] = 'user/index';
$route['register'] = 'user/register';
$route['login'] = 'user/login';
$route['validate/(:any)'] = 'user/validate/$1';
// $route['user'] = 'user/index';

$route['profile'] = 'user/profile';
// $route['profile/update/(:any)'] = 'user/edit/$1';
$route['profile/update'] = 'user/edit';

$route['student'] = 'student/index';
$route['student/update'] = 'student/update';
$route['student/register'] = 'student/register';
$route['student/(:any)'] = 'student/view/$1';

$route['organization'] = 'organization/index';

$route['mentor'] = 'mentor/index';
$route['mentor/register'] = 'mentor/register';
$route['mentor/update'] = 'mentor/update';
$route['mentor/(:any)'] = 'mentor/view/$1';

$route['citra'] = 'citra/index';
$route['citra/(:any)'] = 'citra/view/$1';

$route['category'] = 'category/index';
$route['category/create'] = 'category/create';
$route['category/comments/(:any)'] = 'category/comments/$1';

$route['score'] = 'score/index';
$route['scoreplan'] = 'score/scoreplan';
$route['scoreplan/(:any)'] = 'score/scoreplan/$1';
$route['score/addscore'] = 'score/addscore';

$route['score/addscoreplan'] = 'score/addscoreplan';
$route['score/updatescoreplan'] = 'score/updatescoreplan';

$route['score/edit_scorecomp'] = 'score/edit_scorecomp';
$route['score/add_scorelevel'] = 'score/add_scorelevel';
$route['score/edit_scorelevel'] = 'score/edit_scorelevel';

$route['score/(:any)'] = 'score/view/$1';
$route['score/(:any)/(:any)'] = 'score/view/$1/$2';




$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
