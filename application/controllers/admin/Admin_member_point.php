<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_member_point extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model', 'points_model'));
		$this->load->language(array('general', 'account/sign_in'));
	}
	
	public function index()
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

		$this->load->view('admin/member_point', $data);
	}
}