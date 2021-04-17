<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance_model extends MY_Model {

	public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_balance_by_shop_id($shop_id)
    {
        $this->db->select('jafa_balance_sheet.payment_date');
    	$this->db->select_sum('jafa_balance_sheet.amount');
        $this->db->where('shop_id', $shop_id);
        $this->db->order_by('bal_id', 'desc');
    	return $this->db->get('jafa_balance_sheet')->row();
    }

    public function get_total_gift_amount($shop_id = NULL)
    {
        $this->db->select_sum('jafa_gift_code.price_amount');
        $this->db->where('status', 1);
        if (!empty($shop_id)) {
            $this->db->where('shop_id', $shop_id);
        }    	
    	return $this->db->get('jafa_gift_code')->row();
    }

    public function history($shop_id = NULL)
    {
    	if (!empty($shop_id)) {
    		$this->db->where('shop_id', $shop_id);
    	}
    	    	
    	return $this->db->get('jafa_balance_sheet')->result();
    }

}

/* End of file Points_model.php */
/* Location: ./application/account/models/Points_model.php */