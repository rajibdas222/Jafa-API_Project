<?php

class File_model extends CI_Model{

    public function savefile($data){

        $filedata = array(
            "number"=>$data[1],
            "time"=>$data[2],
            "full_name"=>$data[3],
            "purchase_amount"=>$data[4],
        );
        $this->db->insert("point_aquisition_details",$filedata);
    }
}