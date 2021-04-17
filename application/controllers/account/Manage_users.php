<?php
/*
 * Manage_users Controller
 */
class Manage_users extends CI_Controller {

  /**
   * Constructor
   */
  function __construct()
  {
    parent::__construct();

    // Load the necessary stuff...
    $this->load->config('account/account');
    $this->load->helper(array('date', 'language', 'account/ssl', 'url'));
    $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model'));
    $this->load->language(array('general', 'account/manage_users', 'account/account_settings', 'account/account_profile', 'account/sign_up', 'account/account_password'));
  }

  /**
   * Manage Users
   */
  function index()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_users'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all user information
    $all_accounts = $this->account_model->get();
    $all_account_details = $this->account_details_model->get();
    $all_account_roles = $this->rel_account_role_model->get();
    $admin_role = $this->acl_role_model->get_by_name('Admin');

    // Compile an array for the view to use
    $data['all_accounts'] = array();
    foreach ( $all_accounts as $acc )
    {
      $current_user = array();
      $current_user['id'] = $acc->id;
      $current_user['username'] = $acc->username;
      $current_user['email'] = $acc->email;
      $current_user['firstname'] = '';
      $current_user['lastname'] = '';
      $current_user['is_admin'] = FALSE;
      $current_user['is_banned'] = isset( $acc->suspendedon );

      foreach( $all_account_details as $det ) 
      {
        if( $det->account_id == $acc->id ) 
        {
          $current_user['firstname'] = $det->firstname;
          $current_user['lastname'] = $det->lastname;
        }
      }
      $current_user['user_role'] = $this->rel_account_role_model->get_by_account_id($acc->id);
      // print_r($current_user['user_role']);
      // print_r($all_account_roles);
      // foreach( $all_account_roles as $acrole ) 
      // {
      //   $current_user['user_role'] = NULL;
      //   if( $acrole->account_id == $acc->id ) 
      //   {
      //     // print_r($acc);
      //     $current_user['user_role'] = $acrole->name;
      //     // $current_user['is_admin'] = TRUE;
      //     // break;
      //   }
      // }

      // Append to the array
      $data['all_accounts'][] = $current_user;
    }
    // print_r($data['all_accounts']);
    // Load manage users view
    $this->load->view('account/manage_users', $data);
  }

  /**
   * Create/Update Users
   */
  function save($id=null)
  {
    // Keep track if this is a new user
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Check if they are allowed to Update Users
    if ( ! $this->authorization->is_permitted('update_users') && ! empty($id) )
    {
      redirect('account/manage_users');
    }

    // Check if they are allowed to Create Users
    if ( ! $this->authorization->is_permitted('create_users') && empty($id) )
    {
      redirect('account/manage_users');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all the roles
    $data['roles'] = $this->acl_role_model->get();

    // Set action type (create or update user)
    $data['action'] = 'create';

    // Get the account to update
    if( ! $is_new )
    {
      $data['update_account'] = $this->account_model->get_by_id($id);
      $data['update_account_details'] = $this->account_details_model->get_by_account_id($id);
      $data['update_account_roles'] = $this->acl_role_model->get_by_account_id($id);
      $data['action'] = 'update';
    }

    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'users_username',
          'label' => 'ユーザー名',
          'rules' => 'trim|required|alpha_dash|min_length[2]'),
        array(
          'field' => 'tracking_id',
          'label' => '加盟店コード',
          'rules' => 'trim|required|alpha_dash|max_length[10]|min_length[5]'),
        array(
          'field' => 'users_email', 
          'label' => 'lang:settings_email', 
          'rules' => 'trim|required|valid_email|max_length[100]'), 
        array(
          'field' => 'users_firstname', 
          'label' => '加盟店名前', 
          'rules' => 'trim|required|max_length[80]'), 
        // array(
        //   'field' => 'users_lastname', 
        //   'label' => 'lang:settings_lastname', 
        //   'rules' => 'trim|max_length[80]'),
        array(
          'field' => 'users_new_password', 
          'label' => 'lang:password_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|min_length[4]'),
        array(
          'field' => 'users_retype_new_password', 
          'label' => 'lang:password_retype_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|matches[users_new_password]')
      ));

    // Run form validation
    if ($this->form_validation->run())
    {
      $email_taken = $this->email_check($this->input->post('users_email', TRUE));
      $username_taken = $this->username_check($this->input->post('users_username'));
      $tracking_taken = $this->tracking_check($this->input->post('tracking_id'));
      // print_r($tracking_taken);
      // exit();
      // If user is changing email and new email is already taken OR
      // if this is a new user, just check if it's been taken already.
      if ( (! empty($id) && strtolower($this->input->post('users_email', TRUE)) != strtolower($data['update_account']->email) && $email_taken) || (empty($id) && $email_taken) )
      {
        $data['users_email_error'] = lang('settings_email_exist');
      }
      // Check if user name is taken
      elseif ( (! empty($id) && strtolower($this->input->post('users_username', TRUE)) != strtolower($data['update_account']->username) && $username_taken) || (empty($id) && $username_taken) )
      {
        $data['users_username_error'] = lang('sign_up_username_taken');
      }elseif ((! empty($id) && $this->input->post('tracking_id', TRUE) != $data['update_account']->tracking_id && $tracking_taken) || (empty($id) && $tracking_taken)) {
        $data['tracking_id_error'] = 'この追跡はすでに行われています。';

      }
      else
      {

        // Create a new user
        // $tracking_no = $this->input->post('users_username', TRUE);
        if( empty($id) ) {
          $id = $this->account_model->create(
            $this->input->post('users_username', TRUE), 
            $this->input->post('users_email', TRUE), 
            $this->input->post('users_new_password', TRUE),
            NULL,
            $this->input->post('tracking_id', TRUE),
            mdate('%Y-%m-%d %H:%i:%s', now())
          );
        }
        // Update existing user information
        else 
        {
          // Update account username
          $this->account_model->update_username($id, 
            $this->input->post('users_username', TRUE) ? $this->input->post('users_username', TRUE) : NULL);
          $this->account_model->tracking_number($id, 
            $this->input->post('tracking_id', TRUE) ? $this->input->post('tracking_id', TRUE) : NULL);

          // Update account email
          $this->account_model->update_email($id, $this->input->post('users_email', TRUE) ? $this->input->post('users_email', TRUE) : NULL);

          // Update password
          $pass = $this->input->post('users_new_password', TRUE) ? $this->input->post('users_new_password', TRUE) : NULL;
          if( ! empty($pass) )
          {
            $this->account_model->update_password($id, $pass);
          }

          // Check if the user should be suspended
          if( $this->authorization->is_permitted('ban_users') ) 
          {
            if( $this->input->post('manage_user_ban', true) )
            {
              $this->account_model->update_suspended_datetime($id);
            }
            elseif( $this->input->post('manage_user_unban', true) )
            {
              $this->account_model->remove_suspended_datetime($id);
            }
          }
        }

        // Update account details
        $attributes = array();
        
        $attributes['firstname'] = $this->input->post('users_firstname', TRUE) ? $this->input->post('users_firstname', TRUE) : NULL;
        $attributes['lastname'] = $this->input->post('users_lastname', TRUE) ? $this->input->post('users_lastname', TRUE) : NULL;
        $attributes['fullname'] = $attributes['firstname'].' '.$attributes['lastname'];
        $this->account_details_model->update($id, $attributes);

        // Apply roles
        $roles = array();
        foreach($data['roles'] as $r)
        {
          if( $this->input->post("account_role_{$r->id}", TRUE) )
          {
            $roles[] = $r->id;
          }
        }
        $this->rel_account_role_model->delete_update_batch($id, $roles);

        redirect("account/manage_users");
      }
    }

    // Load manage users view
    $this->load->view('account/manage_users_save', $data);
  }

  /**
   * Filter the user list by permission or role.
   *
   * @access public
   * @param string $type (permission, role)
   * @param int $id (permission_id, role_id)
   * @return void
   */
  function filter($type=null,$id=null)
  {
    $this->index();
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

  function tracking_check($tracking_id)
  {
    return $this->account_model->get_by_tracking($tracking_id) ? TRUE : FALSE;
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

  public function member()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users/member'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_users'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all user information
    $data['all_members'] = $this->account_model->member_list();
    // print_r($data['all_members']);
    // exit();
    // Load manage users view
    $this->load->view('account/manage_member', $data);
  }

  public function member_save($id=NULL)
  {
    // Keep track if this is a new user
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Check if they are allowed to Update Users
    if ( ! $this->authorization->is_permitted('update_users') && ! empty($id) )
    {
      redirect('account/manage_users');
    }

    // Check if they are allowed to Create Users
    if ( ! $this->authorization->is_permitted('create_users') && empty($id) )
    {
      redirect('account/manage_users');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all the roles
    $data['roles'] = $this->acl_role_model->get();

    // Set action type (create or update user)
    $data['action'] = 'create';

    $data['company_list'] = $this->account_model->company_list();
    // echo "<pre>"; print_r($data['company_list']);
    // exit();

    // Get the account to update
    if( ! $is_new )
    {
      $data['update_account'] = $this->account_model->get_by_id($id);
      $data['update_account_details'] = $this->account_details_model->get_by_account_id($id);
      $data['update_account_roles'] = $this->acl_role_model->get_by_account_id($id);
      $data['action'] = 'update';
    }

    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'users_username',
          'label' => 'lang:profile_username',
          'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'),
        array(
          'field' => 'users_email', 
          'label' => 'lang:settings_email', 
          'rules' => 'trim|required|valid_email|max_length[160]'), 
        array(
          'field' => 'users_firstname', 
          'label' => 'lang:settings_firstname', 
          'rules' => 'trim|max_length[80]'),
        // array(
        //   'field' => 'users_lastname', 
        //   'label' => 'lang:settings_lastname', 
        //   'rules' => 'trim|max_length[80]'),
        array(
          'field' => 'users_new_password', 
          'label' => 'lang:password_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|min_length[4]'),
        array(
          'field' => 'users_retype_new_password', 
          'label' => 'lang:password_retype_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|matches[users_new_password]')
      ));

    // Run form validation
    if ($this->form_validation->run())
    {

      $email_taken = $this->email_check($this->input->post('users_email', TRUE));
      $username_taken = $this->username_check($this->input->post('users_username'));

      // If user is changing email and new email is already taken OR
      // if this is a new user, just check if it's been taken already.
      if ( (! empty($id) && strtolower($this->input->post('users_email', TRUE)) != strtolower($data['update_account']->email) && $email_taken) || (empty($id) && $email_taken) )
      {
        $data['users_email_error'] = lang('settings_email_exist');
      }
      // Check if user name is taken
      elseif ( (! empty($id) && strtolower($this->input->post('users_username', TRUE)) != strtolower($data['update_account']->username) && $username_taken) || (empty($id) && $username_taken) )
      {
        $data['users_username_error'] = lang('sign_up_username_taken');
      }
      else
      {
        $parent_id = $this->input->post('parent_id', TRUE);
        if ($parent_id=='') {
          $parent_id = $data['account']->id;
        }
        // Create a new user
        if( empty($id) ) {
          $id = $this->account_model->create(
            $this->input->post('users_username', TRUE), 
            $this->input->post('users_email', TRUE), 
            $this->input->post('users_new_password', TRUE), 
            $parent_id);
        }
        // Update existing user information
        else 
        {
          // Update account username
          $this->account_model->update_username($id, 
            $this->input->post('users_username', TRUE) ? $this->input->post('users_username', TRUE) : NULL);

          // Update account email
          $this->account_model->update_parent_id($id, 
            $parent_id ? $parent_id : NULL);

          // Update password
          $pass = $this->input->post('users_new_password', TRUE) ? $this->input->post('users_new_password', TRUE) : NULL;
          if( ! empty($pass) )
          {
            $this->account_model->update_password($id, $pass);
          }

          // Check if the user should be suspended
          if( $this->authorization->is_permitted('ban_users') ) 
          {
            if( $this->input->post('manage_user_ban', true) )
            {
              $this->account_model->update_suspended_datetime($id);
            }
            elseif( $this->input->post('manage_user_unban', true) )
            {
              $this->account_model->remove_suspended_datetime($id);
            }
          }
        }

        // Update account details
        $attributes = array();
        
        $attributes['firstname'] = $this->input->post('users_firstname', TRUE) ? $this->input->post('users_firstname', TRUE) : NULL;
        $attributes['lastname'] = $this->input->post('users_lastname', TRUE) ? $this->input->post('users_lastname', TRUE) : NULL;
        $attributes['fullname'] = $attributes['firstname'].' '.$attributes['lastname'];
        $this->account_details_model->update($id, $attributes);
        // Send Email
        // Set reset datetime
        $time = $this->account_model->update_reset_sent_datetime($account->id);

        // Load email library
        $this->load->library('email');

        // Set up email preferences
        $config['mailtype'] = 'html';

        // Initialise email lib
        $this->email->initialize($config);

        // Generate reset password url
        // $account_activation_url = site_url('account/account_profile?id='.$id.'&token='.sha1($account->id.$time.$this->config->item('password_reset_secret')));
        $account_activation_url = site_url('?tencd='.$id);


        // Send reset password email
        $this->email->from($this->config->item('password_reset_email'), 'JACOS CO. LTD.,');
        $this->email->to($this->input->post('users_email', TRUE));
        $this->email->subject('About New Member Adding');
        $this->email->message($this->load->view('account/account_activation', array(
          'username' => $attributes['firstname'],
          'password_reset_url' => anchor($account_activation_url, $account_activation_url)
        ), TRUE));
        $this->email->send();
        
        // Apply roles
        $roles = array(3);
        
        $this->rel_account_role_model->delete_update_batch($id, $roles);
        if ($this->input->post('request_url') == 'company_margine') {
          redirect("company_margine");
        }else{
          redirect("account/manage_users/member");
        }        
      }
    }

    // Load manage users view
    $this->load->view('account/manage_member_save', $data);
  }

  function compay_save($id = NULL)
   {
       // Keep track if this is a new user
       $is_new = empty($id);
       $parent_id = NULL;
       // Enable SSL?
       maintain_ssl($this->config->item("ssl_enabled"));

       // Redirect unauthenticated users to signin page
       if ( ! $this->authentication->is_signed_in())
       {
         redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
       }

       // Check if they are allowed to Update Users
       if ( ! $this->authorization->is_permitted('update_users') && ! empty($id) )
       {
         redirect('account/manage_users');
       }

       // Check if they are allowed to Create Users
       if ( ! $this->authorization->is_permitted('create_users') && empty($id) )
       {
         redirect('account/manage_users');
       }

       // Retrieve sign in user
       $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
       $parent_id = $data['account']->id;

       // Get all the roles
       $data['roles'] = $this->acl_role_model->get();

       // Set action type (create or update user)
       $data['action'] = 'create';

       $data['company_list'] = $this->account_model->company_list();
       // echo "<pre>"; print_r($data['company_list']);
       // exit();

       // Get the account to update
       if( ! $is_new )
       {
         $data['update_account'] = $this->account_model->get_by_id($id);
         $data['update_account_details'] = $this->account_details_model->get_by_account_id($id);
         $data['update_account_roles'] = $this->acl_role_model->get_by_account_id($id);
         $data['action'] = 'update';
       }
       // Setup form validation
       $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
       $this->form_validation->set_rules(
         array(
           array(
             'field' => 'users_username',
             'label' => 'lang:profile_username',
             'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'),
           array(
             'field' => 'users_email', 
             'label' => 'lang:settings_email', 
             'rules' => 'trim|required|valid_email|max_length[160]'), 
           array(
             'field' => 'users_firstname', 
             'label' => 'lang:settings_firstname', 
             'rules' => 'trim|max_length[80]'),
           // array(
           //   'field' => 'users_lastname', 
           //   'label' => 'lang:settings_lastname', 
           //   'rules' => 'trim|max_length[80]'),
           array(
             'field' => 'users_new_password', 
             'label' => 'lang:password_new_password', 
             'rules' => 'trim|'.($is_new?'required':'optional').'|min_length[4]'),
           array(
             'field' => 'users_retype_new_password', 
             'label' => 'lang:password_retype_new_password', 
             'rules' => 'trim|'.($is_new?'required':'optional').'|matches[users_new_password]')
         ));

       // Run form validation
       if ($this->form_validation->run())
       {

         $email_taken = $this->email_check($this->input->post('users_email', TRUE));
         $username_taken = $this->username_check($this->input->post('users_username'));
        
         // If user is changing email and new email is already taken OR
         // if this is a new user, just check if it's been taken already.
         if ( (! empty($id) && strtolower($this->input->post('users_email', TRUE)) != strtolower($data['update_account']->email) && $email_taken) || (empty($id) && $email_taken) )
         {
           $data['users_email_error'] = lang('settings_email_exist');
         }
         // Check if user name is taken
         elseif ( (! empty($id) && strtolower($this->input->post('users_username', TRUE)) != strtolower($data['update_account']->username) && $username_taken) || (empty($id) && $username_taken) )
         {
           $data['users_username_error'] = lang('sign_up_username_taken');
         }
         else
         {
           
           // Create a new user
           if( empty($id) ) {
             $id = $this->account_model->create(
               $this->input->post('users_username', TRUE), 
               $this->input->post('users_email', TRUE), 
               $this->input->post('users_new_password', TRUE), 
               $parent_id);
           }
           // Update existing user information
           else 
           {
             // Update account username
             $this->account_model->update_username($id, 
               $this->input->post('users_username', TRUE) ? $this->input->post('users_username', TRUE) : NULL);

             // Update account email
             $this->account_model->update_parent_id($id, 
               $parent_id ? $parent_id : NULL);

             // Update password
             $pass = $this->input->post('users_new_password', TRUE) ? $this->input->post('users_new_password', TRUE) : NULL;
             if( ! empty($pass) )
             {
               $this->account_model->update_password($id, $pass);
             }

             // Check if the user should be suspended
             if( $this->authorization->is_permitted('ban_users') ) 
             {
               if( $this->input->post('manage_user_ban', true) )
               {
                 $this->account_model->update_suspended_datetime($id);
               }
               elseif( $this->input->post('manage_user_unban', true) )
               {
                 $this->account_model->remove_suspended_datetime($id);
               }
             }
           }

           // Update account details
           $attributes = array();
           
           $attributes['firstname'] = $this->input->post('users_firstname', TRUE) ? $this->input->post('users_firstname', TRUE) : NULL;
           $attributes['lastname'] = $this->input->post('users_lastname', TRUE) ? $this->input->post('users_lastname', TRUE) : NULL;
           $attributes['fullname'] = $attributes['firstname'].' '.$attributes['lastname'];
           $this->account_details_model->update($id, $attributes);
           // Update Bank Information
           $ban_attr = array();
           $ban_attr['bank_code'] = $this->input->post('bank_code', TRUE);
           $ban_attr['bank_name'] = $this->input->post('bank_name', TRUE);
           $ban_attr['branch_code'] = $this->input->post('branch_code', TRUE);
           $ban_attr['branch_name'] = $this->input->post('branch_name', TRUE);
           $ban_attr['account_type'] = $this->input->post('account_type', TRUE);
           $ban_attr['account_no'] = $this->input->post('account_no', TRUE);
           $this->account_details_model->update_bank_details($id, $ban_attr);
           // Send Email
           // Set reset datetime
           $time = $this->account_model->update_reset_sent_datetime($account->id);

           // Load email library
           $this->load->library('email');

           // Set up email preferences
           $config['mailtype'] = 'html';

           // Initialise email lib
           $this->email->initialize($config);

           // Generate reset password url
           // $account_activation_url = site_url('account/account_profile?id='.$id.'&token='.sha1($account->id.$time.$this->config->item('password_reset_secret')));
           $account_activation_url = site_url('account/company_settings?tencd='.$this->input->post('users_username', TRUE));


           // Send reset password email
           $this->email->from($this->config->item('password_reset_email'), 'JACOS CO. LTD.,');
           $this->email->to($this->input->post('users_email', TRUE));
           $this->email->subject('About New Member Adding');
           $this->email->message($this->load->view('account/account_activation', array(
             'username' => $attributes['firstname'],
             'password_reset_url' => anchor($account_activation_url, $account_activation_url)
           ), TRUE));
           $this->email->send();
           
           // Apply roles
           $roles = array(2);
           
           $this->rel_account_role_model->delete_update_batch($id, $roles);
           if ($this->input->post('request_url') == 'company_margine') {
             redirect("company_margine");
           }else{
             redirect("account/manage_users/member");
           }        
         }
       }
       // Load manage users view
       $this->load->view('account/manage_member_save', $data);
   }
}

/* End of file manage_users.php */
/* Location: ./application/account/controllers/manage_users.php */
