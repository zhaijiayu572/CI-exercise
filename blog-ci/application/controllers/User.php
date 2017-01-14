<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login(){
        $this->load->view('login');
    }
    public function do_login(){
        $name = $this->input->post('user');
        $pass = $this->input->post('pass');
        $result = $this->User_model->check_login($name,$pass);
        if($result){
            $this->session->uid = $result->uid;
            $this->session->uname = $result->uname;
            echo "<script>location='".site_url('Blog/index')."'</script>";
        }else{
            $this->login();
        }
    }
    public function reg(){
        $this->load->view('reg');
    }
    public function checkname(){
        header('Access-Control-Allow-Origin:*');
        $name = $this->input->post('name');
        $this->load->model('User_model');
        if($rs = $this->User_model->check_name($name)){
            echo "success";
        }else{
            echo "error";
        }
    }
    public function do_reg(){
        $name = $this->input->post('user');
        $pass = $this->input->post('pass');
        $this->load->model('User_model');
        if($this->User_model->register_user($name,$pass)){
            $this->load->view('login.php');
        }else{
            echo "error";
        }
    }
}