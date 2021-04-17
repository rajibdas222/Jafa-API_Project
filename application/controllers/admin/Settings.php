<?php

class Settings extends CI_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->config('account/account');
		$this->load->helper(array('language', 'url', 'photo', 'file'));
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
		// echo "<pre>"; print_r($data);

		// print_r($data['gift_codes']);
		$data['appid'] = $this->input->get('appid');
		$data['query'] = $this->input->get('query')!=""?$this->input->get('query'):NULL;
		$data['affiliate_type'] = $this->input->get('affiliate_type')!=""?$this->input->get('affiliate_type'):NULL;
		$data['affiliate_id'] = $this->input->get('affiliate_id')!=""?$this->input->get('affiliate_id'):NULL;
		$data['condition'] = $this->input->get('condition')!=""?$this->input->get('condition'):NULL;
		$data['sort'] = $this->input->get('sort')!=""?$this->input->get('sort'): NULL;
		$data['start'] = $this->input->get('start')!=""?$this->input->get('start'): NULL;
		$data['results'] = $this->input->get('results')!=""?$this->input->get('results'): NULL;
		$data['yahoo_res'] = array();
		if ($this->input->get('save') === 'test') {			
	        $yahooData = $this->yahoo_api_by_keyword($data['appid'], $data['query'], $data['start'], $data['results'], $data['sort'], $data['condition'], $data['affiliate_type'], $data['affiliate_id']);
	        $yahoo_res = json_decode($yahooData);
	        if (!empty($yahoo_res) && $yahoo_res->totalResultsReturned>0) {
	        	$data['yahoo_res'] = $yahoo_res->hits;
	        }    		
		}elseif($this->input->get('save') === 'save'){
			$date = new DateTime(date('Y-m-d H:i:s'));
			$config_data = array(
				'condition' => $data['condition'],
				'sort' => $data['sort'],
			);
			$con_exist = $this->points_model->check_by(array('setting_name' => 'condition'), 'jafa_settings');
			$sort_exist = $this->points_model->check_by(array('setting_name' => 'sort'), 'jafa_settings');
			
			if (!empty($con_exist)) {
				$ins_data = array('setting_value' => $data['condition']);

				$this->db->set($ins_data);
				$this->db->where('setting_name', 'condition');
				$this->db->update('jafa_settings'); 
			}else{
				$ins_data = array(
			                'setting_name' => 'condition',
			                'setting_value' => $data['condition'],
			                'created_at' => $date->format('Y-m-d H:i:s')
			        	);
				$this->db->set($ins_data);
				$this->db->insert('jafa_settings');
			}

			if (!empty($sort_exist)) {
				$ins_data = array(
			                'setting_name' => 'sort',
			                'setting_value' => $data['sort']
			        );

				$this->db->set('setting_value', $data['sort']);
				$this->db->where('setting_name', 'sort');
				$this->db->update('jafa_settings'); 
			}else{
				$ins_data = array(
			                'setting_name' => 'sort',
			                'setting_value' => $data['sort'],
			                'created_at' => $date->format('Y-m-d H:i:s')
			        	);
				$this->db->set($ins_data);
				$this->db->insert('jafa_settings');
			}			
		}
		
		$this->load->view('admin/settings', $data);
	}

	public function yahoo_api_by_keyword($appid, $jan_code, $start_from = 1, $results = 30, $sort = "-score", $condition = 'new', $affiliate_type, $affiliate_id)
	{

		$get_pre = "";
		if (!empty($sort)) {
			$get_pre .="&sort=".urlencode($sort);
		}
		if (!empty($start_from)) {
			$get_pre .="&start=".$start_from;
		}
		if (!empty($results)) {
			$get_pre .="&results=".$results;
		}
		if (!empty($condition)) {
			$get_pre .="&condition=".$condition;
		}
		// if (!empty($affiliate_type)) {
		// 	$get_pre .="&affiliate_type=".$affiliate_type;
		// }
		// if (!empty($affiliate_id)) {
		// 	$get_pre .="&affiliate_id=".$affiliate_id;
		// }
		// Yahoo version V3
		
		$url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=".$appid."&query=".urlencode($jan_code).$get_pre;
		
		
		// $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=".$appid."&query=".urlencode($jan_code);
		// echo $url;
		// exit();
		// $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?query=".urlencode($jan_code)."&start=".$start_from."&results=".$results."&sort=".urlencode($sort);
		// return $url
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        // print_r($resp);
        return $resp;
	}

	
}