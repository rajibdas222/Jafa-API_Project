<?php
/*
 * Sign_up Controller
 */
class Sign_up extends CI_Controller {

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
		$this->load->model(array('account/account_model', 'account/account_details_model', 'points_model','account/rel_account_role_model'));
		$this->load->language(array('general', 'account/sign_up', 'account/connect_third_party'));
	}

	/**
	 * Account sign up
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

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();

		// Store recaptcha pass in session so that users only needs to complete captcha once
		if ($recaptcha_result === TRUE) $this->session->set_userdata('sign_up_recaptcha_pass', TRUE);
		$intro_id = $this->input->get('intorid');
		$data['introduce_partner'] = array();

		$refaral = $this->input->post('refaral');
		$parent_id = 32;
		if ($refaral != "") {
			$parent_info = $this->db->where('tracking_id', $refaral)->get('a3m_account')->row();
			$parent_id = $parent_info->id;
		}
		
		if ($intro_id) {
			$data['introduce_partner'] = $this->points_model->check_by(array('intro_id' => $intro_id), 'introduce_partner');
			// print_r($data['introduce_partner']);
			
		}

		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');

		$this->form_validation->set_rules(array(
			array(
				'field' => 'sign_up_username', 
				'label' => 'lang:sign_up_username', 
				'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'
			), 
			array(
				'field' => 'fullname', 
				'label' => 'lang:fullname', 
				'rules' => 'trim|required|max_length[100]'
			),
			array(
				'field' => 'sign_up_password', 
				'label' => 'lang:sign_up_password', 
				'rules' => 'trim|required|min_length[4]|matches[passconf]'),
			array(
				'field' => 'passconf',
				'label' => 'パスワードを認証する', 
				'rules' => 'trim|required|min_length[4]'),
			array(
				'field' => 'sign_up_email', 
				'label' => 'lang:sign_up_email', 
				'rules' => 'trim|required|valid_email|is_unique[a3m_account.email]|max_length[160]',
				'errors' => array(
				    'required' => '{field} は必須です',
				    'valid_email' => '{field} がメールアドレスとして正しくありません',
				    'is_unique' => '{field} は既に存在しています'
				  )
			)
		));

		// Run form validation
		if (($this->form_validation->run() === TRUE) && ($this->config->item("sign_up_enabled")))
		{

			// Check if user name is taken
			if ($this->username_check($this->input->post('sign_up_username')) === TRUE)
			{
				$data['sign_up_username_error'] = lang('sign_up_username_taken');
			}
			// Check if email already exist
			elseif ($this->email_check($this->input->post('sign_up_email')) === TRUE)
			{
				$data['sign_up_email_error'] = lang('sign_up_email_exist');
			}
			// Either already pass recaptcha or just passed recaptcha
			elseif ( ! ($this->session->userdata('sign_up_recaptcha_pass') == TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_up_recaptcha_enabled") === TRUE)
			{
				$data['sign_up_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_up_recaptcha_incorrect') : lang('sign_up_recaptcha_required');
			}
			else
			{
				// Remove recaptcha pass
				$this->session->unset_userdata('sign_up_recaptcha_pass');
				
				$user_id = $this->account_model->create($this->input->post('sign_up_username', TRUE), $this->input->post('sign_up_email', TRUE), $this->input->post('sign_up_password', TRUE), $parent_id, NULL);

				// Add user details (auto detected country, language, timezone)
				$this->account_details_model->update($user_id, array('fullname' => $this->input->post('fullname', TRUE)));

				// Auto sign in?
				if ($this->config->item("sign_up_auto_sign_in"))
				{
					// Run sign in routine
					$this->authentication->sign_in($user_id);
				}

				redirect('compare');
			}
		}

		// Load recaptcha code
		if ($this->config->item("sign_up_recaptcha_enabled") === TRUE) if ($this->session->userdata('sign_up_recaptcha_pass') != TRUE) $data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

		// Load sign up view
		$this->load->view('sign_up', isset($data) ? $data : NULL);
	}

	/**
	 * Check if a username exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function username_check($username)
	{
		return $this->account_model->get_by_username($username) ? TRUE : FALSE;
	}

	function username_check_exist($username)
	{
		$user_info = $this->account_model->get_by_username($username);
		$data = array();
		if (!empty($user_info)) {
			$data['user_info'] = $user_info;
			$data['success'] = 1;
			$data['message'] = "この番号は既に登録済みです";
		}else{
			$data['user_info'] = array();
			$data['success'] = 0;
			$data['message'] = "";
		}
		echo json_encode($data);
	}

	function email_check_exist()
	{
		$email = $this->input->post('email');
		$user_info = $this->account_model->get_by_email($email);
		$data = array();
		if (!empty($user_info)) {
			$data['user_info'] = $user_info;
			$data['success'] = 1;
			$data['message'] = "すでに登録すみです。";
		}else{
			$data['user_info'] = array();
			$data['success'] = 0;
			$data['message'] = "";
		}
		echo json_encode($data);
	}

	/**
	 * Check if an email exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function email_check($email)
	{
		return $this->account_model->get_by_email($email) ? TRUE : FALSE;
	}

	public function ajax_sign_up()
	{
		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');
		$data['introduce_partner'] = array();
		$this->form_validation->set_rules(array(
			array(
				'field' => 'sign_up_username', 
				'label' => 'lang:sign_up_username', 
				'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'
			), 
			array(
				'field' => 'sign_up_username', 
				'label' => 'lang:sign_up_username', 
				'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'
			),
			array(
				'field' => 'fullname', 
				'label' => 'lang:fullname', 
				'rules' => 'trim|required|max_length[100]'
			),
			array(
				'field' => 'sign_up_password', 
				'label' => 'lang:sign_up_password', 
				'rules' => 'trim|required|min_length[4]|matches[passconf]'),
			array(
				'field' => 'passconf',
				'label' => 'パスワードを認証する', 
				'rules' => 'trim|required|min_length[4]'),
			array(
				'field' => 'sign_up_email', 
				'label' => 'lang:sign_up_email', 
				'rules' => 'trim|required|valid_email|is_unique[a3m_account.email]|max_length[160]',
				'errors' => array(
				    'required' => '{field} は必須です',
				    'valid_email' => '{field} がメールアドレスとして正しくありません',
				    'is_unique' => '{field} は既に存在しています'
				  )
			)
		));

		// Run form validation
		if (($this->form_validation->run() === TRUE) && ($this->config->item("sign_up_enabled")))
		{
			$intro_id = $this->input->get('intorid');
			$parent_id = $this->input->post('parent_id');
			// $parent_id = 32;
			// if ($refaral != "") {
			// 	$parent_info = $this->db->where('tracking_id', $refaral)->get('a3m_account')->row();
			// 	$parent_id = $parent_info->id;
			// }
			
			if ($intro_id) {
				$data['introduce_partner'] = $this->points_model->check_by(array('intro_id' => $intro_id), 'introduce_partner');
			}

			// Check if user name is taken
			if ($this->username_check($this->input->post('sign_up_username')) === TRUE)
			{
				$data['success'] = 0;
				$data['message'] = "この番号は既に登録済みです";
			}
			// Check if email already exist
			elseif ($this->email_check($this->input->post('sign_up_email')) === TRUE)
			{
				$data['success'] = 0;
				$data['message'] = "メールアドレスは既に登録済みです";
			}
			else
			{
				$user_id = $this->account_model->create($this->input->post('sign_up_username', TRUE), $this->input->post('sign_up_email', TRUE), $this->input->post('sign_up_password', TRUE), $parent_id, NULL);
				// echo $this->db->last_query();
				// exit();
				// Add user details (auto detected country, language, timezone)
				$this->account_details_model->update($user_id, array('fullname' => $this->input->post('fullname', TRUE)));

				$user_info = $this->account_model->get_by_id($user_id);
				
				// Auto sign in?
				if ($this->config->item("sign_up_auto_sign_in"))
				{
					// Run sign in routine
					// $this->authentication->sign_in($user_id);
					$data['success'] = 1;
					$data['message'] = 'success';
					$activation_url = site_url('account/sign_up/verify?id='.$user_info->id.'&token='.sha1($user_info->id.strtotime($user_info->createdon).$this->config->item('password_reset_secret')));
					// Load email library
					$config = Array(
					    'protocol' => 'smtp',
					    'smtp_host' => 'smtp.jacos.co.jp',
					    'smtp_port' => 587,
					    'smtp_user' => 'no-reply@jacos.co.jp',
					    'smtp_pass' => 'hm&wKy7q',
					    'mailtype'  => 'html',
					    'charset'   => 'UTF-8'
					);
					
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");

					$this->email->from("no-reply@jacos.co.jp", "株式会社ジャコス");
					$this->email->to($user_info->email);
					$this->email->subject('JAFA（価格比較サイト） 登録確認');
					$this->email->message($this->load->view('account/account_activation_email', array(
						'name' => $user_info->fullname,
						'username' => $user_info->username,
						'email' => $user_info->email,
						'activation_url' => anchor($activation_url, "登録確認", 'title="押してください", class="" style="padding: 10px;font-size: 22px;background-color: #007bff;border-color: #007bff;text-decoration: none; color: white; text-align: center; vertical-align: middle; cursor: pointer;border-radius: 5px; display: inline-block; font-weight: 400;" target="_blank"')
					), TRUE));
					if (!$this->email->send()) {
						$email_errors = $this->email->print_debugger();
						$data['email_errors'] = $email_errors;
					}else{
						$data['email_errors'] = array();
					}
					
					
				}else{
					$data['success'] = 0;
					$data['message'] = 'error';
				}
				echo json_encode($data);
			}
		}else{
			$data['success'] = 0;
			$data['message'] = validation_errors();
			echo json_encode($data);
		}
	}

	public function ajax_com_sign_up()
	{
//        echo($this->input->post('sign_up_username', TRUE));
//	    exit();
        // Redirect signed in users to homepage
        //if ($this->authentication->is_signed_in()) redirect('');

        $data['introduce_partner'] = array();
        $this->form_validation->set_rules(array(
            array(
                'field' => 'sign_up_username',
                'label' => 'lang:sign_up_username',
                'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'
            ),
            array(
                'field' => 'sign_up_username',
                'label' => 'lang:sign_up_username',
                'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'
            ),
            array(
                'field' => 'fullname',
                'label' => 'lang:fullname',
                'rules' => 'trim|required|max_length[100]'
            ),
            array(
                'field' => 'sign_up_password',
                'label' => 'lang:sign_up_password',
                'rules' => 'trim|required|min_length[4]|matches[passconf]'),
            array(
                'field' => 'passconf',
                'label' => 'パスワードを認証する',
                'rules' => 'trim|required|min_length[4]'),
            array(
                'field' => 'sign_up_email',
                'label' => 'lang:sign_up_email',
                'rules' => 'trim|required|valid_email|is_unique[a3m_account.email]|max_length[160]',
                'errors' => array(
                    'required' => '{field} は必須です',
                    'valid_email' => '{field} がメールアドレスとして正しくありません',
                    'is_unique' => '{field} は既に存在しています'
                )
            )
        ));

        // Run form validation
        if (($this->form_validation->run() === TRUE) && ($this->config->item("sign_up_enabled")))
        {
            $intro_id = $this->input->get('intorid');
            $parent_id = NULL; // $this->input->post('parent_id');
            // $parent_id = 32;
            // if ($refaral != "") {
            // 	$parent_info = $this->db->where('tracking_id', $refaral)->get('a3m_account')->row();
            // 	$parent_id = $parent_info->id;
            // }

            if ($intro_id) {
                $data['introduce_partner'] = $this->points_model->check_by(array('intro_id' => $intro_id), 'introduce_partner');
            }

            // Check if user name is taken
            if ($this->username_check($this->input->post('sign_up_username')) === TRUE)
            {
                $data['success'] = 0;
                $data['message'] = "この番号は既に登録済みです";
            }
            // Check if email already exist
            elseif ($this->email_check($this->input->post('sign_up_email')) === TRUE)
            {
                $data['success'] = 0;
                $data['message'] = "メールアドレスは既に登録済みです";
            }
            else
            {
                $user_id = $this->account_model->create($this->input->post('sign_up_username', TRUE), $this->input->post('sign_up_email', TRUE), $this->input->post('sign_up_password', TRUE), $parent_id, NULL);
                $this->rel_account_role_model->setAccountRole($user_id,2);

                //add acc details
                $acc_details_id = $this->account_details_model->createAccDetails($user_id, $this->input->post('fullname') );
                //update
                // $this->account_model->account_com_info_into_user($user_id, $user_id );


                // Auto sign in?
                if ($this->config->item("sign_up_auto_sign_in"))
                {
                    // Run sign in routine
                    // $this->authentication->sign_in($user_id);
                    $data['success'] = 1;
                    $data['message'] = 'success';
                        $activation_url = site_url('account/sign_up/verify?id='.$user_info->id.'&token='.sha1($user_info->id.strtotime($user_info->createdon).$this->config->item('password_reset_secret')));
                    // Load email library
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.jacos.co.jp',
                        'smtp_port' => 587,
                        'smtp_user' => 'no-reply@jacos.co.jp',
                        'smtp_pass' => 'hm&wKy7q',
                        'mailtype'  => 'html',
                        'charset'   => 'UTF-8'
                    );

                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");

                    $this->email->from("no-reply@jacos.co.jp", "株式会社ジャコス");
                    $this->email->to($user_info->email);
                    $this->email->subject('JAFA（価格比較サイト） 登録確認');
                    $this->email->message($this->load->view('account/account_activation_email', array(
                        'name' => $user_info->fullname,
                        'username' => $user_info->username,
                        'email' => $user_info->email,
                        'activation_url' => anchor($activation_url, "登録確認", 'title="押してください", class="" style="padding: 10px;font-size: 22px;background-color: #007bff;border-color: #007bff;text-decoration: none; color: white; text-align: center; vertical-align: middle; cursor: pointer;border-radius: 5px; display: inline-block; font-weight: 400;" target="_blank"')
                    ), TRUE));
                    if (!$this->email->send()) {
                        $email_errors = $this->email->print_debugger();
                        $data['email_errors'] = $email_errors;
                    }else{
                        $data['email_errors'] = array();
                    }


                }else{
                    $data['success'] = 0;
                    $data['message'] = 'error';
                }
                echo json_encode($data);
            }
        }else{
            $data['success'] = 0;
            $data['message'] = validation_errors();
            echo json_encode($data);
        }








	}

	public function verify()
	{
		// Get account by email
		if ($data['account'] = $this->account_model->get_by_id($this->input->get('id')))
		{			
			// Check if token is valid
			if ($this->input->get('token') == sha1($data['account']->id.strtotime($data['account']->createdon).$this->config->item('password_reset_secret')))
			{
				if ($data['account']->verifiedon !== NULL) {
					redirect(base_url());
				}else{
					// Upon sign in, redirect to change password page
					$this->session->set_userdata('sign_up_varify', '本登録が完了しました。お買い物をお楽しみください。');
					// Load reset password unsuccessful view
					$this->load->view('account/account_sign_up_varify', isset($data) ? $data : NULL);
				}				
			}else{
				$this->load->view('account/account_sign_up_varify_invalide', isset($data) ? $data : NULL);
			}
			
		}
	}

	public function registration_completetion()
	{

		$this->session->set_flashdata('registration_completetion', 1);
		$data['success'] = 1;
		$data['message'] = 'success';
		$url = base_url();
		// Load email library
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'smtp.jacos.co.jp',
		    'smtp_port' => 587,
		    'smtp_user' => 'no-reply@jacos.co.jp',
		    'smtp_pass' => 'hm&wKy7q',
		    'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$user_info = $this->account_model->get_by_id($this->input->post('id'));
		// Remove reset sent on datetime
		$this->account_model->sign_up_verifyed($user_info->id);
		

		// Run sign in routine
		$this->authentication->sign_in($user_info->id);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from("no-reply@jacos.co.jp", "株式会社ジャコス");
		$this->email->to($user_info->email);
		$this->email->subject('JAFA（価格比較サイト） 会員登録完了');
		$this->email->message($this->load->view('account/account_completetion_email', array(
			'name' => $user_info->fullname,
			'username' => $user_info->username,
			'password' => $user_info->password_text,
			'email' => $user_info->email,
			'url' => anchor($url, $url)
		), TRUE));
		if (!$this->email->send()) {
			$email_errors = $this->email->print_debugger();
			$data['email_errors'] = $email_errors;
		}else{
			$data['email_errors'] = array();
		}
	}

	
}


/* End of file sign_up.php */
/* Location: ./application/controllers/account/sign_up.php */
