<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * Main Base Model MY_Model
 * Author: Nayeem 
 */

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    // CURD FUNCTION

    public function array_from_post($fields) {

        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function get($id = NULL, $single = FALSE) {

        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if ($this->_order_by!= '') {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data, $id = NULL) {

        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    /**
     * Delete Multiple rows
     */
    public function delete_multiple($where) {
        $this->db->where($where);
        $this->db->delete($this->_table_name);
    }

    function uploadImage($field) {

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2024';
        $config['overwrite'] = TRUE;
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            return $img_data;
            // uploading successfull, now do your further actions
        }
    }

    function uploadFile($field) {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $file_data ['fileName'] = $fdata['file_name'];
            $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $file_data ['fullPath'] = $fdata['full_path'];
            $file_data ['ext'] = $fdata['file_ext'];
            $file_data ['size'] = $fdata['file_size'];
            $file_data ['is_image'] = $fdata['is_image'];
            $file_data ['image_width'] = $fdata['image_width'];
            $file_data ['image_height'] = $fdata['image_height'];
            return $file_data;
            // uploading successfull, now do your further actions
        }
    }

    function uploadAllType($field) {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $file_data ['fileName'] = $fdata['file_name'];
            $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $file_data ['fullPath'] = $fdata['full_path'];
            $file_data ['ext'] = $fdata['file_ext'];
            $file_data ['size'] = $fdata['file_size'];
            $file_data ['is_image'] = $fdata['is_image'];
            $file_data ['image_width'] = $fdata['image_width'];
            $file_data ['image_height'] = $fdata['image_height'];
            return $file_data;
            // uploading successfull, now do your further actions
        }
    }

    function multi_uploadAllType($field) {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_multi_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $multi_fdata = $this->upload->get_multi_upload_data();
            foreach ($multi_fdata as $fdata) {

                $file_data ['fileName'] = $fdata['file_name'];
                $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
                $file_data ['fullPath'] = $fdata['full_path'];
                $file_data ['ext'] = $fdata['file_ext'];
                $file_data ['size'] = $fdata['file_size'];
                $file_data ['is_image'] = $fdata['is_image'];
                $file_data ['image_width'] = $fdata['image_width'];
                $file_data ['image_height'] = $fdata['image_height'];

                $result[] = $file_data;
            }
            return $result;
            // uploading successfull, now do your further actions
        }
    }

    public function check_by($where, $tbl_name) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function count_rows($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function get_any_field($table, $where_criteria, $table_field) {
        $query = $this->db->select($table_field)->where($where_criteria)->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$table_field;
        }
    }

    /**
     * @ Upadate row with duplicasi check
     */
    public function check_update($table, $where, $id = Null) {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        if ($id != null) {
            $this->db->where($id);
        }
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    // set actiion setting 

    public function set_action($where, $value, $tbl_name) {
        $this->db->set($value);
        $this->db->where($where);
        $this->db->update($tbl_name);
    }

    function get_sum($table, $field, $where) {

        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$field;
        } else {
            return 0;
        }
    }

    public function get_limit($where, $tbl_name, $limit) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $this->db->limit($limit);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function short_description($string = FALSE, $from_start = 30, $from_end = 10, $limit = FALSE) {
        if (!$string) {
            return FALSE;
        }
        if ($limit) {
            if (mb_strlen($string) < $limit) {
                return $string;
            }
        }
        return mb_substr($string, 0, $from_start - 1) . "..." . ($from_end > 0 ? mb_substr($string, - $from_end) : '' );
    }

    function get_table_field($tableName, $where = array(), $field) {

        return $this->db->select($field)->where($where)->get($tableName)->row()->$field;
    }

    function get_time_different($from, $to) {
        $diff = abs($from - $to);
        $years = $diff / 31557600;
        $months = $diff / 2635200;
        $weeks = $diff / 604800;
        $days = $diff / 86400;
        $hours = $diff / 3600;
        $minutes = $diff / 60;
        if ($years > 1) {
            $duration = round($years) . lang('years');
        } elseif ($months > 1) {
            $duration = round($months) . lang('months');
        } elseif ($weeks > 1) {
            $duration = round($weeks) . lang('weeks');
        } elseif ($days > 1) {
            $duration = round($days) . lang('days');
        } elseif ($hours > 1) {
            $duration = round($hours) . lang('hours');
        } else {
            $duration = round($minutes) . lang('minutes');
        }

        return $duration;
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    function send_email($params)

    {

        $config = array();

        // $this->load->library('encrypt');
        $this->load->library('encryption');


        $config = array(

            'smtp_host' => 'smtp.jacos.co.jp',

            'smtp_port' => 587,

            'smtp_user' => 'no-reply@jacos.co.jp',

            'smtp_pass' => 'hm&wKy7q',

            'crlf' => "\r\n",

            'protocol' => 'smtp',

        );
            

        // $config['useragent'] = 'UniqueCoder LTD';

        $config['mailtype'] = "html";

        // $config['newline'] = "\r\n";

        $config['charset'] = 'UTF-8';

        $config['wordwrap'] = TRUE;



        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@jacos.co.jp', "株式会社ジャコス");

        $this->email->to($params['recipient']);



        $this->email->subject($params['subject']);

        $this->email->message($params['message']);

        if ($params['resourceed_file'] != '') {

            $this->email->attach($params['resourceed_file']);

        }

        $send = $this->email->send();

        if ($send) {

            return $send;

        } else {

            $error = show_error($this->email->print_debugger());

            return $error;

        }

    }

    
}
