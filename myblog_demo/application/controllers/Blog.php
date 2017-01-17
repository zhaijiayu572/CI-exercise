<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
    }

    public function index(){
        if(isset($_SESSION['uid'])){
            $uid = $this->session->uid;
            $result = $this->Blog_model->get_myblog($uid);
            $arr['result'] = $result;
            $this->load->view('index_logined',$arr);
        }else{
            $this->load->view('index');
        }
    }
    public function addblog(){
        $this->load->model("Catalog_model");
        $result = $this->Catalog_model->get_all_catalog();
        $arr['catalog'] = $result;
        $this->load->view('newBlog',$arr);
    }
}