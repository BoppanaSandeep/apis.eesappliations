<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Workwithusmodel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function saveWorkWithUsProposal($proposal)
    {
        $res = $this->db->insert("work_with_us", $proposal);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
