<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->library('pagination');
    }
    public function index(){
        $number = $this->Blog_model->get_allblog();
        $config['base_url'] = site_url('Blog/index');
        $config['total_rows'] = $number;
        $config['per_page'] = 2;
        $this->pagination->initialize($config);
        $index = $this->uri->segment(3,0);
        $result = $this->Blog_model->get_blog($index);
        $catalog = $this->Blog_model->get_catalog();
        $this->load->model('Sixin_model');
        $uid = $this->session->uid;
        $unread_num = $this->Sixin_model->select_unread($uid);
        $arr['unread_num'] = $unread_num;
        $arr['result'] = $result;
        $arr['catalog'] = $catalog;
        $this->load->view('index',$arr);
    }
    public function search(){
        $keyword = $this->input->get('keyword');
        $result = $this->Blog_model->search($keyword);
        $arr['result'] = $result;
        $this->load->view('index',$arr);
    }
    public function screen(){
        $cid = $this->uri->segment(3);
        $result = $this->Blog_model->get_screen($cid);
        $catalog = $this->Blog_model->get_catalog();
        $arr['result'] = $result;
        $arr['catalog'] = $catalog;
        $this->load->view('index',$arr);
    }
    public function add_blog(){
        $result = $this->Blog_model->get_catalog();
        $arr['catalog'] = $result;
        $this->load->view('add',$arr);
    }
    public function do_add_blog(){
        $uid = $this->session->uid;
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $cid = $this->input->post('catalog');
        $result = $this->Blog_model->insert_blog($cid,$title,$content,$uid);
        if($result){
            echo "<script>alert('发表成功')</script>";
            redirect('Blog/index');
        }else{
            echo "<script>alert('发表失败')</script>";
           // redirect('Blog/add_blog');
        }
    }
    public function add_catalog(){
        $this->load->view('add_catalog');
        $arr['a'] = 'aa';
        $this->load->vars($arr);
    }
    public function do_add_catalog(){
        $cname = $this->input->post('cname');
        $query = $this->Blog_model->insert_catalog($cname);
        if($query){
            redirect('Blog/add_blog');
        }else{
            redirect('Blog/add_catalog');
        }
    }
    public function show_blog(){
        $wid = $this->uri->segment(3);
        $hitsQuery = $this->Blog_model->update_hits($wid);
        if($hitsQuery){
            $comment = $this->Blog_model->get_comment($wid);
            $arr['comment'] = $comment;
            $result = $this->Blog_model->show_blog($wid);
            $arr['result'] = $result;
            $this->load->view('show_blog',$arr);
        }else{
            $uri = site_url('Blog/index');
            echo "<script>alert('数据更新失败')</script>";
            echo "<script>location='$uri'</script>>";
        }
    }
    public  function do_comment(){
        if(isset($_SESSION['uid'])){
            $uid = $this->session->uid;
            $wid = $this->input->post('wid');
            $pcon = $this->input->post('pconent');
            $query = $this->Blog_model->insert_comment($pcon,$uid,$wid);
            if($query){
                $uri = site_url('Blog/show_blog/').$wid;
                echo "<script>alert('评论成功')</script>";
                echo "<script>location='$uri'</script>>";
            }
        }else{
            $a = $this->uri->segment(1);
            $b = $this->uri->segment(2);
            redirect("User/login/$a/$b");
        }

    }
}