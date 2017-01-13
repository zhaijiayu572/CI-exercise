<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
//    public function __construct()
//    {
//        parent::__construct();
////        $this->load->helper('url');
//    }
    public function reg(){
        $this->load->view('reg');
    }
    public function checkname(){
        header('Access-Control-Allow-Origin:*');
        $name = $this->input->post('name');
        $this->load->model('Register');
        if($this->Register->check_name($name)){
            echo "success";
        }else{
            echo "error";
        }
    }
    public function do_reg(){
        $name = $this->input->post('user');
        $pass = $this->input->post('pass');
        $this->load->model('Register');
        if($this->Register->register_user($name,$pass)){
            echo "success";
        }else{
            echo "error";
        }
    }
}