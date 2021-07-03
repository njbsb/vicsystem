<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['academic'] = 'academic/index';
$route['academic/control'] = 'academic/academiccontrol';
$route['academic/download_record'] = 'academic/download_record';
$route['academic/updateplan'] = 'academic/updateplan';
$route['academic/record'] = 'academic/record';
$route['academic/set_gpa'] = 'academic/set_gpa';
$route['enroll'] = 'academic/enroll';
$route['unenroll'] = 'academic/unenroll';

$route['activity'] = 'activity/index';
$route['activity/update'] = 'activity/update';
$route['activity/create'] = 'activity/create';
$route['activity/records'] = 'activity/records';
$route['activity/update_academicyear'] = 'activity/update_academicyear';
$route['activity/update_academicsession'] = 'activity/update_academicsession';
$route['activity/delete_committee'] = 'activity/delete_committee';
$route['activity/create_external'] = 'activity/create_external';
$route['activity/update_external'] = 'activity/update_external';
$route['activity/add_externalparticipant'] = 'activity/add_externalparticipant';
$route['activity/delete_externalparticipant'] = 'activity/delete_externalparticipant';
$route['activity/external'] = 'activity/external';
$route['activity/(:any)'] = 'activity/view/$1';
$route['activity/committee/(:any)'] = 'activity/committee/$1';

// $route['category'] = 'category/index';
// $route['category/create'] = 'category/create';
// $route['category/comments/(:any)'] = 'category/comments/$1';

$route['citra'] = 'citra/index';
$route['citra/(:any)'] = 'citra/view/$1';

$route['committee'] = 'committee/index';
$route['committee/(:any)'] = 'committee/view/$1';

$route['collaborator'] = 'collaborator/index';

$route['user'] = 'user/index';
$route['user/download'] = 'user/download';
$route['user/download_template'] = 'user/download_template';
$route['user/upload'] = 'user/upload';
$route['register'] = 'user/register';
$route['register_sucess'] = 'user/register_success';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['validate/(:any)'] = 'user/validate/$1';

$route['profile'] = 'user/profile';
$route['profile/update'] = 'user/edit';

$route['student'] = 'student/index';
$route['student/download'] = 'student/download';
$route['student/update'] = 'student/update';
$route['student/register'] = 'student/register';
$route['student/(:any)'] = 'student/view/$1';

$route['organization'] = 'organization/index';

$route['mentor'] = 'mentor/index';
$route['mentor/register'] = 'mentor/register';
$route['mentor/update'] = 'mentor/update';
$route['mentor/(:any)'] = 'mentor/view/$1';

$route['changepassword'] = 'user/changepassword';
$route['resetpassword'] = 'user/resetpassword';

$route['score'] = 'score/index';
$route['score/download_badgeboard'] = 'score/download_badgeboard';
$route['score/download_scoreboard'] = 'score/download_scoreboard';
$route['score/download_scoreboard/(:any)'] = 'score/download_scoreboard/$1';
$route['scoreplan'] = 'score/scoreplan';
$route['scoreboard'] = 'score/scoreboard';
$route['badgeboard'] = 'score/badgeboard';
$route['badgeboard/(:any)'] = 'score/badgeboard/$1';
$route['scoreplan/(:any)'] = 'score/scoreplan/$1';
$route['score/addscore'] = 'score/addscore';

$route['score/addscoreplan'] = 'score/addscoreplan';
$route['score/updatescoreplan'] = 'score/updatescoreplan';
$route['score/deletescoreplan'] = 'score/deletescoreplan';

$route['score/add_scorelevel'] = 'score/add_scorelevel';
$route['score/add_scorecomp'] = 'score/add_scorecomp';
$route['score/edit_scorecomp'] = 'score/edit_scorecomp';
$route['score/edit_scorelevel'] = 'score/edit_scorelevel';

$route['score/(:any)'] = 'score/viewacs/$1';
$route['score/(:any)/(:any)'] = 'score/view/$1/$2';

$route['filelink'] = 'pages/filelink';
$route['updatelink'] = 'pages/updatelink';
$route['createlink'] = 'pages/createlink';
$route['deletelink'] = 'pages/deletelink';
$route['createbadge'] = 'pages/createbadge';
$route['updatebadge'] = 'pages/updatebadge';

$route['badge'] = 'pages/badge';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;