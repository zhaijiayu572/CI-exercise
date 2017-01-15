<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comment_model');
    }
    public function reply(){
        $pid = $this->uri->segment(3);
        $wid = $this->uri->segment(4);
        $this->session->pid = $pid;
        $this->session->wid = $wid;
        $this->load->view("reply");
    }
    public function do_reply(){
        if(isset($_SESSION['uid'])){
            if(isset($_SESSION['pid'])){
                $pid = $this->session->pid;
                $wid = $this->session->wid;
                $uid = $this->session->uid;
                unset(
                    $_SESSION['pid'],
                    $_SESSION['wid']
                );
                $pcon = $this->input->post('pcon');
                $query = $this->Comment_model->insert_reply($pid,$pcon,$wid,$uid);
                if($query){
                    redirect('Blog/show_blog/'.$wid);
                }
            }else{
                redirect('Comment/reply');
            }
        }else{
            $a = $this->uri->segment(1);
            $b = $this->uri->segment(2);
            redirect("User/login/$a/$b");
        }
    }
}