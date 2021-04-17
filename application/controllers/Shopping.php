<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shopping extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model', 'points_model'));
		$this->load->language(array('general', 'account/sign_in'));
	}
	
	public function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'points'));
		}
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$tencd = $this->input->get('tencd');
		if (!empty($tencd)) {
			$data['company'] = $this->account_model->get_by_username($tencd);
			$data['company_details'] = $this->account_details_model->get_by_account_id($data['company']->id);
			$company_members = $this->points_model->get_company_member($data['company']->id);
			$company_code = (!empty($data['company']->tracking_id))? $data['company']->tracking_id: $data['company']->username;
			// echo $company_code;
			// exit();
			// $company_code = sprintf('%010x', $company_code);
			// echo $company_code;
			// exit();
			$data['members'] = array();
			foreach ($company_members as $key => $member) {
				$member_sum = $this->points_model->get_member_sum($member->id);
				$member_info['user_id'] = $member->id;
				$member_info['company_code'] = $company_code;
				$member_info['code'] = (!empty($member->tracking_id))? $member->tracking_id: sprintf('%010d', $member->id);
				$member_info['fullname'] = $member->fullname;
				$member_info['total_salse_amount'] = $member_sum->item_sales_amount;		
				$member_info['chalin_two'] = $member_sum->chalin_two;		
				$member_info['shop_point'] = $member_sum->shop_point;
				$data['members'][] = $member_info;
			}
			
		}

		// print_r($data['members']);
		// exit();
		

		// $data['member_purchase'] = $this->points_model->get_customer_purchase_list($data['company']->id);
		$this->load->view('shopping/index', $data);
	}
}