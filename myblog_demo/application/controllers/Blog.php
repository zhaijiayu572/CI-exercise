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
            $uid = $this->uri->segment(3);
            $result = $this->Blog_model->get_myblog($uid);
            $arr['result'] = $result;
            $this->load->model('Message_model');
            $message = $this->Message_model->show_unread_num($uid);
            $this->load->model('Catalog_model');
            $catalog = $this->Catalog_model->get_all_catalog();
            $arr['catalog'] = $catalog;
            $arr['message'] = $message;
            $arr['writer'] = $uid;
            $this->load->view('index_logined',$arr);
        }else{
            $this->load->view('index');
        }
    }
    public function blogs(){
        $uid = $this->session->uid;
        $arr['number'] = $this->Blog_model->all_blog($uid);
        $arr['result'] = $this->Blog_model->get_myblog($uid);
        $this->load->view('blogs',$arr);
    }
    public function del_blog(){
        $aBid = $this->input->post('bid');
        $flag = true;
        for($i=0;$i<count($aBid);$i++){
            $result = $this->Blog_model->del_blog($aBid[$i]);
            if(!$result){
                $flag = false;
            }
        }
        if($flag){
            echo 'success';
        }else{
            echo "error";
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
        $this->load->model('Catalog_model');
        $this->Catalog_model->use_catalog($catalog);
        $rs = $this->Blog_model->add_blog($catalog,$uid,$title,$content,$type);
        if($rs){
            redirect('Blog/index');
        }else{
            echo "<script>alert('错误')</script>";
            echo "<script>location='".site_url('Blog/index')."'</script>";
        }
    }
    public function viewPost_logined(){
        $bid = $this->uri->segment(3);
        $uid = $this->session->uid;
        $this->load->model('Message_model');
        $this->Blog_model->update_click($bid);
        $message = $this->Message_model->show_unread_num($uid);
        $arr['message'] = $message;

        $rs = $this->Blog_model->get_blog($bid);
        $arr['rs'] = $rs;
        $this->load->view('viewPost_logined',$arr);
    }
}