<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Undefined variable: amazon_excenge D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 92
ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Trying to get property 'price_amount' of non-object D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 92
ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Undefined variable: amazon_excenge D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 139
ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Trying to get property 'price_amount' of non-object D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 139
ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Undefined variable: amazon_excenge D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 140
ERROR - 2021-03-12 13:02:27 --> Severity: Notice --> Trying to get property 'price_amount' of non-object D:\xampp\htdocs\jafa.dev\application\views\admin\balance_sheet.php 140
ERROR - 2021-03-12 19:49:36 --> Query error: Unknown column '*a3m_account_details' in 'field list' - Invalid query: SELECT `*a3m_account_details`, `a3m_account`.`id` as `user_id`, `a3m_account`.`tracking_id`, `a3m_account`.`email`, `a3m_account`.`createdon`, `a3m_account`.`parent_id`, `a3m_account_details`.`fullname`, `a3m_account_details`.`major_company_jacos`, `a3m_acl_role`.`name` as `role_name`, `a3m_acl_role`.`id` as `role_id`, `company_margin_distribution`.`member_mar`, `company_margin_distribution`.`com_mar`, `company_margin_distribution`.`service_charge`
FROM `a3m_account`
LEFT JOIN `a3m_account_details` ON `a3m_account`.`id`=`a3m_account_details`.`account_id`
LEFT JOIN `a3m_rel_account_role` ON `a3m_account`.`id`=`a3m_rel_account_role`.`account_id`
LEFT JOIN `a3m_acl_role` ON `a3m_rel_account_role`.`role_id`=`a3m_acl_role`.`id`
LEFT JOIN `company_margin_distribution` ON `a3m_account`.`id`=`company_margin_distribution`.`user_id`
WHERE `a3m_account`.`parent_id` IS NOT NULL
ORDER BY `user_id` DESC
ERROR - 2021-03-12 19:49:49 --> Query error: Unknown column 'a3m_account_details*' in 'field list' - Invalid query: SELECT `a3m_account_details*`, `a3m_account`.`id` as `user_id`, `a3m_account`.`tracking_id`, `a3m_account`.`email`, `a3m_account`.`createdon`, `a3m_account`.`parent_id`, `a3m_account_details`.`fullname`, `a3m_account_details`.`major_company_jacos`, `a3m_acl_role`.`name` as `role_name`, `a3m_acl_role`.`id` as `role_id`, `company_margin_distribution`.`member_mar`, `company_margin_distribution`.`com_mar`, `company_margin_distribution`.`service_charge`
FROM `a3m_account`
LEFT JOIN `a3m_account_details` ON `a3m_account`.`id`=`a3m_account_details`.`account_id`
LEFT JOIN `a3m_rel_account_role` ON `a3m_account`.`id`=`a3m_rel_account_role`.`account_id`
LEFT JOIN `a3m_acl_role` ON `a3m_rel_account_role`.`role_id`=`a3m_acl_role`.`id`
LEFT JOIN `company_margin_distribution` ON `a3m_account`.`id`=`company_margin_distribution`.`user_id`
WHERE `a3m_account`.`parent_id` IS NOT NULL
ORDER BY `user_id` DESC
ERROR - 2021-03-12 20:03:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`NULL`
ORDER BY `user_id` DESC' at line 7 - Invalid query: SELECT `a3m_account`.`id` as `user_id`, `a3m_account`.`tracking_id`, `a3m_account`.`email`, `a3m_account`.`createdon`, `a3m_account`.`parent_id`, `a3m_account_details`.`fullname`, `a3m_account_details`.`major_company_jacos`, `a3m_acl_role`.`name` as `role_name`, `a3m_acl_role`.`id` as `role_id`, `company_margin_distribution`.`member_mar`, `company_margin_distribution`.`com_mar`, `company_margin_distribution`.`service_charge`
FROM `a3m_account`
LEFT JOIN `a3m_account_details` ON `a3m_account`.`id`=`a3m_account_details`.`account_id`
LEFT JOIN `a3m_rel_account_role` ON `a3m_account`.`id`=`a3m_rel_account_role`.`account_id`
LEFT JOIN `a3m_acl_role` ON `a3m_rel_account_role`.`role_id`=`a3m_acl_role`.`id`
LEFT JOIN `company_margin_distribution` ON `a3m_account`.`id`=`company_margin_distribution`.`user_id`
WHERE `a3m_account`.`parent_id` = `IS` `NULL`
ORDER BY `user_id` DESC
