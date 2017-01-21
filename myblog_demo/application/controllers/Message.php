<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }
    public function show_message(){
        $this->load->view('inbox');
    }
    public function send_message(){
        $arr['receiver'] = $this->uri->segment(3);
        $this->load->view('sendMsg',$arr);
    }
    public function send_success(){
        $this->load->view('sendMsgOK');
    }
    public function do_add_message(){
        $receiver = $this->input->post('receiver');
        $content = $this->input->post('content');
        $sender = $this->session->uid;
        $rs = $this->Message_model->send_message($sender,$receiver,$content);
        if($rs){
            redirect('Message/send_success');
        }else{
            echo "<script>alert('发送失败')</script>";
            echo "<script>location='".site_url('Message/send_message')."'</script>";
        }
    }

}