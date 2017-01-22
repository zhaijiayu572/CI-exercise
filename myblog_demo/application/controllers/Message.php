<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }
    public function inbox(){
        $uid = $this->session->uid;
        $result = $this->Message_model->update_state($uid);
        if($result){
            $rnumber = $this->Message_model->receive_number($uid);
            $snumber = $this->Message_model->send_number($uid);
            $rmsg = $this->Message_model->show_receive($uid);
            $arr['rnum'] = $rnumber;
            $arr['snum'] = $snumber;
            $arr['rmsg'] = $rmsg;
            $this->load->view('inbox',$arr);
        }else{
            redirect('Blog/index');
        }

    }
    public function outbox(){
        $uid = $this->session->uid;
        $rnumber = $this->Message_model->receive_number($uid);
        $snumber = $this->Message_model->send_number($uid);
        $smsg = $this->Message_model->show_send($uid);
        $arr['rnum'] = $rnumber;
        $arr['snum'] = $snumber;
        $arr['smsg'] = $smsg;
        $this->load->view('outbox',$arr);
    }
    public function send_message(){
        $arr['receiver'] = $this->uri->segment(3);
        $this->load->model('Blog_model');
        $result = $this->Blog_model->few_blog($arr['receiver']);
        $arr['result'] = $result;
        $uid = $this->session->uid;
        $arr['message'] = $this->Message_model->show_unread_num($uid);
        $this->load->view('sendMsg',$arr);
    }
    public function send_success(){
        $uid = $this->session->uid;
        $this->load->model('Blog_model');
        $result = $this->Blog_model->few_blog($uid);
        $arr['message'] = $this->Message_model->show_unread_num($uid);
        $arr['result'] = $result;
        $this->load->view('sendMsgOK',$arr);
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
    public function del_msg(){
        $mid = $this->uri->segment(3);
        $rs = $this->Message_model->del_msg($mid);
        if($rs){
            redirect("Message/inbox");
        }else{
            echo "<script>alert('删除失败')</script>";
            echo "<script>location='".site_url('Message/inbox')."'</script>";
        }
    }

}