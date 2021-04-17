<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model', 'points_model'));
		$this->load->language(array('general', 'account/sign_in'));
	}
	
	public function index($category = NULL)
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'admin_member_point'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_users'))
		{
		  redirect(base_url());
		}

		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
		$companies = $this->points_model->company_list($category);
		// print_r($data['companies']);
		// exit();
		$period = $this->input->get('period') == 'null'? NULL: $this->input->get('period');

		$end_date = $this->input->get('end_date') == 'null'? NULL: $this->input->get('end_date');
		$data['period'] = $period;
		$data['end_date'] = $end_date;
		// echo "<pre>"; print_r($data);
		// exit();
		$data['report_lenght'] = date('m月'). date('1日').'～'.date('m月末日');
		if ($period == 'all') {
			$data['report_lenght'] = "すべてのレポート";
		}elseif (empty($end_date) && $period != 'all' && !empty($period)) {
			$data['report_lenght'] = date('Y年の', strtotime($period)).date('m月', strtotime($period)). date('1日').'～'.date('m月末日', strtotime($period));
		}elseif (!empty($end_date) && $period != 'all' && !empty($period)) {
			$data['report_lenght'] = date('Y年の', strtotime($period)).date('m月', strtotime($period)). date('d日', strtotime($period)).'～'.date('Y年の', strtotime($end_date)).date('m月', strtotime($end_date)). date('d日', strtotime($end_date));
		}
		
		// $data = array();
		// $companies = array();
		foreach ($companies as $key => $company) {
			// print_r($company);
			// exit();
			$company_temp_total = $this->points_model->get_temp_summary_by_com_id($company->user_id, $period, $end_date);
			// echo $this->db->last_query();
			// exit();
			$company_per_total = $this->points_model->get_per_summary_by_com_id($company->user_id, $period, $end_date);
			
			$company_exchange_total = $this->points_model->get_total_excange_by_com_id($company->user_id, $period, $end_date);

			$temp_order_amount = $company_temp_total->order_amount == NULL? 0:$company_temp_total->order_amount;
			$temp_point_amount = $company_temp_total->point_amount == NULL? 0:$company_temp_total->point_amount;

			$per_order_amount = $company_per_total->order_amount == NULL? 0:$company_per_total->order_amount;
			$per_point_amount = $company_per_total->point_amount == NULL? 0:$company_per_total->point_amount;
			$sum_data['user_id'] = $company->user_id;
			$sum_data['major_company'] = $company->major_company_jacos;
			$sum_data['role_name'] = $company->role_name;
			$sum_data['company_name'] = $company->company_name;
			$sum_data['member_mar'] = $company->member_mar;
			$sum_data['com_mar'] = $company->com_mar;
			// Temporary Points
			$sum_data['temp_order_amount'] = $temp_order_amount;
			$sum_data['temp_point_amount'] = $temp_point_amount;
			$sum_data['temp_company_point'] = $company_temp_total->company_point == NULL? 0:$company_temp_total->company_point;
			$sum_data['temp_user_point'] = $company_temp_total->user_point == NULL? 0:$company_temp_total->user_point;
			$sum_data['temp_jafa_point'] = $company_temp_total->jafa_point  == NULL? 0:$company_temp_total->jafa_point;
			// Permanent Point
			$sum_data['per_order_amount'] = $per_order_amount;
			$sum_data['per_point_amount'] = $per_point_amount;
			$sum_data['per_company_point'] = $company_per_total->company_point == NULL? 0:$company_per_total->company_point;
			$sum_data['per_user_point'] = $company_per_total->user_point == NULL? 0:$company_per_total->user_point;
			$sum_data['per_jafa_point'] = $company_per_total->jafa_point  == NULL? 0:$company_per_total->jafa_point;

			// Excenge report
			$sum_data['user_point_exange'] = $company_exchange_total->amount  == NULL? 0:$company_exchange_total->amount;			

			$company_summary[] = $sum_data;
		}
		$data['company_list'] = $company_summary;
		// echo "<pre>"; print_r($data['company_summary']);
		// exit();
		$this->load->view('admin/company', $data);
	}

	public function get_company_by_category($period = NULL, $end_date = NULL)
	{
		$company_list = $this->points_model->company_list();
		$data = array();
		$company_summary = array();
		// $data['unknown_per'] = $this->points_model->get_summary_by_unknown('perm', $period, $end_date);
		// $data['unknown_temp'] = $this->points_model->get_summary_by_unknown('temp', $period, $end_date);
		foreach ($company_list as $key => $company) {
			$company_temp_total = $this->points_model->get_temp_summary_by_com_id($company->user_id, $period, $end_date);
			
			$company_per_total = $this->points_model->get_per_summary_by_com_id($company->user_id, $period, $end_date);
			
			$company_exchange_total = $this->points_model->get_total_excange_by_com_id($company->user_id, $period, $end_date);

			$temp_order_amount = $company_temp_total->order_amount == NULL? 0:$company_temp_total->order_amount;
			$temp_point_amount = $company_temp_total->point_amount == NULL? 0:$company_temp_total->point_amount;

			$per_order_amount = $company_per_total->order_amount == NULL? 0:$company_per_total->order_amount;
			$per_point_amount = $company_per_total->point_amount == NULL? 0:$company_per_total->point_amount;
			$sum_data['user_id'] = $company->user_id;
			$sum_data['major_company'] = $company->major_company_jacos;
			$sum_data['role_name'] = $company->role_name;
			$sum_data['company_name'] = $company->company_name;
			$sum_data['member_mar'] = $company->member_mar;
			$sum_data['com_mar'] = $company->com_mar;
			// Temporary Points
			$sum_data['temp_order_amount'] = $temp_order_amount;
			$sum_data['temp_point_amount'] = $temp_point_amount;
			$sum_data['temp_company_point'] = $company_temp_total->company_point == NULL? 0:$company_temp_total->company_point;
			$sum_data['temp_user_point'] = $company_temp_total->user_point == NULL? 0:$company_temp_total->user_point;
			$sum_data['temp_jafa_point'] = $company_temp_total->jafa_point  == NULL? 0:$company_temp_total->jafa_point;
			// Permanent Point
			$sum_data['per_order_amount'] = $per_order_amount;
			$sum_data['per_point_amount'] = $per_point_amount;
			$sum_data['per_company_point'] = $company_per_total->company_point == NULL? 0:$company_per_total->company_point;
			$sum_data['per_user_point'] = $company_per_total->user_point == NULL? 0:$company_per_total->user_point;
			$sum_data['per_jafa_point'] = $company_per_total->jafa_point  == NULL? 0:$company_per_total->jafa_point;

			// Excenge report
			$sum_data['user_point_exange'] = $company_exchange_total->amount  == NULL? 0:$company_exchange_total->amount;			

			$company_summary[] = $sum_data;
		}
		$data['company_summary'] = $company_summary;
		echo json_encode($data);
	}
}