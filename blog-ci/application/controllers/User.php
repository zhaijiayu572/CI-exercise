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
        $arr['a'] = $this->uri->segment(3);
        $arr['b'] = $this->uri->segment(4);
        $this->load->view('login',$arr);
    }
    public function do_login(){
        $name = $this->input->post('user');
        $pass = $this->input->post('pass');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        if($a){
            $uri = $a."/".$b;
        }else{
            $uri = site_url('Blog/index');
        }
        $result = $this->User_model->check_login($name,$pass);
        if($result){
            $this->session->uid = $result->uid;
            $this->session->uname = $result->uname;
            redirect($uri);
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
    public function unlogin(){
        unset(
            $_SESSION['uid'],
            $_SESSION['uname']
        );
        redirect('Blog/index');
    }
}