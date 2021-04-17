<?php


class Point_Acquisition_Details extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
        $this->load->language(array('general', 'account/sign_in'));
        // Load Model
        $this->load->model('PointsDetailsModel');
    }



    public function showAllPoints(){
        $allCsvData = new PointsDetailsModel;
        $data['data'] = $allCsvData->get_pointsDetails();
//        print_r($data);
//        exit;
        $this->load->view('jacos_point_details/allCsvData',$data);

    }
    //Show all amazon point data
    public function amazonAllPoint(){

       // echo "ok view";
        $allCsvData = new PointsDetailsModel;
        $data['data'] = $allCsvData->get_pointsData();
//        echo "<pre>"; print_r($data);
//        exit;
        $this->load->view('jacos_point_details/allCsvData',$data);

    }



    //All points_details_byTracId
    public function allPointsId($id)
    {
        $allPointsData = new PointsDetailsModel;
        $data['data'] = $allPointsData->points_details_byTracId($id);
        $user_id = $data['data'][0]->user_id;
        $data['user_used_point'] = $allPointsData->get_user_used_point_by_user_id($user_id);
//        echo '<pre>';
//        print_r($data['user_used_point']);
//        echo '<pre>';exit;
        //$this->load->view('jacos_point_details/point_details_indivual',$data);

    }
    //all points show function
    public function allPoints($id)
    {
        $allPointsData = new PointsDetailsModel;
        $data['data'] = $allPointsData->points_details_category($id);
//        echo '<pre>';
//        print_r($data);
//        echo '<pre>';
        $this->load->view('jacos_point_details/point_details_indivual',$data);

    }

    public function updatePointDetails(){
        // POST values
        $edit_id = $_POST['id'];
        $table_left_id = $_POST['a'];
        //$table_balance_d = $_POST['table_balance_d'];

        //echo $table_left_id;
        // Update records
        $this->PointsDetailsModel->updatepointdetails($edit_id,['a_leftover' => $table_left_id]);
        //echo 1;
        //exit;
    }


    public function allPointsGift()
    {
        $allPointsData = new PointsDetailsModel;
        $data['data'] = $allPointsData->points_details_test();
        echo '<pre>';
        print_r($data);
        echo '</pre>';

    }

    public function PointCSV(){
        //$this->load->view('home_view');
        if (isset($_POST['submit'])){
            $file =$_FILES['file']['tmp_name'];
            $handle = fopen($file,'r');
            $c = 0;

            while(($filepos=fgetcsv($handle,10000,','))!==false){

                if ($c>1){
                    $this->PointsDetailsModel->savefile($filepos);
                }
                $c++;
            }
            redirect('points', 'refresh');
            //$this->load->view('jacos_point_details/point_details_indivual');

        }

    }






}