<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Points_model extends MY_Model {

	public $_table_name;
    public $_order_by;
    public $_primary_key;
    public function get_member_company()
    {
        $this->db->where(array('user_id !=' => 1));
        $this->db->order_by('item_sales_amount', 'desc');
        $query = $this->db->get('member_company');
        $data['all_company'] = $query->result();
        $this->db->select('SUM(item_sales_amount) as item_sales_amount, SUM(chalin_two) as chalin_two', FALSE);
        $this->db->where(array('user_id' => 1));
        $query = $this->db->get('member_company');
        $data['jacos'] = $query->row();
        return $data;
    }

    public function get_company()
    {
    	$this->db->where(array('user_id !=' => 1));
        // $this->db->order_by('item_sales_amount', 'desc');
        $query = $this->db->get('member_company');
        $data['all_company'] = $query->result();
        $this->db->select('member_name, SUM(item_sales_amount) as item_sales_amount, SUM(chalin_two) as chalin_two', FALSE);
        $this->db->where(array('user_id' => 1));
        $query = $this->db->get('member_company');
        $data['jacos'] = $query->row();
        return $data;
    }

    public function jacos_summary()
    {
        $this->db->select('SUM(customer_purchase.item_sales_amount) as item_sales_amount, SUM(customer_purchase.chalin_two) as chalin_two');
        // $this->db->join('company_margin_distribution', 'customer_purchase.user_id=company_margin_distribution.user_id', 'left');
        $this->db->where(array('user_id' => 11));
        $query = $this->db->get('customer_purchase');
        return $query->row();
    }

    public function company_list($category = NULL)
    {
        $this->db->select('a3m_account.id as user_id,
            a3m_account.tracking_id,
            a3m_account.email, 
            a3m_account.createdon,
            a3m_account_details.fullname as company_name, 
            a3m_account_details.major_company_jacos,
            a3m_acl_role.name as role_name, 
            company_margin_distribution.member_mar,
            company_margin_distribution.com_mar,             
            company_margin_distribution.service_charge');
        $this->db->from('a3m_account');
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
        $this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id');
        $this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id');
        $this->db->join('company_margin_distribution', 'a3m_account.id=company_margin_distribution.user_id', 'left');
        
        if (!empty($category)) {
            $this->db->where('a3m_account.parent_category', $category);
        }
        $this->db->where('a3m_rel_account_role.role_id', 2);
        $this->db->order_by('user_id', 'desc');
        // $this->db->where('a3m_account_details.major_company_jacos', 0);
        $query = $this->db->get();

        // echo $this->db->last_query();
        return $query->result();
    }



    public function company_summary()
    {
        $this->db->select('a3m_account.id as user_id, 
            a3m_account_details.fullname as company_name,
            a3m_acl_role.name as role_name');
        $this->db->select('SUM(customer_purchase.item_sales_amount) as item_sales_amount, customer_purchase.chalin_two');
        // $this->db->select('*')->from('certs');
        // $this->db->where('`id` NOT IN (SELECT `id_cer` FROM `revokace`)', NULL, FALSE);

        $this->db->from('a3m_account');
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
        $this->db->join('a3m_rel_account_role', 'a3m_account.id=a3m_rel_account_role.account_id');
        $this->db->join('a3m_acl_role', 'a3m_rel_account_role.role_id=a3m_acl_role.id');
        $this->db->join('customer_purchase', 'a3m_account.id=customer_purchase.company_id', 'left');
        $this->db->where('a3m_rel_account_role.role_id', 2);
        $query = $this->db->get();

        // echo $this->db->last_query();
        return $query->result();
    }

    public function get_company_member($parent_id = NULL)
    {
        $this->db->select('mt.id, mt.parent_id, mt.username, mt.tracking_id as member_tracking, mt.email, a3m_account_details.fullname, ct.tracking_id as company_tracking');

        $this->db->from('a3m_account AS mt');
        $this->db->join('a3m_account AS ct', 'mt.parent_id = ct.id','left');
        $this->db->join('a3m_account_details', 'mt.id=a3m_account_details.account_id');

        if (!empty($parent_id)) {
            $this->db->where('mt.parent_id', $parent_id);
        }

        $this->db->where('mt.parent_id is NOT NULL', NULL, FALSE);
        $this->db->order_by('mt.id');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_member_temp_sum($user_id)
    {
        $this->db->select('SUM(item_sales_amount) AS item_sales_amount, SUM(chalin_two) as chalin_two, SUM(shop_point) as shop_point');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_temporary', 1);
        $query = $this->db->get('customer_purchase');
        return $query->row();
    }

    public function get_member_perm_sum($user_id)
    {
        $this->db->select('SUM(item_sales_amount) AS item_sales_amount, SUM(chalin_two) as chalin_two, SUM(shop_point) as shop_point');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_temporary', 2);
        $query = $this->db->get('customer_purchase');
        return $query->row();
    }

    public function get_member_point($company_id = NULL)
    {
        $this->db->select('a3m_account.id,
            a3m_account.parent_id,
            a3m_account.tracking_id as user_tracking,
            a3m_account.username,
            a3m_account.email,
            a3m_account_details.fullname,
            point.tracking_id as point_tracking,
            point.*
            ');
        $this->db->join('a3m_account', 'point.user_id = a3m_account.id', 'left');
        $this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id', 'left');
        // $this->db->join('a3m_account_details', 'a3m_account_details.account_id=a3m_account.parent_id', 'left');
        if ($company_id != NULL) {
            $this->db->where('a3m_account.parent_id', $company_id);
        }        
        $query = $this->db->get('point');
        // echo $this->db->last_query();
        // exit();
        return $query->result();
    }

    public function get_user_point($user_id = NULL)
    {
        $this->db->select('a3m_account.id,
            a3m_account.parent_id,
            a3m_account.tracking_id as user_tracking,
            a3m_account.username,
            a3m_account.email,
            a3m_account_details.fullname,
            point.tracking_id as point_tracking,
            point.*
            ');
        $this->db->join('a3m_account', 'point.user_id=a3m_account.id', 'left');
        $this->db->join('a3m_account_details', 'a3m_account_details.account_id=a3m_account.id', 'left');
        // $this->db->join('a3m_account_details', 'a3m_account_details.account_id=a3m_account.parent_id', 'left');
        if ($user_id != NULL) {
            $this->db->where('a3m_account.id', $user_id);
        }        
        $query = $this->db->get('point');
        // echo $this->db->last_query();
        // exit();
        return $query->result();
    }

    public function get_summary_by_com_id($company_id)
    {
        $this->db->select('SUM(item_sales_amount) as item_sales_amount, SUM(chalin_two) as chalin_two');
        $this->db->where('customer_purchase.company_id', $company_id);
        $query = $this->db->get('customer_purchase');
        return $query->row();
    }

    public function company_category()
    {
        $this->db->select('parent_category');
        $this->db->group_by('parent_category');
        $query = $this->db->get('a3m_account');
        return $query->result();
    }

    public function get_temp_summary_category($category, $period = NULL, $end_date = NULL)
    {

        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        if ($category =="C") {
            $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=107)");
        }elseif ($category =="B") {
            $this->db->where('company_id', 32);
        }elseif ($category =='A') {
            $this->db->where('company_id !=', 32);
            $this->db->where('company_id !=', 107);
            $this->db->where("(tracking_id !='jouene0f-22' OR tracking_id !='nonmenber-22' OR tracking_id !='nonmenber' OR tracking_id !='')");
        }
        
        $this->db->where("(perm_processing_date>='".date('Y-m-d H:i:s')."' OR (perm_processing_date is NULL))");
        // $this->db->where("(amazon_per_date>='".date('Y-m-d H:i:s')."' OR (amazon_per_date is NULL))");
        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
                $period = $period." 00:00:00";
                $end_date = $end_date." 23:59:59";
                $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
                $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get('point');
        return $query->row();

    }

    public function get_per_summary_category($category, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        if ($category =='C') {
            $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=107)");
            // $this->db->where('tracking_id', 'jouene0f-22');
        }
        elseif ($category =='B') {
            $this->db->where('company_id', 32);
        }elseif ($category =='A') {
            $this->db->where('company_id !=', 32);
            $this->db->where('company_id !=', 107);
            $this->db->where("(tracking_id !='jouene0f-22' OR tracking_id !='nonmenber-22' OR tracking_id !='nonmenber' OR tracking_id !='')");
        }
        $this->db->where("(perm_processing_date<='".date('Y-m-d H:i:s')."')");
        // $this->db->where("(amazon_per_date<='".date('Y-m-d H:i:s')."')");
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get('point');
        return $query->row();
    }



    public function get_temp_summary_by_com_id($company_id, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null' || $end_date == NULL) {
            $end_date = NULL;
        }

        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        if ($company_id ==107) {
            $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$company_id)");
            // $this->db->where('tracking_id', 'jouene0f-22');
        }else{
            $this->db->where('company_id', $company_id);
        }
        // $this->db->where('perm_processing_date >=', date('Y-m-d H:i:s'));
        // Chagne for only lesthen processing date at 20200122
        // $this->db->where("(perm_processing_date>='".date('Y-m-d H:i:s')."' AND status=0 OR (perm_processing_date is NULL))");
        $this->db->where("(perm_processing_date>='".date('Y-m-d H:i:s')."' OR (perm_processing_date is NULL))");
        
        // $this->db->where("(amazon_per_date>='".date('Y-m-d H:i:s')."' OR (amazon_per_date is NULL))");
        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
                $period = $period." 00:00:00";
                $end_date = $end_date." 23:59:59";
                $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
                $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get('point');
        return $query->row();
    }

    public function get_per_summary_by_com_id($company_id, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null' || $end_date == NULL) {
            $end_date = NULL;
        }
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        if ($company_id ==107) {
            $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$company_id)");
            // $this->db->where("(tracking_id ='jouene0f-22' OR company_id=$company_id)");
            // $this->db->where('tracking_id', 'jouene0f-22');
        }else{
            $this->db->where('company_id', $company_id);
        }
        
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        // Change Show permanet only date matche diny status 1 at 20200122
        // $this->db->where("(perm_processing_date<='".date('Y-m-d H:i:s')."' OR status=1)");
        $this->db->where("(perm_processing_date<='".date('Y-m-d H:i:s')."')");
        // $this->db->where("(amazon_per_date<='".date('Y-m-d H:i:s')."')");
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get('point');
        return $query->row();
    }

    public function get_total_excange_by_com_id($company_id, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        $this->db->join('a3m_account', 'jafa_gift_code.user_id = a3m_account.id');
        $this->db->where('a3m_account.parent_id', $company_id);
        
        
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('jafa_gift_code.use_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('jafa_gift_code.use_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_used_giftcode_by_category($category, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        $this->db->join('a3m_account', 'jafa_gift_code.user_id = a3m_account.id');
        // $this->db->where('a3m_account.parent_id', $company_id);
        if ($category =="C") {
            $this->db->where('a3m_account.parent_id', 107);
        }elseif ($category =="B") {
            $this->db->where('a3m_account.parent_id', 32);
        }elseif ($category =='A') {
            $this->db->where('a3m_account.parent_id !=', 32);
            $this->db->where('a3m_account.parent_id !=', 107);
            // $this->db->where("(tracking_id !='jouene0f-22' OR tracking_id !='nonmenber-22' OR tracking_id !='nonmenber' OR tracking_id !='')");
        }

        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('jafa_gift_code.use_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('jafa_gift_code.use_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_privious_giftcode($period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }

        $this->db->select('SUM(price_amount) as amount');
        $this->db->from('jafa_gift_code');
        // $this->db->where('status IS NULL', null, false);
        
        if ($period !="all" && $end_date == "") {
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m') <", $period);
        }
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        
        // if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
        //     $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m')", $period);
        // }elseif ($end_date != "") {
        //     $period = $period." 00:00:00";
        //     $end_date = $end_date." 23:59:59";
        //     $this->db->where('jafa_gift_code.use_date >=', date('Y-m-d H:i:s', strtotime($period)));
        //     $this->db->where('jafa_gift_code.use_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        // }
        $query = $this->db->get();
        return $query->row();
    }

    public function previous_used_gift_amount($period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }

        $this->db->select('SUM(price_amount) as amount');
        $this->db->from('jafa_gift_code');
        // $this->db->where('status IS NULL', null, false);
        
        if ($period !="all" && $end_date == "") {
            $this->db->where("DATE_FORMAT(use_date,'%Y-%m') <", $period);
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_entry_giftcode($period = NULL, $end_date = NULL)
    {
        if ($period == 'null'|| $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        
        
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.created_at,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('jafa_gift_code.created_at >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('jafa_gift_code.created_at <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_previous_giftcode($period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        
        
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.created_at,'%Y-%m') <", $period);
        }
        // elseif ($end_date != "") {
        //     $period = $period." 00:00:00";
        //     $end_date = $end_date." 23:59:59";
        //     $this->db->where('jafa_gift_code.created_at <=', date('Y-m-d H:i:s', strtotime($period)));
        //     $this->db->where('jafa_gift_code.created_at >=', date('Y-m-d H:i:s', strtotime($end_date)));
        // }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_unuse_giftcode($period = NULL, $end_date = NULL)
    {
        if ($period == 'null' || $period == NULL) {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        
        
        // $this->db->where('status IS NULL', null, false);
        
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.created_at,'%Y-%m') <=", $period);
            // $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m') >", $period);
        }
        // elseif ($end_date != "") {
        //     $period = $period." 00:00:00";
        //     $end_date = $end_date." 23:59:59";
        //     $this->db->where('jafa_gift_code.created_at <=', date('Y-m-d H:i:s', strtotime($period)));
        //     $this->db->where('jafa_gift_code.created_at >=', date('Y-m-d H:i:s', strtotime($end_date)));
        // }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_excange_by_member_id($member_id, $period = NULL, $end_date = NULL)
    {
        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(jafa_gift_code.price_amount) as amount');
        $this->db->from('jafa_gift_code');
        $this->db->where('jafa_gift_code.user_id', $member_id);
        
        
        // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        
        if ($period !="all" && $period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('jafa_gift_code.use_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('jafa_gift_code.use_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function get_summary_by_unknown($type = 'temp', $period = NULL, $end_date = NULL)
    {
        if ($period == 'null') {
            $period = date('Y-m');
        }
        if ($end_date == 'null') {
            $end_date = NULL;
        }
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        $this->db->where('user_id', NULL);
        if ($type=='temp') {
            // Change Show permanet only date matche diny status 1 at 20200122
            $this->db->where("(perm_processing_date>='".date('Y-m-d H:i:s')."' OR (perm_processing_date is NULL))");
            // $this->db->where("(amazon_per_date>='".date('Y-m-d H:i:s')."' OR (amazon_per_date is NULL))");
        }else{
            $this->db->where("(perm_processing_date <='".date('Y-m-d H:i:s')."')");
            // $this->db->where("(amazon_per_date <='".date('Y-m-d H:i:s')."')");
            // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        }
        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        
        $query = $this->db->get('point');
        return $query->row();
    }

    public function new_get_summary_by_com_id($company_id)
    {
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point');
        $this->db->where('company_id', $company_id);
        $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
        // $this->db->where('amazon_per_date <=', date('Y-m-d H:i:s'));
        $query = $this->db->get('point');
        return $query->row();
    }

    public function get_shop_margin($user_id = NULL)
    {
        // $this->db->select('user_id, shop_id, SUM(customer_purchase.item_sales_amount) as sales_amount,
        //     SUM(customer_purchase.shop_point) as shop_point,
        //     SUM(customer_purchase.chalin_two) as chalin_two');
        $this->db->select('shop_id');
        $this->db->group_by('customer_purchase.shop_id');
        // $this->db->order_by('sales_amount', 'desc');
        $this->db->from('customer_purchase');
        $shops = $this->db->get()->result();
        $member_summery =array();
        foreach ($shops as $key => $shop) {
            $this->db->select('user_id, shop_id, SUM(customer_purchase.item_sales_amount) as sales_amount,
                SUM(customer_purchase.shop_point) as shop_point,
                SUM(customer_purchase.chalin_two) as chalin_two');
            $this->db->where(array('user_id' => $user_id, 'shop_id' => $shop->shop_id));
            $user_sum = $this->db->get('customer_purchase')->row();
            
            if ($shop->shop_id == 1) {
                $shop_name = 'アマゾン';
            }elseif ($shop->shop_id == 2) {
                $shop_name = 'ヤフー';
            }else{
                $shop_name = '楽天';
            }
            $user['shop_id'] = $shop->shop_id;
            $user['shop_name'] = $shop_name;
            $user['sales_amount'] = ($user_sum->sales_amount!="")? $user_sum->sales_amount: 0;
            $user['shop_point'] = ($user_sum->shop_point!="")? $user_sum->shop_point: 0;
            $user['chalin_two'] = ($user_sum->chalin_two!="")? $user_sum->chalin_two: 0;
            $member_summery[] = $user;
        }

        return $member_summery;
    }

    public function get_company_details($company_id)
    {
        $this->db->select('a3m_account_details.*, company_margin_distribution.*');
        $this->db->from('a3m_account_details');
        $this->db->join('company_margin_distribution', 'company_margin_distribution.user_id=a3m_account_details.account_id', 'left');
        $this->db->where('a3m_account_details.account_id', $company_id);
        $query = $this->db->get('customer_purchase');
        return $query->row();
    }

    public function get_customer_purchase_list($customer_id = NULL, $period = NULL, $end_date = NULL)
    {
        if (!empty($customer_id)) {
            
                $this->db->select('
                    a3m_account_details.*,
                    point.*
                    ');
                $this->db->join('a3m_account_details', 'point.user_id=a3m_account_details.account_id', 'left');
                $this->db->join('a3m_account', 'point.user_id=a3m_account.id', 'left');
                if ($customer_id == 108) {
                    $this->db->where("(point.tracking_id ='jouene0f-22' OR point.tracking_id='nonmenber-22'  OR point.tracking_id='' OR point.tracking_id='nonmenber' OR user_id=$customer_id)");
                    // $this->db->where("(point.tracking_id ='jouene0f-22' OR point.user_id=$customer_id)");
                }else{
                    $this->db->where('user_id', $customer_id);
                }

                if (empty($period)) {
                    $period = date("Y-m");
                }
                if ($period !="all" && empty($end_date)) {
                    $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
                }else{
                        $period = $period." 00:00:00";
                        $end_date = $end_date." 23:59:59";
                        $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
                        $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
                } 
                 
                $this->db->order_by('order_date', 'desc');
                $query = $this->db->get('point');
                return $query->result();          
        }else{
             $this->db->where(array('user_id !=' => 0));
             $this->db->order_by('order_date', 'desc');
            $query = $this->db->get('point');
            return $query->result();
        }
    }

    public function get_customer_giftcode_history($customer_id = NULL, $period = NULL, $end_date = NULL)
    {
        if (!empty($customer_id)) {
            
                $this->db->select('
                    a3m_account_details.fullname,
                    a3m_account.username,
                    a3m_account.email,
                    jafa_gift_code.*
                    ');

                $this->db->join('a3m_account', 'jafa_gift_code.user_id=a3m_account.id');
                $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
                
                
                $this->db->where('jafa_gift_code.user_id', $customer_id);
                

                if (empty($period)) {
                    $period = date("Y-m");
                }
                if ($period !="all" && empty($end_date)) {
                    $this->db->where("DATE_FORMAT(jafa_gift_code.use_date,'%Y-%m')", $period);
                }
                // else{
                //         $period = $period." 00:00:00";
                //         $end_date = $end_date." 23:59:59";
                //         $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
                //         $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
                // } 
                 
                $this->db->order_by('jafa_gift_code.use_date', 'desc');
                $query = $this->db->get('jafa_gift_code');
                return $query->result();          
        }else{
            $this->db->select('
                    a3m_account_details.fullname,
                    a3m_account.username,
                    a3m_account.email,
                    jafa_gift_code.*
                    ');

            $this->db->join('a3m_account', 'jafa_gift_code.user_id=a3m_account.id');
            $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
            $this->db->order_by('jafa_gift_code.use_date', 'desc');
            $query = $this->db->get('jafa_gift_code');
            return $query->result();  
            //return $query->result();
        }
    }

    public function last_input_sheet($user_id = NULL, $report_type = "temp", $period = NULL, $end_date = NULL, $user_type = NULL)
    {
        $this->db->select('created_at');
        if (empty($period)) {
            $period = date("Y-m");
        }
        if (!empty($user_type)) {
            if ($user_type == 'company') {
                if (!empty($user_id)) {
                    if ($user_id == 107) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR company_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('company_id', $user_id);
                    }
                }
            }elseif($user_type == 'member'){
                if (!empty($user_id)) {
                    if ($user_id == 108) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('user_id', $user_id);
                    }                    
                }
            }
        }elseif (empty($user_type) && !empty($user_id)) {
            if ($user_id == 108) {
                $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                // $this->db->where('tracking_id', "jouene0f-22");
            }else{
                $this->db->where('user_id', $user_id);
            } 
            // $this->db->where('user_id', $user_id);
        }

        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
                $period = $period." 00:00:00";
                $end_date = $end_date." 23:59:59";
                $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
                $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }      
        $this->db->order_by('point.point_id', 'desc');
        $query = $this->db->get('point');
        return $query->row();
    }

    public function get_company_summary_by_com_id($user_id = NULL, $report_type = "temp", $period = NULL, $end_date = NULL, $user_type = NULL)
    {
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point, tracking_id, created_at');

        if (empty($period)) {
            $period = date("Y-m");
        }
        if (!empty($user_type)) {
            if ($user_type == 'company') {
                if (!empty($user_id)) {
                    if ($user_id == 107) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR company_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('company_id', $user_id);
                    }
                }
            }elseif($user_type == 'member'){
                if (!empty($user_id)) {
                    if ($user_id == 108) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('user_id', $user_id);
                    }
                }
            }
        }elseif (empty($user_type) && !empty($user_id)) {
            if ($user_id == 108) {
                $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                // $this->db->where('tracking_id', "jouene0f-22");
            }else{
                $this->db->where('user_id', $user_id);
            }
            // $this->db->where('user_id', $user_id);
        }

        if ($report_type !='temp') {
            // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));
            $this->db->where("(perm_processing_date <='".date('Y-m-d H:i:s')."')");
            // $this->db->where("(amazon_per_date <='".date('Y-m-d H:i:s')."')");
        }else{
            $this->db->where("(perm_processing_date >='".date('Y-m-d H:i:s')."' OR perm_processing_date is NULL)");
            // $this->db->where("(amazon_per_date >='".date('Y-m-d H:i:s')."' OR amazon_per_date is NULL)");
        }

        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }

        $query = $this->db->get('point');
        return $query->row();
    }


    public function get_company_summary_detail_by_com_id($user_id = NULL, $report_type = "temp", $period = NULL, $end_date = NULL, $user_type = NULL)
    {
        //company details
        $this->db->select('*, a3m_account_details.fullname as company_name');
        if (empty($period)) {
            $period = date("Y-m");
        }
        if (!empty($user_type)) {
            if ($user_type == 'company') {
                if (!empty($user_id)) {
                    if ($user_id == 107) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR company_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('company_id', $user_id);
                    }
                }
            }elseif($user_type == 'member'){
                if (!empty($user_id)) {
                    if ($user_id == 108) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('user_id', $user_id);
                    }
                }
            }
        }elseif (empty($user_type) && !empty($user_id)) {
            if ($user_id == 108) {
                $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                // $this->db->where('tracking_id', "jouene0f-22");
            }else{
                $this->db->where('user_id', $user_id);
            }
            // $this->db->where('user_id', $user_id);
        }

        if ($report_type !='temp') {

            // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));

            $this->db->where("(perm_processing_date <='".date('Y-m-d H:i:s')."')");
            // $this->db->where("(amazon_per_date <='".date('Y-m-d H:i:s')."')");
        }else{
            $this->db->where("(perm_processing_date >='".date('Y-m-d H:i:s')."' OR perm_processing_date is NULL)");
            // $this->db->where("(amazon_per_date >='".date('Y-m-d H:i:s')."' OR amazon_per_date is NULL)");
        }

        if ($period !="all" && $period !="" && $end_date == "") {
            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
        }elseif ($end_date != "") {
            $period = $period." 00:00:00";
            $end_date = $end_date." 23:59:59";
            $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
            $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
        }
        //this code for company name
        $this->db->join('a3m_account_details', 'point.company_id = a3m_account_details.account_id', 'left');
        $this->db->order_by('order_date','ASC');
        $query = $this->db->get('point');
        return $query->result();
//        echo $this->db->last_query();exit;

    }

    public function get_converted_point_total($user_id)
    {
        $this->db->select_sum('converted_point');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('jafa_gift_code');
        return $query->row();
    }

    public function get_gift_code($user_id = NULL)
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
        $this->db->join('a3m_account', 'jafa_gift_code.user_id = a3m_account.id');
        $this->db->join('a3m_account_details', 'a3m_account.id=a3m_account_details.account_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_gift_code($gift_id)
    {
        $this->db->where('gift_id', $gift_id);
        $this->db->delete('jafa_gift_code');
        return TRUE;
    }


    public function company_member_summary_by_com_id($user_id = NULL, $report_type = "temp", $period = NULL,$user_type = NULL)
    {
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point, tracking_id, created_at,order_date');
        if (empty($period)) {
            $period = date("Y-m");
        }
        if (!empty($user_type)) {
            if ($user_type == 'company') {
                if (!empty($user_id)) {
                    if ($user_id == 107) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$user_id)");
                    }else{
                        $this->db->where('company_id', $user_id);
                    }
                }
            }elseif($user_type == 'member'){
                if (!empty($user_id)) {
                    if ($user_id == 108) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                    }else{
                        $this->db->where('user_id', $user_id);
                    }
                }
            }
        }elseif (empty($user_type) && !empty($user_id)) {
            if ($user_id == 108) {
                $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
            }else{
                $this->db->where('user_id', $user_id);
            }
        }

        if ($report_type !='temp') {
            $this->db->where("(perm_processing_date <='".date('Y-m-d')."')");
        }else{
            $this->db->where("(perm_processing_date >='".date('Y-m-d')."' OR perm_processing_date is NULL)");
        }

        $this->db->order_by('created_at','DESC');
        $query = $this->db->get('point');
        return $query->row();
        //echo $this->db->last_query();exit;
    }

    public function company_member_summary_by_company_id($user_id = NULL, $report_type = "temp", $period = NULL,$user_type = NULL)
    {
        $this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point, tracking_id, created_at,order_date');
        if (empty($period)) {
            $period = date("Y-m");
        }

        if (!empty($user_type)) {
            if ($user_type == 'company') {
                if (!empty($user_id)) {
                    if ($user_id == 107) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR company_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR company_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('company_id', $user_id);
                    }
                }
            }elseif($user_type == 'member'){
                if (!empty($user_id)) {
                    if ($user_id == 108) {
                        $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                        // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                        // $this->db->where('tracking_id', "jouene0f-22");
                    }else{
                        $this->db->where('user_id', $user_id);
                    }
                }
            }
        }elseif (empty($user_type) && !empty($user_id)) {
            if ($user_id == 108) {
                $this->db->where("(tracking_id ='jouene0f-22' OR tracking_id='nonmenber-22' OR tracking_id='nonmenber' OR tracking_id='' OR user_id=$user_id)");
                // $this->db->where("(tracking_id ='jouene0f-22' OR user_id=$user_id)");
                // $this->db->where('tracking_id', "jouene0f-22");
            }else{
                $this->db->where('user_id', $user_id);
            }
            // $this->db->where('user_id', $user_id);
        }

        if ($report_type !='temp') {

            // $this->db->where('perm_processing_date <=', date('Y-m-d H:i:s'));

            $this->db->where("(perm_processing_date <='".date('Y-m-d H:i:s')."')");
            // $this->db->where("(amazon_per_date <='".date('Y-m-d H:i:s')."')");
        }else{
            $this->db->where("(perm_processing_date >='".date('Y-m-d H:i:s')."' OR perm_processing_date is NULL)");
            // $this->db->where("(amazon_per_date >='".date('Y-m-d H:i:s')."' OR amazon_per_date is NULL)");
        }

//        if ($period !="all" && $period !="" && $end_date == "") {
//            $this->db->where("DATE_FORMAT(order_date,'%Y-%m')", $period);
//
//        }elseif ($end_date != "") {
//                $period = $period." 00:00:00";
//                $end_date = $end_date." 23:59:59";
//                $this->db->where('order_date >=', date('Y-m-d H:i:s', strtotime($period)));
//                $this->db->where('order_date <=', date('Y-m-d H:i:s', strtotime($end_date)));
//        }
        $this->db->order_by('created_at','DESC');
        $query = $this->db->get('point');
        return $query->row();
        //echo $this->db->last_query();exit;

    }
}

/* End of file Points_model.php */
/* Location: ./application/account/models/Points_model.php */