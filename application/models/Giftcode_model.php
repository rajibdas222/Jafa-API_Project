<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giftcode_model extends MY_Model {

	public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_gift($user_id = NULL)
    {
        $this->db->select('
            a3m_account.id,
            a3m_account.tracking_id,
            a3m_account.username,
            a3m_account.email,
            a3m_account_details.fullname,
            jafa_gift_code.*
            ');
        $this->db->from('jafa_gift_code');
        $this->db->join('a3m_account', 'jafa_gift_code.user_id = a3m_account.id', 'left');
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id', 'left');
        if (!empty($user_id)) {
            $this->db->where('jafa_gift_code.user_id', $user_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_new_code($user_id, $limit = 1)
    {
        $this->db->where(array('user_id' => NULL, 'converted_point' => 500, 'status' => NULL));
        $this->db->limit($limit);
        $query = $this->db->get('jafa_gift_code');
        $gift_codes = $query->result();
        foreach ($gift_codes as $key => $gift_code) {
            $insert_data['user_id'] = $user_id;
            $insert_data['status'] = 1;
            $insert_data['use_date'] = date('Y-m-d H:i:s');
            $this->db->where('gift_id', $gift_code->gift_id);
            $this->db->update('jafa_gift_code', $insert_data);
        }
        return $gift_codes;
    }
}

/* End of file Points_model.php */
/* Location: ./application/account/models/Points_model.php */