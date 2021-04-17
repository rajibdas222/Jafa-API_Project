<?php
/**
 * Created by PhpStorm.
 * User: JACOS
 * Date: 12/7/2020
 * Time: 1:54 PM
 */

class PointsDetailsModel extends CI_Model
{
    public function get_pointsDetails()
    {
        $this->db->select('*');
        $this->db->from('point_aquisition_details');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();


    }

    public function get_pointsData()
    {
        $this->db->select('*');
        $this->db->from('point');
        $this->db->order_by('point_id', 'desc');
        $query = $this->db->get();
        return $query->result();


    }


    public function savefile($data)
    {
//        print_r($data);
//        exit;
        $filedata = array(
            "store" => $data[0],
            "product_name" => $data[1],
            "ASIN" => $data[2],
            "seller" => $data[3],
            "tracking_id" => $data[4],
            "date_of_shipment" => $data[5],
            "price" => $data[6],
            "shipped_items" => $data[7],
            "returned_items" => $data[8],
            "sales" => $data[9],
            "referral_rate" => $data[10],
            "referral_fee" => $data[11],
            "device_type" => $data[12],
        );
        $this->db->insert("point_aquisition_details", $filedata);
    }


    public function points_details_byTracId($id)
    {
        $this->db->select('*');
        $this->db->from('point');
        $this->db->where('point.tracking_id',$id);
        $this->db->join('a3m_account', 'a3m_account.id = point.user_id',"LEFT");

        //$this->db->join('jafa_gift_code', 'jafa_gift_code.gift_id = point_aquisition_details.id', "LEFT");
        //$this->db->join('amazon_point_details', 'amazon_point_details.id = point_aquisition_details.id', "LEFT");
        //$this->db->join('a3m_account', 'a3m_account.tracking_id = point.tracking_id', "LEFT");
        $this->db->order_by('order_date', 'DESC');
        $query = $this->db->get();
//        print_r($query->result());exit;
        return $query->result();

    }

    public function  get_user_used_point_by_user_id($user_id){
        $this->db->select('*');
        $this->db->from('jafa_gift_code');
        $this->db->where('jafa_gift_code.user_id',$user_id);
//        $this->db->join('a3m_account', 'a3m_account.id = point.user_id',"LEFT");
//        $this->db->join('jafa_gift_code jgc1', 'jgc1.user_id = point.user_id',"LEFT");
//        $this->db->join('jafa_gift_code jgc2', 'DATE(jgc2.use_date) = DATE(point.order_date)',"LEFT");

        //$this->db->select('SUM(order_amount) as order_amount, SUM(point_amount) as point_amount, SUM(company_point) as company_point, SUM(user_point) as user_point, SUM(jafa_point) as jafa_point, tracking_id, created_at');
        //$this->db->order_by('order_date', 'asc');
        $query = $this->db->get();
//        print_r($query->result());exit;
        $resultDb = $this->db->query("SELECT SUM(converted_point) as total_used_point FROM `jafa_gift_code` WHERE `user_id` ='".$user_id."' ORDER BY `converted_point` ASC");
        return $resultDb->result();
    }

    public function points_details_category($id)
    {
        $this->db->select('*');
        $this->db->from('point_aquisition_details');
        $this->db->where('tracking_id',$id);
        $this->db->join('jafa_gift_code', 'jafa_gift_code.gift_id = point_aquisition_details.id', "LEFT");
        $this->db->join('amazon_point_details', 'amazon_point_details.id = point_aquisition_details.id', "LEFT");
        $this->db->order_by('date_of_shipment', 'asc');
        $query = $this->db->get();

        return $query->result();

    }

    // Update points details
    function updatepointdetails($id,$field){
        //$data = array($field => $value);
        $this->db->where('id',$id);
        $this->db->update('amazon_point_details',$field);
    }



    public function points_details_test()
    {
        $this->db->select('*');
        $this->db->from('point');
//        $this->db->join('jafa_gift_code', 'jafa_gift_code.gift_id = point_aquisition_details.id');
//        $this->db->join('amazon_point_details', 'amazon_point_details.id = point_aquisition_details.id');
        $query = $this->db->get();
        return $query->result();
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
//
        return $query->row();
        //echo $this->db->last_query();exit;

    }

    public function userSelectById()
    {
        $this->db->select('a3m_account_details.fullname', 'fullname');
        $this->db->from('a3m_account');
        $this->db->where('parent_id', 32);
        $this->db->order_by('id', 'desc');
        $this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id');

        $query = $this->db->get();
        return $query->result();

    }


}