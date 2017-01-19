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
    public function do_add_blog(){
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $catalog = $this->input->post('catalog');
        $type = $this->input->post('type');
        $type==1?$type="原创":$type="转帖";
        $uid = $this->session->uid;
        $rs = $this->Blog_model->add_blog($catalog,$uid,$title,$content,$type);
        if($rs){
            redirect('Blog/index');
        }else{
            echo "<script>alert('错误')</script>";
            echo "<script>location='".site_url('Blog/index')."'</script>>";
        }
    }
}