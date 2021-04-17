<?php
/*
 * Sign_in Controller
 */
class Sign_in extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'account/recaptcha', 'form_validation'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('account/sign_in', 'general'));
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');

		// Set default recaptcha pass
		$recaptcha_pass = $this->session->userdata('sign_in_failed_attempts') < $this->config->item('sign_in_recaptcha_offset') ? TRUE : FALSE;

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();
		$data = array();
		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'sign_in_username_email',
				'label' => 'lang:sign_in_username_email',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'sign_in_password',
				'label' => 'lang:sign_in_password',
				'rules' => 'trim|required'
			)
		));

		// Run form validation
		if ($this->form_validation->run() === TRUE)
		{
			// Get user by username / email
			$data['user'] = $this->account_model->get_by_username_email($this->input->post('sign_in_username_email', TRUE));
			if ( ! $data['user'] )
			{
				// Username / email doesn't exist
				$data['sign_in_username_email_error'] = lang('sign_in_username_email_does_not_exist');
				
			}
			else
			{
				// Either don't need to pass recaptcha or just passed recaptcha
				if ( ! ($recaptcha_pass === TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_in_recaptcha_enabled") === TRUE)
				{
					$data['sign_in_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_in_recaptcha_incorrect') : lang('sign_in_recaptcha_required');
				}
				else
				{
					// Check password
					if ( ! $this->authentication->check_password($data['user']->password, $this->input->post('sign_in_password', TRUE)))
					{
						// Increment sign in failed attempts
						$this->session->set_userdata('sign_in_failed_attempts', (int)$this->session->userdata('sign_in_failed_attempts') + 1);

						$data['sign_in_error'] = lang('sign_in_combination_incorrect');
					}elseif ($data['user']->verifiedon == NULL) {
						$data['sign_in_error'] = "アカウントは確認されていません";
					}
					else
					{
						$this->authentication->sign_in($data['user']->id, $this->input->post('sign_in_remember', TRUE));
						
						if ($user->role_id==1) {
							// redirect('admin_company_point');
							redirect('admin_member_point');
						}
						else{
							redirect('');
						}
					}
				}
			}
			// echo json_encode($data);
			
		}

		// Load recaptcha code
		if ($this->config->item("sign_in_recaptcha_enabled") === TRUE)
			if ($this->config->item('sign_in_recaptcha_offset') <= $this->session->userdata('sign_in_failed_attempts'))
				$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

		// Load sign in view
		$this->load->view('sign_in', isset($data) ? $data : NULL);
	}

	public function ajax_sign_in()
	{
		// return "OK";
		
		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');

		// Set default recaptcha pass
		$recaptcha_pass = $this->session->userdata('sign_in_failed_attempts') < $this->config->item('sign_in_recaptcha_offset') ? TRUE : FALSE;

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();
		$data = array();
		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'sign_in_username_email',
				'label' => 'lang:sign_in_username_email',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'sign_in_password',
				'label' => 'lang:sign_in_password',
				'rules' => 'trim|required'
			)
		));

		// Run form validation
		if ($this->form_validation->run() === TRUE)
		{
			// 
			// Get user by username / email
			$data['user'] = $this->account_model->get_by_username_email($this->input->post('sign_in_username_email', TRUE));
			// echo $data;
			$data['loged_in'] = 0;
			// print_r($data);
			if ( ! $data['user'] )
			{
				
				// Username / email doesn't exist
				$data['loged_in'] = 0;
				$data['message'] = lang('sign_in_username_email_does_not_exist');
				
			}
			else
			{
				
				// Either don't need to pass recaptcha or just passed recaptcha
				if ( ! ($recaptcha_pass === TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_in_recaptcha_enabled") === TRUE)
				{
					$data['loged_in'] = 0;
					$data['message'] = $this->input->post('recaptcha_response_field') ? lang('sign_in_recaptcha_incorrect') : lang('sign_in_recaptcha_required');
				}elseif ($data['user']->verifiedon == NULL) {
					echo "OK";
					$data['loged_in'] = 0;
					$data['message'] = "アカウントは確認されていません";
					// echo $data['message'];
				}
				else
				{
					// Check password
					if ( ! $this->authentication->check_password($data['user']->password, $this->input->post('sign_in_password', TRUE)))
					{
						// Increment sign in failed attempts
						$this->session->set_userdata('sign_in_failed_attempts', (int)$this->session->userdata('sign_in_failed_attempts') + 1);

						$data['message'] = lang('sign_in_combination_incorrect');
						$data['loged_in'] = 0;
					}
					else
					{
						$sign_in_remember = NULL;
						if ($this->input->post('sign_in_remember', TRUE) !="") {
							$sign_in_remember = $this->input->post('sign_in_remember', TRUE);
						}
						$this->authentication->sign_in($data['user']->id, $sign_in_remember);
						$data['loged_in'] = 1;
						$parent_trking = 'jacos';
						if ($data['user']->parent_id) {
							$data['parent_info'] = $this->account_model->get_by_id($data['user']->parent_id);
							$parent_trking = $data['parent_info']->tracking_id;
						}

						$data['tracking_id'] = $parent_trking.$data['user']->tracking_id;
					}
				}
			}
			echo json_encode($data);
			
		}
	}

	public function token_sign_in()
	{
		$data = array();
		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'user_token',
				'label' => 'user_token',
				'rules' => 'trim|required'
			)
		));

		// Run form validation
		if ($this->form_validation->run() === TRUE)
		{
			// Get user by username / email
			$data['user'] = $this->account_model->get_by_id($this->input->post('user_token', TRUE));
			$data['loged_in'] = 0;
			if ( ! $data['user'] )
			{
				// Username / email doesn't exist
				$data['loged_in'] = 0;
				$data['message'] = lang('sign_in_username_email_does_not_exist');				
			}
			else
			{
				if ($data['user']->verifiedon == NULL) {
					$data['loged_in'] = 0;
					$data['message'] = "アカウントは確認されていません";
				}
				else
				{					
					$sign_in_remember = NULL;
					if ($this->input->post('sign_in_remember', TRUE) !="") {
						$sign_in_remember = $this->input->post('sign_in_remember', TRUE);
					}
					$this->authentication->sign_in($data['user']->id, $sign_in_remember);
					$data['loged_in'] = 1;
					$parent_trking = 'jacos';
					if ($data['user']->parent_id) {
						$data['parent_info'] = $this->account_model->get_by_id($data['user']->parent_id);
						$parent_trking = $data['parent_info']->tracking_id;
					}
					$data['tracking_id'] = $parent_trking.$data['user']->tracking_id;					
				}
			}
			echo json_encode($data);			
		}
	}

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */