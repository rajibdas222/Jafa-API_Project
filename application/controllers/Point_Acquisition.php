<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Point_Acquisition extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
        $this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'account/account_model', 'points_model', 'giftcode_model','PointsDetailsModel'));
        $this->load->language(array('general', 'account/sign_in'));
    }

    public function index()
    {
        $data['page_title'] = 'point_acquisition';
        $this->load->view('point_acquisition');
    }

    /**
     * @return object
     */
    public function pointDetails()
    {
        $data['page_title'] = 'point_acquisition';
        $this->load->view('jacos_point_details/point_details_indivual');
    }


    public function get_allcompany_member()
    {
        $user_id = $this->input->post('user_id');
        if ($this->authentication->is_signed_in()) {
            if ($user_id == "" || $user_id == 'null') {
                $user_id = $this->session->userdata('account_id');
            }

            if ($user_id == 'all') {
                $user_id = NULL;
            }

            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

            $data['company_details'] = $this->points_model->get_company_details($user_id);

            $company_members = $this->points_model->get_company_member($user_id);
            $data['members'] = array();
            foreach ($company_members as $key => $member) {
                $member_info['user_id'] = $member->id;
                $member_info['fullname'] = $member->fullname;
                $member_info['company_details'] = $this->points_model->get_company_details($member->parent_id);
                $member_info['temp'] = $this->points_model->company_member_summary_by_com_id($member->id, 'temp');

                $member_info['perm'] = $this->points_model->company_member_summary_by_com_id($member->id, 'perm');
                $member_info['point_history'] = $this->get_user_amazon_point($member->id);


                $member_info['excenge_amount'] = $this->points_model->get_total_excange_by_member_id($member->id);
                $data['members'][] = $member_info;
            }

            echo json_encode($data);
        }

    }
    public function get_admin_allcompany_member($user_id)
    {

        if ($this->authentication->is_signed_in()) {
            if ($user_id == "" || $user_id == 'null') {
                $user_id = $this->session->userdata('account_id');
            }

            if ($user_id == 'all') {
                $user_id = NULL;
            }

            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['company_details'] = $this->points_model->get_company_details($user_id);

            $company_members = $this->points_model->get_company_member($user_id);

            $data['members'] = array();
            foreach ($company_members as $key => $member) {
                $member_info['user_id'] = $member->id;
                $member_info['fullname'] = $member->fullname;
                $member_info['company_details'] = $this->points_model->get_company_details($member->parent_id);
                $member_info['temp'] = $this->points_model->company_member_summary_by_com_id($member->id, 'temp');

                $member_info['perm'] = $this->points_model->company_member_summary_by_com_id($member->id, 'perm');
                $member_info['point_history'] = $this->get_user_amazon_point($member->id);


                $member_info['excenge_amount'] = $this->points_model->get_total_excange_by_member_id($member->id);
                $data['members'][] = $member_info;
            }

            echo json_encode($data);
        }

    }

    public function get_admin_company_point_history($user_id)
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'allcompany_member_list'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        }
        $data['company_user_id'] = $user_id;
//        echo "<pre>";
//        exit();
        $this->load->view('jacos_point_details/admin_companylist_point_history', $data);

    }


    public function get_all_members()
    {
        if ($this->authentication->is_signed_in()) {

            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            //$company_members = $this->points_model->get_company_member();
            //$data['companylist'] = $this->account_model->company_list();
            $all_users = $this->account_model->get_all_user();

        //    print_r($all_users);
//            exit;
            $data['members'] = array();
            foreach ($all_users as $key => $member) {
                // print_r($member);
                
                $member_info['company_details'] = array();
                $member_info['temp'] = array();
                $member_info['perm'] = array();

                $member_info['point_history'] = array();
                if ($member->parent_id){
                    $member_info['user_id'] = $member->user_id;
                    $member_info['role_id'] = $member->role_id;
                    $member_info['fullname'] = $member->fullname;
                    $member_info['company_details'] = $this->points_model->get_company_details($member->parent_id);
                }else{
                    $member_info['user_id'] = null;
                    $member_info['role_id'] = $member->role_id;
                    $member_info['fullname'] = null;
                    $member_info['company_details'] = $member;
                }
                $member_info['temp'] = $this->points_model->company_member_summary_by_com_id($member->user_id, 'temp');
                $member_info['perm'] = $this->points_model->company_member_summary_by_com_id($member->user_id, 'perm');
                $member_info['point_history'] = $this->get_user_amazon_point($member->user_id);
                $member_info['excenge_amount'] = $this->points_model->get_total_excange_by_member_id($member->user_id);

                if(count($member_info) > 1 ){
                    $data['members'][] = $member_info;
                }else{
                    $data['members'][] = $member_info;
                }

            }
            // foreach ($all_users as $key => $member) {
            //     $member_info['user_id'] = $member->user_id;
            //     $member_info['fullname'] = $member->fullname;
            //     $member_info['company_details'] = array();
            //     $member_info['temp'] = array();
            //     $member_info['perm'] = array();

            //     $member_info['point_history'] = array();
            //     if ($member->parent_id){
            //         $member_info['company_details'] = $this->points_model->get_company_details($member->parent_id);
            //         //$member_info['company_full_name'] = $this->account_model->get_single_company($member->parent_id,'firstname');
            //         //$member_info['companylist'] = $this->account_model->company_all_list();
            //         $member_info['temp'] = $this->points_model->company_member_summary_by_com_id($member->user_id, 'temp');
            //         $member_info['perm'] = $this->points_model->company_member_summary_by_com_id($member->user_id, 'perm');
            //         $member_info['point_history'] = $this->get_user_amazon_point($member->user_id);
            //         $member_info['excenge_amount'] = $this->points_model->get_total_excange_by_member_id($member->user_id);
            //     }

            //     if(count($member_info) > 1 ){
            //         $data['members'][] = $member_info;
            //     }else{
            //         $data['members'][] = $member_info;
            //     }

            // }

            echo json_encode($data);
        }

    }


    public function company_member_links(){
        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        }

        $this->load->view('jacos_point_details/com-reg-form/company_member_link', $data);
    }

    public function get_all_company_members()
    {
        if ($this->authentication->is_signed_in()) {

            $data['all_users'] = $this->account_model->get_all_user_company();
            $data['all_company'] = $this->account_model->get_all_users();
            echo json_encode($data);
        }

    }



    public function get_user_amazon_point($user_id)
    {
        $data = array();
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);
            if (empty($data['user_info'])){
                return $data['success'] = 0;
            }
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            }else{
                $user_type = 'member';
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            if ($data['user_info']->role_id == 1) {
                $data['temporary_point'] = $data['user_temp_points']->jafa_point;
                $data['permanent_point'] = ($data['user_perm_points']->jafa_point - $data['converted_point']->converted_point);
            } elseif ($data['user_info']->role_id == 2) {
                $data['temporary_point'] = $data['user_temp_points']->company_point;
                $data['permanent_point'] = ($data['user_perm_points']->company_point - $data['converted_point']->converted_point);
            } else {
                $data['temporary_point'] = $data['user_temp_points']->user_point;
                $data['permanent_point'] = ($data['user_perm_points']->user_point - $data['converted_point']->converted_point);
            }
            // print_r($data);
            // exit();
            $data['success'] = 1;

        } else {
            $data['success'] = 0;

        }

        //print_r($data);
       return $data;
    }


    public function getAll_user_point_history($user_id)
    {
        $data = array();
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);

            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }

        $this->load->view('jacos_point_details/point_details_indivual', $data);
    }

//users_redirect_point_history
    public function users_redirect_point_history($user_id = null)
    {

        if ($user_id == NULL) {
            $user_id = $this->session->userdata('account_id');
        }
        $data = array();
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }
        //print_r($data);

        $this->load->view('jacos_point_details/users_point_history', $data);

    }

    public function getAdminAllUsers($user_id)
    {
        $data = array();
        $data['account_details'] = $this->account_details_model->get_by_account_id(('account_id'));
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            //$data['company_details'] = $this->points_model->get_company_details();
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
        $this->load->view('jacos_point_details/admin_members_history', $data);

    }



    public function LinkUsersCompanys(){
        $users = $this->input->post('users');
        $com_id = $this->input->post('com_id');
        foreach($users as $user){
            $this->account_model->account_com_info_into_user($user['user_id'] , $com_id);
        }
        //echo "ok";
    }

    public function AllJacosIdsList(){

        $data ['alljacosIdsList']= $this->PointsDetailsModel->userSelectById();
//        echo '<pre>';
//        print_r($data);
//        echo "</pre>";
    }



    public function ArrayMerge(){
        $array1 = array("color" => "red", 2, 4);
        $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
        $result = array_merge($array1, $array2);
        print_r($result);

    }
    


}