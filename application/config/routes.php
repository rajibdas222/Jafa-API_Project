<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'main_controller';
$route['amazon_new_api'] = 'main_controller/amazon_new_api';
$route['compare'] = 'main_controller/';
$route['member_margine'] = 'main_controller/member_margine';
$route['company_margine'] = 'main_controller/company_margine';
$route['company_point'] = 'main_controller/company_point';
$route['member_point'] = 'main_controller/member_point';
$route['admin_company_point'] = 'main_controller/admin_company_point';
$route['company_category'] = 'admin/company_category';
$route['admin_member_point'] = 'admin/admin_member_point';
$route['get_janmaster'] = 'main_controller/get_janmaster';
$route['shop_margine'] = 'main_controller/shop_margine';
$route['points'] = 'main_controller/points';
$route['management_sheet'] = 'main_controller/management_sheet';
$route['members'] = 'main_controller/members';
$route['purchase_list/(:any)/(:any)/(:any)'] = 'main_controller/member_purchase_details/$1/$2/$3';
$route['giftcode_history/(:any)/(:any)/(:any)'] = 'main_controller/giftcode_history/$1/$2/$3';
$route['exchange_history/(:any)/(:any)'] = 'main_controller/exchange_history/$1/$2';
$route['history'] = 'main_controller/purchase_history/';
$route['kamitein_list'] = 'main_controller/kamitein_list/';
$route['upload_referal_fee'] = 'main_controller/upload_referal_fee/';
$route['setting_point_sharing'] = 'main_controller/setting_point_sharing/';
$route['live_jancode'] = 'main_controller/live_jancode/';
$route['gift_codes'] = 'main_controller/gift_code_list/';
// $route['upload_permanent_referal_fee'] = 'main_controller/upload_permanent_referal_fee/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Rajib Work points
$route['point_acquisition'] = 'Point_Acquisition/index';
$route['pointsall'] = 'Point_Acquisition_Details/showAllPoints';
$route['points'] = 'Point_Acquisition_Details/amazonAllPoint';
$route['point_details/(:any)'] = 'main_controller/get_user_amazon_point_detail/$1';
//users_redirect_point_history
$route['users_point_historys'] = 'Point_Acquisition/users_redirect_point_history';

$route['point_history/(:any)'] = 'main_controller/get_user_point_history/$1';
$route['admin_all_users_history/(:any)'] = 'Point_Acquisition/getAdminAllUsers/$1';
//admin->company->linking
$route['company_point_history/(:any)'] = 'Point_Acquisition/get_admin_company_point_history/$1';
$route['company_users_history/(:any)'] = 'main_controller/get_company_user_history/$1';
$route['users_point_history'] = 'Point_Acquisition/getAll_user_point_history/$1';
$route['company_point_history'] = 'main_controller/get_company_point_history';
$route['csvupload/importcsv'] = 'Point_Acquisition_Details/PointCSV';

$route['get_company'] = 'main_controller/get_company';
//get all company->members
$route['allcompany_member_list'] = 'main_controller/get_company_point_history';
$route['get_member_amazon_point'] = 'main_controller/get_company_point_history';
//admin point historys
$route['allcompany_list'] = 'admin/company_category/allCompanyList';
//company_link route
$route['company_member_link'] = 'Point_Acquisition/company_member_links';





