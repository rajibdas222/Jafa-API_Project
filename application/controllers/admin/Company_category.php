<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_category extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model', 'points_model','account/acl_role_model'));
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

		$this->load->view('admin/company_category', $data);
	}

	public function get_company_category($period = NULL, $end_date = NULL)
	{
        $user_id = $this->session->userdata('account_id');

		$categories = $this->points_model->company_category();
		$data = array();
		$company_summary = array();
		// Gift Code Amount
		$total_excnange = 0;

        $data['user_info'] = $this->account_model->get_by_id($user_id);
        $user_type = 'member';
        if ($data['user_info']->role_id == 1) {
            $user_type = 'admin';
        } elseif ($data['user_info']->role_id == 2) {
            $user_type = 'company';
        } else {
            $user_type = 'member';
        }
        $data['user_temp_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'temp', 'all', NULL, $user_type);

        $data['temporary_point'] = 0;
        if ($data['user_info']->role_id == 1) {
            $data['temporary_point'] = $data['user_temp_points']->jafa_point;

        }
				
		foreach ($categories as $key => $category) {		
			$sum_data['category'] = $category->parent_category;
			$sum_data['period'] = $period;
			$sum_data['end_date'] = $end_date;

			$sum_data['company_temp_total'] = $this->points_model->get_temp_summary_category($category->parent_category, $period, $end_date);
//			 echo "<br>". $this->db->last_query();
			$sum_data['company_per_total'] = $this->points_model->get_per_summary_category($category->parent_category, $period, $end_date);
			// print_r($sum_data['previous_gift_amount']);
			$sum_data['company_exchange_amount'] = $this->points_model->get_used_giftcode_by_category($category->parent_category, $period, $end_date)->amount;
			$total_excnange += $sum_data['company_exchange_amount'];

			$company_category[] = $sum_data;
		}
		if ($period == 'all') {
			$company_summary['previous_gift_amount'] = 0;
		}else{
			$company_summary['previous_gift_amount'] = $this->points_model->get_total_previous_giftcode($period, $end_date)->amount;
		}
		
		$company_summary['entry_giftcod_amount'] = $this->points_model->get_total_entry_giftcode($period, $end_date)->amount;
		$company_summary['total_gift_amount'] = ($company_summary['previous_gift_amount']+$company_summary['entry_giftcod_amount']);
		$company_summary['previous_used_gift_amount'] = $this->points_model->previous_used_gift_amount($period, $end_date)->amount;
		$company_summary['excnange_amount'] = $total_excnange;
		$company_summary['total_excnange_amount'] = $company_summary['previous_used_gift_amount']+$total_excnange;
		$company_summary['company_category'] = $company_category;
		$data['company_summary'] = $company_summary;
//		 echo "<br><pre>"; print_r($data['company_summary']);
//		 exit();
		echo json_encode($data);
	}


	//all company list work by rajib

    public function allCompanyList()
    {
        $data['parent_id'] = null;
        //print_r($data);
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
        // Get all the roles
        //$data['roles'] = $this->acl_role_model->get();
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        //print_r($data);
        $this->load->view('jacos_point_details/admin_allcompany_history', $data);
    }

    public function allCompanypointHistory()
    {
        $data = array();
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'admin_company_point'));
        }

        // Redirect unauthorized users to account profile page
//        if (!$this->authorization->is_permitted('admin_point_historys')) {
//            redirect(base_url());
//        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }

        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        $data['member_companies'] = $this->points_model->get_company();
        $data['company_list'] = $this->points_model->company_list();
        //echo "<pre>";
        $this->load->view('jacos_point_details/admin_company_history', $data);

    }




}