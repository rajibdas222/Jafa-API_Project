<?php

class Gift_code extends CI_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url', 'photo', 'file'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model', 'giftcode_model', 'points_model'));
		$this->load->language(array('general', 'account/sign_in'));
	}
	
	public function index()
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
		$data['gift_codes']	= $this->giftcode_model->get_gift();
		// print_r($data['gift_codes']);
		$this->load->view('admin/gift_code', $data);
	}

	public function delete_gift_code($gift_id)
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'gift_codes'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_roles'))
		{
		  redirect('account/account_profile');
		}
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		if ($gift_id) {
			$gift_data['user_id'] = NULL;
			$gift_data['status'] = NULL;
			$gift_data['use_date'] = NULL;

			// print_r($member_data);
			// exit();
			$this->giftcode_model->_table_name = 'jafa_gift_code';
	    	$this->giftcode_model->_primary_key = 'gift_id';
			$this->giftcode_model->save($gift_data, $gift_id);
			
			// Set flash data 
			$this->session->set_flashdata('success_delete', 'GiftCodeは正常に削除されました。');
		}
		
		redirect('admin/gift_code');
	}

	public function add()
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'gift_codes'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_roles'))
		{
		  redirect('account/account_profile');
		}
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		if(isset($_POST["submit_gifcode"])){		
			$this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
			
			// Validate submitted form data
            if($this->form_validation->run() == true){
        	    $filename=$_FILES["file"]["tmp_name"];
        	     if($_FILES["file"]["size"] > 0)
        	     {
        	        $file = fopen($filename, "r");
        	        $i = 0; 
        	        $storedData = array();

        			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        			{
        				$i++;
        				if ($i>1) {
        					$gift_code_info = $this->points_model->check_by(array('sl_number' => $getData[4]), 'jafa_gift_code');

        					if (empty($gift_code_info)) {
        						$gift_data['gift_code'] = $getData[1];
        						$gift_data['converted_point'] = $getData[2];
        						$gift_data['price_amount'] = $getData[2];
        						$gift_data['expire_date'] = date("Y-m-d", strtotime($getData[3]));
        						$gift_data['sl_number'] = $getData[4];
        						$storedData[] = $gift_data;
        					}      					

        				}					
        			}	
        			if (!empty($storedData)) {
        				$this->db->insert_batch('jafa_gift_code', $storedData);
        				$this->session->set_flashdata('add_gift_code', "AmazonギフトコードCSVファイルが正常にアップロードされました。");
        			}else{
        				$this->session->set_flashdata('add_gift_code', "このファイルは既にアップロードされています。");
        			}
        			
        			fclose($file);
        			
        		}
		    }
		}
		$this->load->view('admin/gift_code_add', $data);
		// redirect('admin/gift_code_add');
	}

	/*
	     * Callback function to check file value and type during validation
	     */
	public function file_check($str){
		$allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
			$mime = get_mime_by_extension($_FILES['file']['name']);
			$fileAr = explode('.', $_FILES['file']['name']);
			$ext = end($fileAr);
			if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
				return true;
			}else{
				$this->form_validation->set_message('file_check', 'アップロードするCSVファイルのみを選択してください。');
				return false;
			}
		}else{
			$this->form_validation->set_message('file_check', 'アップロードするCSVファイルのみを選択してください。');
			return false;
		}
	}

	public function report()
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
		  redirect('account/sign_in/?continue='.urlencode(base_url().'gift_codes'));
		}

		// Redirect unauthorized users to account profile page
		if ( ! $this->authorization->is_permitted('retrieve_roles'))
		{
		  redirect('account/account_profile');
		}
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$data['username'] = $this->input->get('username') != ""? $this->input->get('username'): NULL;
		$data['gift_codes'] = array();
		$data['user_info'] = $this->account_model->get_by_username_email($data['username']);
		if (!empty($data['user_info'])) {
			
			
			$data['gift_codes']	= $this->giftcode_model->get_gift($data['user_info']->id);
		}
		
		$this->load->view('admin/gift_code_report', $data);
	}

	public function test_email()
	{
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'smtp.jacos.co.jp',
		    'smtp_port' => 587,
		    'smtp_user' => 'no-reply@jacos.co.jp',
		    'smtp_pass' => 'hm&wKy7q',
		    'mailtype'  => 'text/plain', 
		    'charset'   => 'UTF-8'
		);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from("no-reply@jacos.co.jp", "JAFA Team");
		$this->email->to('ahsanullah716@gmail.com');
		$this->email->subject("JAFA Amazon");
		$this->email->message("This is test email");
		if(!$this->email->send())
		{
			$result = $this->email->print_debugger();
			print_r($result);
		}
		else
		{
			echo "Email sent successfully";
		}
	}
}