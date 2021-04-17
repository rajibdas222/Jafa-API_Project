<?php

class Balance_sheet extends CI_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model', 'balance_model'));
		$this->load->language(array('general', 'account/sign_in'));
	}
	
	public function index()
	{
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'admin/balance_sheet'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_users'))
		{
		  	redirect(base_url());
		}

		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		

		$this->load->view('admin/balance_sheet', $data);
	}

	public function add($id = NULL)
	{
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'admin/balance_sheet'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_users'))
		{
		  	redirect(base_url());
		}

		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$data['balance_info'] = array();
		if (!empty($id)) {
			$data['balance_info'] = $this->balance_model->check_by(array('bal_id' => $id), 'jafa_balance_sheet');
		}
		// Setup form validation
		$this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
		$this->form_validation->set_rules(
		  array(
		    array(
				'field' => 'shop_id',
				'label' => 'サイト名',
				'rules' => 'trim|required'),
	    		'errors' => array(
				        'required' => 's%を指定していません。',
				),
		    array(
				'field' => 'payment_date',
				'label' => '入金日',
				'rules' => 'trim|required'),
			    'errors' => array(
					        'required' => 's%を指定していません。',
					),
		    array(
				'field' => 'amount',
				'label' => '入金金額',
				'rules' => 'trim|max_length[8]|required'),
				'errors' => array(
				        'required' => 's%を指定していません。',
				)
		  ));

		// Run form validation
		if ($this->form_validation->run())
		{
			$attributes['shop_id'] = $this->input->post('shop_id', TRUE) ? $this->input->post('shop_id', TRUE) : NULL;
			$attributes['amount'] = $this->input->post('amount', TRUE) ? (int) filter_var($this->input->post('amount', TRUE), FILTER_SANITIZE_NUMBER_INT): NULL;
			$attributes['payment_date'] = $this->input->post('payment_date', TRUE) ? $this->input->post('payment_date', TRUE) : 0;
			$attributes['created_by'] = $data['account']->id;
			$attributes['created_at'] = date("Y-m-d H:i:s");
			if (!empty($id)) {
				$attributes['updated_by'] = $data['account']->id;
				$attributes['updated_at'] = date("Y-m-d H:i:s");
			}
			$date_res_year = explode("年",$attributes['payment_date']);
			$date_res_month = explode("月",$date_res_year[1]);
			$date_res_day = explode("日",$date_res_month[1]);

			$attributes['payment_date'] = date("Y-m-d", strtotime($date_res_year[0].'-'.$date_res_month[0].'-'.$date_res_day[0]));


			$this->balance_model->_table_name = 'jafa_balance_sheet';
	  		$this->balance_model->_primary_key = 'bal_id';
	   		
			if ($id) {
				$this->balance_model->save($attributes, $id);
				$this->session->set_flashdata('success', 'データが更新されました。');
				redirect('admin/balance_sheet');
			}else{
				$bal_id = $this->balance_model->save($attributes);
				$this->session->set_flashdata('success', 'データが追加されました。');
				redirect('admin/balance_sheet');
			}
		}

		$this->load->view('admin/add_balance', $data);
	}

	public function history($shop_id = NULL)
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'admin/balance_sheet'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_users'))
		{
		  	redirect(base_url());
		}

		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		$data['histories'] = $this->balance_model->history($shop_id);
		// print_r($data['histories']);
		$this->load->view('admin/balance_history', $data);

	}

}