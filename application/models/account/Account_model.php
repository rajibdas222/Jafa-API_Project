<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {	
	
	/**
	 * Get all accounts
	 *
	 * @access public
	 * @return object all accounts
	 */
	function get()
	{
		return $this->db->get('a3m_account')->result();
	}

	function get_all_user(){
        $this->db->select('a3m_account.id as user_id,
            a3m_account.tracking_id,
            a3m_account.email, 
            a3m_account.createdon,
            a3m_account.parent_id,
            a3m_account_details.fullname, 
            a3m_account_details.major_company_jacos,
            a3m_acl_role.name as role_name, 
            a3m_acl_role.id as role_id, 
            company_margin_distribution.member_mar,
            company_margin_distribution.com_mar,             
            company_margin_distribution.service_charge');
        $this->db->from('a3m_account');
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id', 'left');
        $this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id','left');
        $this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id', 'left');
        $this->db->join('company_margin_distribution', 'a3m_account.id=company_margin_distribution.user_id', 'left');
        $this->db->order_by('user_id', 'desc');
        // $this->db->where('a3m_account_details.major_company_jacos', 0);
        $query = $this->db->get();

        // echo $this->db->last_query();
        return $query->result();

    }

    function get_all_users(){
        $this->db->select('a3m_account.id as user_id,
            a3m_account.tracking_id,
            a3m_account.email, 
            a3m_account.createdon,
            a3m_account.parent_id,
            a3m_account_details.fullname, 
            a3m_account_details.major_company_jacos,
            a3m_acl_role.name as role_name, 
            a3m_acl_role.id as role_id, 
            company_margin_distribution.member_mar,
            company_margin_distribution.com_mar,             
            company_margin_distribution.service_charge');
        $this->db->from('a3m_account');
        $this->db->where('a3m_account.parent_id =',null);
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id', 'left');
        $this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id','left');
        $this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id', 'left');
        $this->db->join('company_margin_distribution', 'a3m_account.id=company_margin_distribution.user_id', 'left');
        $this->db->order_by('user_id', 'desc');
        // $this->db->where('a3m_account_details.major_company_jacos', 0);
        $query = $this->db->get();

        // echo $this->db->last_query();
        return $query->result();

    }

// get all company users
    function get_all_user_company(){
        $this->db->select('a3m_account_details.* ,a3m_account.id as user_id,
            a3m_account.tracking_id,
            a3m_account.parent_id,
            a3m_account_details.fullname, 
            a3m_account_details.major_company_jacos,
            a3m_acl_role.name as role_name, 
            a3m_acl_role.id as role_id, 
            company_margin_distribution.member_mar,
            company_margin_distribution.com_mar,             
            company_margin_distribution.service_charge');
        $this->db->from('a3m_account');
        $this->db->where('parent_id', 32);
        //$this->db->where('a3m_account.parent_id !=',null);
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id', 'left');
        $this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id','left');
        $this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id', 'left');
        $this->db->join('company_margin_distribution', 'a3m_account.id=company_margin_distribution.user_id', 'left');
        $this->db->order_by('user_id', 'desc');
        // $this->db->where('a3m_account_details.major_company_jacos', 0);
        $query = $this->db->get();

        // echo $this->db->last_query();
        return $query->result();

    }
	/**
	 * Get account by id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account object
	 */
	function get_by_id($account_id)
	{
		$this->db->select('a3m_account.*, 
			a3m_account.id, 
			a3m_account_details.*,
			a3m_acl_role.name,
			a3m_acl_role.id as role_id
			');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id');
		$this->db->join('a3m_rel_account_role', 'a3m_rel_account_role.account_id = a3m_account.id', 'left');
		$this->db->join('a3m_acl_role', 'a3m_acl_role.id = a3m_rel_account_role.role_id', 'left');
		$this->db->where('a3m_account.id', $account_id);
				
		return $this->db->get()->row();
		// return $this->db->get_where('a3m_account', array('id' => $account_id))->row();
	}

	public function get_by_tracking($tracking_id)
	{
		return $this->db->get_where('a3m_account', array('tracking_id' => $tracking_id))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get account by username
	 *
	 * @access public
	 * @param string $username
	 * @return object account object
	 */
	function get_by_username($username)
	{
		return $this->db->get_where('a3m_account', array('username' => $username))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get account by email
	 *
	 * @access public
	 * @param string $email
	 * @return object account object
	 */
	function get_by_email($email)
	{
		return $this->db->get_where('a3m_account', array('email' => $email))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get account by username or email
	 *
	 * @access public
	 * @param string $username_email
	 * @return object account object
	 */
	function get_by_username_email($username_email)
	{
		$this->db->select('a3m_account.*, a3m_account_details.*, a3m_acl_role.name as role_name, a3m_acl_role.id as role_id');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id', 'left');
		$this->db->join('a3m_rel_account_role', 'a3m_account.id = a3m_rel_account_role.account_id', 'left');
		$this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id = a3m_acl_role.id', 'left');
		$this->db->where('a3m_account.username', $username_email);
		$this->db->or_where("a3m_account.email", $username_email);
		$query = $this->db->get();
		return $query->row();
		// return $this->db->from('a3m_account')->where('username', $username_email)->or_where('email', $username_email)->get()->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Create an account
	 *
	 * @access public
	 * @param string $username
	 * @param string $hashed_password
	 * @return int insert id
	 */
	function create($username, $email = NULL, $password = NULL, $parent_id = NULL, $tracking_id = NULL, $varified_on = NULL)
	{
		// Create password hash using phpass
		if ($password !== NULL)
		{
			$this->load->helper('account/phpass');
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			$hashed_password = $hasher->HashPassword($password);
		}
		if ($tracking_id === NULL) {
			$tracking_id = $this->generate_tracking_number($parent_id);
		}

		if ($varified_on !== NULL) {
			$password = NULL;
		}

		$this->load->helper('date');
		$this->db->insert('a3m_account', array('username' => $username, 'email' => $email, 'password' => isset($hashed_password) ? $hashed_password : NULL, 'createdon' => mdate('%Y-%m-%d %H:%i:%s', now()), 'parent_id' => $parent_id,  'password_text' => $password, 'tracking_id' => $tracking_id, 'verifiedon' => mdate('%Y-%m-%d %H:%i:%s', now())));
		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------

	/**
	 * Change account username
	 *
	 * @access public
	 * @param int $account_id
	 * @param int $new_username
	 * @return void
	 */
	function update_username($account_id, $new_username)
	{
		$this->db->update('a3m_account', array('username' => $new_username), array('id' => $account_id));
	}

	public function tracking_number($account_id, $new_tracking)
	{
		$this->db->update('a3m_account', array('tracking_id' => $new_tracking), array('id' => $account_id));
	}

	function update_parent_id($account_id, $parent_id)
	{
		$this->db->update('a3m_account', array('parent_id' => $parent_id), array('id' => $account_id));
	}

	// --------------------------------------------------------------------

	/**
	 * Change account email
	 *
	 * @access public
	 * @param int $account_id
	 * @param int $new_email
	 * @return void
	 */
	function update_email($account_id, $new_email)
	{
		$this->db->update('a3m_account', array('email' => $new_email), array('id' => $account_id));
	}

	// --------------------------------------------------------------------

	/**
	 * Change account password
	 *
	 * @access public
	 * @param int $account_id
	 * @param int $hashed_password
	 * @return void
	 */
	function update_password($account_id, $password_new)
	{
		$this->load->helper('account/phpass');
		$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		// print_r($hasher);
		// exit();
		$new_hashed_password = $hasher->HashPassword($password_new);

		$this->db->update('a3m_account', array('password' => $new_hashed_password), array('id' => $account_id));
	}

	// --------------------------------------------------------------------

	/**
	 * Update account last signed in dateime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function update_last_signed_in_datetime($account_id)
	{
		$this->load->helper('date');

		$this->db->update('a3m_account', array('lastsignedinon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
	}

	// --------------------------------------------------------------------

	/**
	 * Update password reset sent datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return int password reset time
	 */
	function update_reset_sent_datetime($account_id)
	{
		$this->load->helper('date');

		$resetsenton = mdate('%Y-%m-%d %H:%i:%s', now());

		$this->db->update('a3m_account', array('resetsenton' => $resetsenton), array('id' => $account_id));

		return strtotime($resetsenton);
	}

	/**
	 * Remove password reset datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function remove_reset_sent_datetime($account_id)
	{
		$this->db->update('a3m_account', array('resetsenton' => NULL), array('id' => $account_id));
	}

	/**
	 * Remove password reset datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function sign_up_verifyed($account_id)
	{
		$data = array(
		    'verifiedon' => date("Y-m-d H:i:s"),
		    'password_text' => NULL
		);

		$this->db->where('id', $account_id);
		$this->db->update('a3m_account', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Update account deleted datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function update_deleted_datetime($account_id)
	{
		$this->load->helper('date');

		$this->db->update('a3m_account', array('deletedon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
	}

	/**
	 * Remove account deleted datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function remove_deleted_datetime($account_id)
	{
		$this->db->update('a3m_account', array('deletedon' => NULL), array('id' => $account_id));
	}

	// --------------------------------------------------------------------

	/**
	 * Update account suspended datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function update_suspended_datetime($account_id)
	{
		$this->load->helper('date');
		$this->db->update('a3m_account', array('suspendedon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
	}

	/**
	 * Remove account suspended datetime
	 *
	 * @access public
	 * @param int $account_id
	 * @return void
	 */
	function remove_suspended_datetime($account_id)
	{
		$this->db->update('a3m_account', array('suspendedon' => NULL), array('id' => $account_id));
	}

	function get_shoper()
	{
		$this->db->select('a3m_account.id, a3m_account.username, a3m_account.email, a3m_account_details.fullname, a3m_account_details.dateofbirth');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
		// $this->db->where('a3m_account.id', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function company_list()
	{
		$this->db->select('a3m_account.id as account_id, a3m_account.username, a3m_account.email, a3m_account_details.fullname, a3m_account_details.dateofbirth, a3m_acl_role.name as role_name,a3m_rel_account_role.role_id as role_id');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
		$this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id');
		$this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id');
		$this->db->where('a3m_rel_account_role.role_id', 2);
		$query = $this->db->get();
		return $query->result();
	}

	//Rajib create
	public function company_all_list()
	{
		$this->db->select('a3m_account.id as account_id, a3m_account.username, a3m_account.email, a3m_account_details.fullname, a3m_account_details.dateofbirth, a3m_acl_role.name as role_name,a3m_rel_account_role.role_id as role_id');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
		$this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id');
		$this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id');
		$this->db->where('a3m_rel_account_role.role_id', 2);
		$query = $this->db->get();
        //return $query->row();
		//return $query->result();
	}



    public function get_single_company($mId,$index)
    {
        $this->db->select($index);
        $this->db->from('a3m_account_details');
        $this->db->where('account_id',$mId);

        $query = $this->db->get();
        return $query->result()[0]->$index;
    }

	public function member_list()
	{
		$this->db->select('a3m_account.*, a3m_account.id as account_id,  a3m_account.username, a3m_account.email, a3m_account_details.fullname, a3m_account_details.dateofbirth, a3m_acl_role.name as role_name');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
		$this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id', 'left');
		$this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id', 'left');
		$this->db->where("a3m_rel_account_role.role_id", 3)->or_where('a3m_rel_account_role.role_id IS NULL', null, false);
		$query = $this->db->get();
		return $query->result();
	}

	function generate_tracking_number($parent_id)

	{
	    $query = $this->db->select_max('id')->get('a3m_account');
	    $total_row = $this->db->where('parent_id', $parent_id)->count_all_results('a3m_account');
	    if ($total_row > 0) {
	        $next_number = $total_row + 1;
	        $next_number = sprintf('%010d', $next_number);
	        return $next_number;
	    } else {
	    	return sprintf('%010d', 1);
	    }

	}


    function account_com_info_into_user($id, $com_id){
        $data = array(
            'parent_id' => $com_id
        );
//		echo $com_id;
//		echo $id;
        $this->db->where('id', $id);
        $this->db->update('a3m_account', $data);
    }

}


/* End of file account_model.php */
/* Location: ./application/account/models/account_model.php */