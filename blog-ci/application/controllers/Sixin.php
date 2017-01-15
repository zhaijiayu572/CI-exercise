<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sixin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sixin_model');
    }
    public function letter(){
        $rid = $this->uri->segment(3);
        $this->session->rid = $rid;
        $this->load->view('letter');
    }
    public function write_letter(){
        if(isset($_SESSION['uid'])){
            if(isset($_SESSION['rid'])){
                $rid = $this->session->rid;
                $sid = $this->session->uid;
                unset(
                    $_SESSION['rid']
                );
                $scontent = $this->input->post('scontent');
                $query = $this->Sixin_model->insert_letter($sid,$rid,$scontent);
                if($query){
                    redirect('Blog/index');
                }else{
                    echo "error";
                }
            }
        }else{
            $a = $this->uri->segment(1);
            $b = $this->uri->segment(2);
            redirect("User/login/$a/$b");
        }
    }
    public function show_letter(){
        if(isset($_SESSION['uid'])){
            $uid = $this->session->uid;
            $result = $this->Sixin_model->get_letter($uid);
            $arr['result'] = $result;
            $this->load->view('show_letter',$arr);
        }else{
            $a = $this->uri->segment(1);
            $b = $this->uri->segment(2);
            redirect("User/login/$a/$b");
        }
    }
}