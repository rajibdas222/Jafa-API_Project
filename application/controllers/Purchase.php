<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase extends CI_Controller {
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
		$data['member_purchase'] = $this->points_model->get_customer_purchase_list();
		// echo "<pre>"; print_r($data['member_purchase']);
		// exit();
		$this->load->view('purchase/index', $data);
	}
}