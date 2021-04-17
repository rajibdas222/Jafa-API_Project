<?php

class Test_search extends CI_Controller {

	function __construct()
	{

		parent::__construct();
	}
	
	 
	
	public function index()
	{

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
			$con_exist = $this->db->get_where('jafa_settings', array('setting_name' => 'condition'))->row();
			// $con_exist = $this->points_model->check_by(array('setting_name' => 'condition'), 'jafa_settings');
			$sort_exist = $this->db->get_where('jafa_settings', array('setting_name' => 'sort'))->row();
			// $sort_exist = $this->points_model->check_by(array('setting_name' => 'sort'), 'jafa_settings');
			
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

		$this->load->view('test_search', $data);
	}

	public function yahoo_api_by_keyword($appid, $jan_code, $start_from = 1, $results = 30, $sort = "-score", $condition = 'new', $affiliate_type, $affiliate_id)
	{

		$get_par = "";
		if (!empty($sort)) {
			$get_par .="&sort=".urlencode($sort);
		}
		if (!empty($start_from)) {
			$get_par .="&start=".$start_from;
		}
		if (!empty($results)) {
			$get_par .="&results=".$results;
		}
		if (!empty($condition)) {
			$get_par .="&condition=".$condition;
		}

		// Yahoo version V3
		
		$url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=".$appid."&query=".urlencode($jan_code).$get_par;
		
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

        return $resp;
	}

	
}