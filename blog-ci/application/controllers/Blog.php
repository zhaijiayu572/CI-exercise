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
        $result = $this->Blog_model->get_blog();
        $arr['result'] = $result;
        $this->load->view('index',$arr);
    }
    public function search(){
        $keyword = $this->input->get('keyword');
        $result = $this->Blog_model->search($keyword);
        $arr['result'] = $result;
        $this->load->view('index',$arr);
    }
}