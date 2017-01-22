<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function reg(){
        $this->load->view('reg');
    }
    public function do_reg(){
        $account = $this->input->post('email');
        $name = $this->input->post('name');
        $pass = $this->input->post('pwd');
        $sex = $this->input->post('gender');
        $sex==1?$sex="男":$sex='女';
        $arr = array(
            'ACCOUNT'=>$account,
            'PASSWORD'=>$pass,
            'NAME'=>$name,
            'GENDER'=>$sex
        );
        $result = $this->User_model->insert_reg($arr);
        if($result){
            redirect('User/login');
        }else{
            redirect('User/reg');
        }

    }
    public function login(){
        $this->load->view('login');
    }
    public function do_login(){
        $account = $this->input->post('email');
        $pass = $this->input->post('pwd');
        $result = $this->User_model->select_login($account,$pass);
        if($result){
            $this->session->uid = $result->USER_ID;
            $this->session->uname = $result->NAME;
            redirect('Blog/index/'.$result->USER_ID);
        }else{
            echo '登录失败';
        }
    }
    public function unlogin(){
        unset(
            $_SESSION['uid'],
            $_SESSION['uname']
        );
        redirect('User/login');
    }
}