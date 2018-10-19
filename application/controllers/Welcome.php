<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('rest');
        $this->load->library('passwordhash');
        $this->load->library('companymessages');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model("welcomemodel");
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    // Function to get the client IP address
    public function getClientIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        echo $ipaddress;
    }

    public function eesAppSendMail($to, $subject, $message, $cc, $bcc)
    {

        try {
            $config['mailtype'] = 'html';
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = true;

            $this->email->initialize($config);
            $this->email->from('support@eesapplications.website', 'ees');
            $this->email->to($to);
            // $this->email->cc($cc);
            // $this->email->bcc($bcc);

            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function login()
    {
        if ($this->rest->get_request_method() == $this->rest->post_request_string()) {
            $loginData = array(
                "emailId" => $this->input->post('email', true),
                "status" => 1,
            );
            $res = $this->welcomemodel->checkLogin($loginData);
            if ($res['status'] == 'OK') {
                if ($this->passwordhash->VerifyPasswordHash($this->input->post('pwd', true), $res['data'][0]['password'])) {
                    $this->welcomemodel->updateIpaddress($loginData, array("ipaddress" => $this->input->post('ip', true)));
                    $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->loginSuccess, "loggedin" => $res['data'][0]['password'])), 200);
                } else {
                    $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->loginFail)), 200);
                }
            } else {
                $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->loginFail)), 200);
            }
        } else {
            $this->rest->response(json_encode(array("status" => 405, "message" => $this->companymessages->errorMsg)), 405);
        }
    }

    public function authorization()
    {
        if ($this->rest->get_request_method() == $this->rest->post_request_string()) {
            $loginData = array(
                "password" => $this->input->post('token', true),
                "status" => 1,
            );
            $res = $this->welcomemodel->checkLogin($loginData);
            if ($res['status'] == 'OK') {
                $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->loginSuccess, "loggedin" => $res['data'][0]['password'])), 200);
            } else {
                $this->rest->response(json_encode(array("status" => 200, "message" => $this->companymessages->loginFail)), 200);
            }
        } else {
            $this->rest->response(json_encode(array("status" => 405, "message" => $this->companymessages->errorMsg)), 405);
        }
    }
}
