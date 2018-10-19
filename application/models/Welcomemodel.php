<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcomemodel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function checkLogin($loginDetails)
    {
        $result_array = array(
            "status" => array(),
            "data" => array(),
        );
        $this->db->select("*");
        $this->db->from("eesalogin");
        $this->db->where($loginDetails);
        $login = $this->db->get();
        // echo $this->db->last_query();
        if (sizeof($login->result_array()) > 0) {
            $result_array['status'] = 'OK';
            $result_array['data'] = $login->result_array();
            return $result_array;
        } else {
            $result_array['status'] = 'BAD';
            $result_array['data'] = '';
            return $result_array;
        }
    }

    public function updateIpaddress($cond, $data)
    {
        $res = $this->db->update("eesalogin", $data, $cond);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
