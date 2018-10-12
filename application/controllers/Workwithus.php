<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Workwithus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('rest');
        $this->load->library('companymessages');
        $this->load->library('session');
        $this->load->model('workwithusmodel');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function workWithUsProposal()
    {
        if ($this->rest->get_request_method() == $this->rest->post_request_string()) {
            $requestData = $this->input->post();
            // print_r($requestData);
            $saveProposal = array(
                'fullname' => $requestData['name'],
                'emailId' => $requestData['email'],
                'message' => $requestData['message'],
                'addedDate' => date('Y-m-d H:i:s'),
                'ipaddress' => $requestData['ip'],
            );
            $response = $this->workwithusmodel->saveWorkWithUsProposal($saveProposal);
            if ($response) {
                $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->workWithUsSuccessMsg)), 200);
            } else {
                $this->rest->response(json_encode(array("status" => 400, "message" => $this->companymessages->errorMsg)), 400);
            }
        } else {
            $this->rest->response(json_encode(array("status" => 506, "message" => $this->companymessages->errorMsg)), 506);
        }
    }
}
