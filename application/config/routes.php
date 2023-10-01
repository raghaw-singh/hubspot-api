<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['company-list']			=	'welcome/index';
$route['insert-company-list']	=	'welcome/insertCompanyData';
$route['update-company']		=	'welcome/updateCompany';
$route['download-csv']			=	'welcome/downloadCSV';